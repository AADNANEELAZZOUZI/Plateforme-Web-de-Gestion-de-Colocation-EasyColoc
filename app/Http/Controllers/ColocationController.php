<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
class ColocationController extends Controller
{
    public function index(Request $request)
    {
        $dépenses = $request->user()->dépenses()->with('colocation')->get();
        $colocations = Colocation::all();
        return view('colocation.index', compact('colocations', 'dépenses'));
    }

    public function create()
    {
        return view('colocation.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'status' => 'active',
        ]);

        return redirect()->route('colocation.index')->with('success', 'Colocation créée avec succès.');
    }
}
