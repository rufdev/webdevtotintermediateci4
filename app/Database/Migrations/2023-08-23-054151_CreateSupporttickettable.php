<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupporttickettable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'auto_increment'    => true,
            ],
            'name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '200',
            ],
            'code' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'description' => [
                'type'              => 'TEXT',
            ],
            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('offices');

        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'auto_increment'    => true,
            ],
            'firstname' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'lastname' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'officeid' => [
                'type'              => 'INT',
            ],
            'description' => [
                'type'              => 'TEXT',
            ],
            'severity' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
            ],
            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        // $this->forge->addKey('officeid',true);
        $this->forge->addForeignKey('officeid', 'offices', 'id');
        $this->forge->createTable('supporttickets');
   

       
    }

    public function down()
    {
        //drop table
        $this->forge->dropTable('supporttickets');
        $this->forge->dropTable('offices');
    }
}
