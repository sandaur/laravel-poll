<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votation extends Model
{
    protected $fillable = [
        'subdom',
        'title',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setting()
    {
        return $this->hasOne(Setting::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public static function isNameAvailable($subdomainName)
    {
        if (! preg_match('/^[\d\w]{4,18}$/', $subdomainName)){
            return false;
        }
        return ((new static)::where('subdom', $subdomainName)->first() == null);
    }
}
