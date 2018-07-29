<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'name', 'description','image','votation_id'
    ];

    public function options()
    {
        return $this->belongsTo(Votation::class);
    }
}
