<?php

namespace Database\Seeders;

use App\Models\PermissionRole;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    protected $data = [
        [
            1 => 1,
        ],
        [
            1 => 2,
        ],
        [
            2 => 1,
        ],
        [
            6 => 1,
        ],
        [
            7 => 1,
        ],
        [
            7 => 2,
        ],
        [
            3 => 1,
        ],
        [
            3 => 2,
        ],
        [
            4 => 1,
        ],
        [
            5 => 1,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data as $k => $v) {
            PermissionRole::create([
                'permission_id' => $k,
                'role_id'       => $v,
            ]);
        }
    }
}
