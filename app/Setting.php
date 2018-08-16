<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'admition_type',
        'user_enc',
        'auth_cu',
        'auth_email',
        'auth_rut',
        'auto_start',
        'auto_end',
        'start_time',
        'end_time',
        'votation_id',
    ];

    protected $dates = ['start_time', 'end_time'];

    public function votation()
    {
        return $this->belongsTo(Votation::class);
    }
}
