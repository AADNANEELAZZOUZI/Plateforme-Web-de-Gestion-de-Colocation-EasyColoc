<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
class ColocationController extends Controller
{
public function index(Request $request)
{
    $user = $request->user();

    $colocation = $user->colocation()->whereNull('left_at')->first();

    if (!$colocation) {
        return view('colocation.index'); 
    }

    $dépenses = $colocation->dépenses()->with('payeur')->latest()->get();
    return view('colocation.index', compact('colocation', 'dépenses'));
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

    $request->user()->colocations()->attach($colocation->id, [
        'joined_at' => now(),
    ]);

    return redirect()->route('colocation.index')->with('success', 'Votre colocation a été créée !');
}
}
