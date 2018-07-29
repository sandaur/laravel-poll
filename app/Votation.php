<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votation extends Model
{
    protected $fillable = [
        'subdom', 'title', 'description','start_time','end_time','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
