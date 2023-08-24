<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnState extends Migration
{
    public function up()
    {
        $this->forge->addColumn('supporttickets', [
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'severity'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supporttickets', 'state');
    }
}
