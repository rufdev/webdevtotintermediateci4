<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;

class Office extends BaseController
{
    public function index()
    {
        return view('office/index');
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
        $office = new \App\Models\Offices();
        $totalRecords = $office->select('id')->countAllResults();

        ## Total number of records with filtering
        $totalRecordwithFilter = $office->select('id')
            ->orLike('name', $searchValue)
            ->orLike('code', $searchValue)
            ->orLike('description', $searchValue)
            ->countAllResults();

        ## Fetch records
        $records = $office->select('*')
            ->orLike('name', $searchValue)
            ->orLike('code', $searchValue)
            ->orLike('description', $searchValue)
            ->orderBy('name', 'asc')
            ->findAll($rowperpage, $start);

        $data = array();

        foreach ($records as $record) {

            $data[] = array(
                "id" => $record['id'],
                "name" => $record['name'],
                "code" => $record['code'],
                "description" => $record['description']
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
        $office = new \App\Models\Offices();
        $data = $office->find($id);
        return $this->response->setJSON($data);
    }


    public function create(){
        $request = service('request');
        $postData = $request->getPost();
        $office = new \App\Models\Offices();

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

    public function update($id){

        $request = service('request');
        $postData = $request->getRawInput();
        $office = new \App\Models\Offices();

        if (!$office->validate($postData)) {
            $response = array(
                "status" => "error",
                "message" => $office->errors(),
                "token" => csrf_hash() // New token hash
            );
            return $this->response->setJSON($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    
        $office->update($id, $postData);
        $response = array(
            "status" => "success",
            "message" => "Office updated successfully",
            "token" => csrf_hash() // New token hash
        );
        return $this->response->setJSON($response);
    }

    public function delete($id){
        $office = new \App\Models\Offices();
        $office->delete($id);
        $response = array(
            "status" => "success",
            "message" => "Office deleted successfully",
            "token" => csrf_hash() // New token hash
        );
        return $this->response->setJSON($response);
    }
}
