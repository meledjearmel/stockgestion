<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'user_id');
    }

    public function sellpoint()
    {
        return $this->belongsTo(Sellpoint::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
