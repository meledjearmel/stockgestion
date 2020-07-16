<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sellpoint extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function articles ()
    {
        return $this->belongsToMany(Article::class)->withPivot('quantity')->withTimestamps();;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'name', 'location'
    ];
}
