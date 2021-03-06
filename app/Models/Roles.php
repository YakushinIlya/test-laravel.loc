<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'range', 'position'
    ];

    public function user()
    {
        return $this->belongsToMany('App\Models\User', 'user_role', 'role_id', 'user_id');
    }

    public function permission()
    {
        return $this->belongsToMany('App\Models\Permissions', 'permission_role', 'role_id', 'permission_id');
    }

    public static function allow(int $role_id, string $permission)
    {
        $permissions = self::find($role_id)->permission->toArray();
        foreach($permissions as $p) {
            if($permission==$p['name']) {
                return true;
            }
        }
        return false;
    }
}
