<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['option_id'];

    protected $connection= 'tenancy';
}
