<?php

namespace App\Models;

use CodeIgniter\Model;

class Supporttickets extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'supporttickets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['firstname', 'lastname', 'email', 'officeid', 'state','userid','actedbyuserid', 'remarks', 'severity', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|valid_email',
        'officeid' => 'required',
        'state' => 'required',
        'severity' => 'required',
        'userid' => 'required',
        'description' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Relationship
    protected $returnTypeRelations  = 'array';
    protected $belongsTo            = [
        'office' => [
            'model' => 'App\Models\Office',
            'foreign_key' => 'officeid'
        ],
        'users' => [
            'model' => 'CodeIgniter\Shield\Entities\User',
            'foreign_key' => 'userid'
        ],
        'users' => [
            'model' => 'CodeIgniter\Shield\Entities\User',
            'foreign_key' => 'actedbyuserid'
        ]
    ];

}
