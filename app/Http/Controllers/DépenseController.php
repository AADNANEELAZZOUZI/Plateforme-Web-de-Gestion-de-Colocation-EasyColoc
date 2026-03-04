<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dépense;
use App\Models\Colocation;
use Illuminate\Support\Facades\DB;

class DépenseController extends Controller
{
    public function create()
    {
        $categories = collect([
            (object) ['id' => 1, 'name' => 'Alimentation'],
            (object) ['id' => 2, 'name' => 'Loyer'],
            (object) ['id' => 3, 'name' => 'Services publics'],
            (object) ['id' => 4, 'name' => 'Divertissement'],
            (object) ['id' => 5, 'name' => 'Autres'],
        ]);

        $colocation = auth()->user()->colocation()
        ->where('status', 'active')
        ->whereNull('left_at')
        ->with('members')
        ->first();

        $depenses = $colocation ? $colocation->dépenses()->with('payeur')->latest()->get() : collect();

        return view('dépenses.create', compact('colocation', 'depenses', 'categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payeur_id' => 'required|exists:users,id',
            'colocation_id' => 'required|exists:colocations,id',
            'catégorie_id' => 'required',
            'date' => 'required|date',
        ]);

        $depense = Dépense::create([
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'payeur_id' => $validated['payeur_id'],
            'colocation_id' => $validated['colocation_id'],
            'date' => $validated['date'],
            'catégorie_id' => $request->catégorie_id,
        ]);

        $membres = $depense->colocation->members;
        $nbMembres = $membres->count();
        $part = $depense->amount / $nbMembres;

        foreach ($membres as $membre) {
            if ($membre->id != $depense->payeur_id) {
                \DB::table('payer_a')->insert([
                    'de_user_id' => $membre->id,
                    'a_user_id' => $depense->payeur_id,
                    'dépense_id' => $depense->id,
                    'montant' => $part,
                    'status' => 'en_attente',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('colocation.index')->with('success', 'Dépense enregistrée et partagée !');
    }
}
