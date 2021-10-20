<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permissions;

class PermissionSeeder extends Seeder
{
    private $data = [
        [
            'name'     => 'view_admin',
        ],
        [
            'name'     => 'create_post',
        ],
        [
            'name'     => 'delete_post',
        ],
        [
            'name'     => 'create_user',
        ],
        [
            'name'     => 'delete_user',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data as $data) {
            Permissions::create([
                'name'     => $data['name'],
            ]);
        }
    }
}
