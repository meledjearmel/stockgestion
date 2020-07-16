<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Employe extends Model
{
    use HasRoles;

    public function __construct()
    {
        $this->table = 'users';
    }

    public static function all($columns = ['*'])
    {
        return self::query()
            ->where('level', '=', 0)
            ->get(
                is_array($columns) ? $columns : func_get_args()
            );
    }

    protected $fillable = [
        'name', 'lastname', 'contact', 'level', 'picture', 'username', 'email', 'password',
    ];

    protected $guard_name = 'web';

    public function sellpoint()
    {
        return $this->belongsTo(Sellpoint::class);
    }

}
