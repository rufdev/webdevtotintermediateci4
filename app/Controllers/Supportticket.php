<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;

class Supportticket extends BaseController
{
    public function index()
    {
       
        $office = new \App\Models\Offices();
        $data['offices'] = $office->findAll();
        return view('supportticket/index', $data);
    }

    public function getall()
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $searchValue = $postData['search']['value']; // Search value

        ## Total number of records without filtering
        $supportticket = new \App\Models\Supporttickets();
        if (auth()->user()->inGroup('superadmin')) {
            $totalRecords = $supportticket->select('id')->countAllResults();
            ## Total number of records with filtering
            $totalRecordwithFilter = $supportticket->select('id')
                ->orLike('firstname', $searchValue)
                ->orLike('lastname', $searchValue)
                ->orLike('description', $searchValue)
                ->countAllResults();

            ## Fetch records
            $records = $supportticket->select('supporttickets.*, offices.name as office_name')
                ->join('offices', 'offices.id = supporttickets.officeid')
                ->orLike('supporttickets.firstname', $searchValue)
                ->orLike('supporttickets.lastname', $searchValue)
                ->orLike('supporttickets.description', $searchValue)
                ->orderBy('supporttickets.created_at', 'asc')
                ->findAll($rowperpage, $start);
        } else {
            $totalRecords = $supportticket->select('id')->where('userid', auth()->id())->countAllResults();

            ## Total number of records with filtering
            $totalRecordwithFilter = $supportticket->select('id')
                ->where('userid', auth()->id())
                ->groupStart()
                ->orLike('firstname', $searchValue)
                ->orLike('lastname', $searchValue)
                ->orLike('description', $searchValue)
                ->groupEnd()
                ->countAllResults();

            ## Fetch records
            $records = $supportticket->select('supporttickets.*, offices.name as office_name')
                ->join('offices', 'offices.id = supporttickets.officeid')
                ->where('supporttickets.userid', auth()->id())
                ->groupStart()
                ->orLike('supporttickets.firstname', $searchValue)
                ->orLike('supporttickets.lastname', $searchValue)
                ->orLike('supporttickets.description', $searchValue)
                ->groupEnd()
                ->orderBy('supporttickets.created_at', 'asc')
                ->findAll($rowperpage, $start);
        }

        $data = array();

        foreach ($records as $record) {

            $data[] = array(
                "id" => $record['id'],
                "state" => $record['state'],
                "firstname" => $record['firstname'],
                "lastname" => $record['lastname'],
                "email" => $record['email'],
                "officeid" => $record['officeid'],
                "office_name" => $record['office_name'],
                "severity" => $record['severity'],
                "description" => $record['description'],
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data" => $data,
            "token" => csrf_hash() // New token hash
        );
        return $this->response->setJSON($response);
    }

    public function getbyid($id)
    {
        $office = new \App\Models\Supporttickets();
        $data = $office->find($id);
        return $this->response->setJSON($data);
    }


    public function create()
    {
        $request = service('request');
        $postData = $request->getPost();
        $office = new \App\Models\Supporttickets();
        $postData['state'] = 'PENDING';
        $postData['userid'] = auth()->id();

        if (!$office->validate($postData)) {
            $response = array(
                "status" => "error",
                "message" => $office->errors(),
                "token" => csrf_hash() // New token hash
            );
            return $this->response->setJSON($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $office->insert($postData);
        $response = array(
            "status" => "success",
            "message" => "Office created successfully",
            "token" => csrf_hash() // New token hash
        );
        return $this->response->setJSON($response);
    }

    public function update($id)
    {

        $request = service('request');
        $postData = $request->getRawInput();
        $office = new \App\Models\Supporttickets();

        if (!$office->validate($postData)) {
            $response = array(
                "status" => "error",
                "message" => $office->errors(),
                "token" => csrf_hash() // New token hash
            );
            return $this->response->setJSON($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        $data = $office->find($id);
        if ($data['state'] === 'RESOLVED') {
            $response = array(
                "status" => "error",
                "message" => "The ticket is already resolved",
                "token" => csrf_hash() // New token hash
            );
            return $this->response->setJSON($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        if (isset($postData['state']) && $postData['state'] !== $data['state'] && auth()->user()->inGroup('superadmin')) {
            // The state value has changed
            if ($postData['state'] === 'PROCESSING' || $postData['state'] === 'RESOLVED') {
                $postData['actedbyuserid'] = auth()->id();
            }
        } else {
            unset($postData['state']);
        }


        $office->update($id, $postData);
        $response = array(
            "status" => "success",
            "message" => "Office updated successfully",
            "token" => csrf_hash() // New token hash
        );
        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $office = new \App\Models\Supporttickets();
        $data = $office->find($id);
        if ($data['state'] === 'RESOLVED') {
            $response = array(
                "status" => "error",
                "message" => "The ticket is already resolved",
                "token" => csrf_hash() // New token hash
            );
            return $this->response->setJSON($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $office->delete($id);
        $response = array(
            "status" => "success",
            "message" => "Office deleted successfully",
            "token" => csrf_hash() // New token hash
        );
        return $this->response->setJSON($response);
    }
}
