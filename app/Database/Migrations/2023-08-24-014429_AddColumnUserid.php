<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnUserid extends Migration
{
    public function up()
    {
        $this->forge->addColumn('supporttickets', [
            'userid' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'id'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supporttickets', 'userid');
    }
}
