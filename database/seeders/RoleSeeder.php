<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private $data = [
        [
            'name'     => 'Менеджер',
        ],
        [
            'name'     => 'Сотрудник',
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
            Roles::create([
                'name'     => $data['name'],
            ]);
        }
    }
}
