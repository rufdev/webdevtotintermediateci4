<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {

        //insert array of roles
        

        $data = [
            [
                'name' => 'ADMIN',
                'code'    => 'ADMIN',
                'description'    => 'ADMIN',
            ],
            [
                'name' => 'GUEST',
                'code'    => 'GUEST',
                'description'    => 'GUEST',
            ],
            [
                'name' => 'ENCODER',
                'code'    => 'ENCODER',
                'description'    => 'ENCODER',
            ]
        ];



        // Simple Queries
        // $this->db->query('INSERT INTO roles (name, code, description) VALUES(:name:, :code:, :description:)', $data);

        // Using Query Builder
        $this->db->table('roles')->insertBatch($data);

    }
}
