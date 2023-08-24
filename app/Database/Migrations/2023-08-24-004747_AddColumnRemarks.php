<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnRemarks extends Migration
{
    public function up()
    {
        $this->forge->addColumn('supporttickets', [
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'description'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('supporttickets', 'remarks');
    }
}
