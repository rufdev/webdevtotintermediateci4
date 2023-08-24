<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnActedbyuser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('supporttickets', [
            'actedbyuserid' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'userid'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supporttickets', 'actedbyuserid');
    }
}
