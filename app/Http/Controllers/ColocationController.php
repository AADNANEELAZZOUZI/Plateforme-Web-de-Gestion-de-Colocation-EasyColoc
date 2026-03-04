<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationColoc;
use Illuminate\Support\Str;
class ColocationController extends Controller
{
public function index()
{
    $user = auth()->user();
    
    $colocation = null;
    $ceQueJeDois = 0;
    $ceQuOnMeDoit = 0;
    $dettesDetaillees = collect();

    $colocation = $user->colocation()
        ->where('status', 'active')
        ->whereNull('left_at')
        ->first();

    if ($colocation) {
        $ceQueJeDois = DB::table('payer_a')
            ->join('dépenses', 'payer_a.dépense_id', '=', 'dépenses.id')
            ->where('payer_a.de_user_id', $user->id)
            ->where('payer_a.status', 'en_attente')
            ->where('dépenses.colocation_id', $colocation->id)
            ->sum('payer_a.montant');

        $ceQuOnMeDoit = DB::table('payer_a')
            ->join('dépenses', 'payer_a.dépense_id', '=', 'dépenses.id')
            ->where('payer_a.a_user_id', $user->id)
            ->where('payer_a.status', 'en_attente')
            ->where('dépenses.colocation_id', $colocation->id)
            ->sum('payer_a.montant');

        $dettesDetaillees = DB::table('payer_a')
            ->join('dépenses', 'payer_a.dépense_id', '=', 'dépenses.id')
            ->join('users as debiteur', 'payer_a.de_user_id', '=', 'debiteur.id')
            ->join('users as creancier', 'payer_a.a_user_id', '=', 'creancier.id')
            ->where('payer_a.status', 'en_attente')
            ->where('dépenses.colocation_id', $colocation->id)
            ->select('debiteur.name as qui', 'creancier.name as a_qui', 'payer_a.montant')
            ->get();
    }

    return view('colocation.index', compact(
        'colocation', 
        'ceQueJeDois', 
        'ceQuOnMeDoit', 
        'dettesDetaillees'
    ));
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

        $request->user()->colocation()->attach($colocation->id, [
            'joined_at' => now(),
        ]);

        return redirect()->route('colocation.index')->with('success', 'Votre colocation a été créée !');
    }

    public function invite(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $token = Str::random(32);
        DB::table('invitations')->insert([
            'colocation_id' => $colocation->id,
            'email' => $request->email,
            'token' => $token,
            'expires_at' => now()->addDays(7),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Mail::to($request->email)->send(new InvitationColoc($colocation, $token));


        return back()->with('success', 'Invitation envoyée avec succès à ' . $request->email);
    }


    public function join($token)
    {
        $invitation = DB::table('invitations')->where('token', $token)->first();

        if (!$invitation || now()->isAfter($invitation->expires_at)) {
            return redirect('/')->with('error', 'Lien invalide ou expiré.');
        }

        $colocation = Colocation::find($invitation->colocation_id);
        $colocation->members()->attach(auth()->id(), ['joined_at' => now()]);

        DB::table('invitations')->where('token', $token)->delete();

        $dejaInvite = DB::table('invitations')
            ->where('colocation_id', $colocation->id)
            ->where('email', $invitation->email)
            ->exists();

        if ($dejaInvite) {
            return back()->with('error', 'Une invitation est déjà en cours pour cet email.');
        }
        return redirect()->route('colocation.index')->with('success', 'Bienvenue dans la coloc !');
    }

    public function destroy(Colocation $colocation)
    {
        $colocation->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return redirect()->route('colocation.index')->with('success', 'Votre colocation a été annulée !');
    }
}
