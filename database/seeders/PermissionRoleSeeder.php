<?php

namespace Database\Seeders;

use App\Models\PermissionRole;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    protected $data = [

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionRole::create([
            'permission_id' => 1,
            'role_id'       => 1,
        ]);
    }
}
