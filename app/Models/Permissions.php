<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    public function role()
    {
        return $this->belongsToMany('App\Models\Roles', 'permission_role', 'permission_id', 'role_id');
    }
}
