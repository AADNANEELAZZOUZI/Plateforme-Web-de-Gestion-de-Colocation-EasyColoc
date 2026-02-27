<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Colocation extends Model
{
       protected $fillable =
    [
        'name','status','created_at','cancelled_at',
    ];

    public function dépenses()
    {
        return $this->hasMany(Dépense::class);
    }
}
