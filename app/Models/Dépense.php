<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dépense extends Model
{
    protected $fillable = [
        'colocation_id', 'category_id', 'payer_id', 'title', 'amount', 'date',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
