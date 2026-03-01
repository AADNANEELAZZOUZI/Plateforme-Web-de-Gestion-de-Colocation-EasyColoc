<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dépense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'colocation_id',
        'date',
        'catégorie_id',
        'payeur_id'
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function payeur()
    {
        return $this->belongsTo(User::class, 'payeur_id');
    }
}
