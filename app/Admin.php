<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function __construct()
    {
        $this->table = 'users';
    }

    public static function all($columns = ['*'])
    {
        return self::query()
            ->where('level', '=', 1)
            ->get(
                is_array($columns) ? $columns : func_get_args()
            );
    }

    protected $fillable = [
        'name', 'lastname', 'contact', 'level', 'picture', 'username', 'email', 'password',
    ];

    protected $guard_name = 'web';

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class, 'admin_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'admin_id');
    }

    public function sellpoints()
    {
        return $this->hasMany(Sellpoint::class, 'admin_id');
    }
}
