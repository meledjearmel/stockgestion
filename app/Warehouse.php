<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function articles ()
    {
        return $this->belongsToMany(Article::class)->withPivot('quantity')->withTimestamps();
    }

    protected $fillable = [
        'name', 'capacity', 'location'
    ];
}
