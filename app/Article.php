<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function warehouses ()
    {
        return $this->belongsToMany(Warehouse::class)->withPivot('quantity')->withTimestamps();
    }

    public function sellpoints()
    {
        return $this->belongsToMany(Warehouse::class)->withPivot('quantity')->withTimestamps();
    }

    protected $fillable = [
        'code', 'name', 'caracts', 'img_url', 'price',
    ];
}
