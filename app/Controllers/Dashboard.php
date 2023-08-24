<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {   
        if (!auth()->user()->inGroup('superadmin')){
            return redirect()->to(base_url("supportticket"));
        }
         // Create a new Supporttickets model
         $supportticket = new \App\Models\Supporttickets();
        
         // Get the total number of tickets by severity
         $totalseverity = $supportticket->select('severity, count(*) as total')
             ->groupBy('severity')
             ->findAll();
 
         // Loop through the results and store them in an array
         foreach ($totalseverity as $row) {
             $data['totalseverity'][$row['severity']] = $row['total'];
         }
 
         // Get the total number of tickets by state
         $totalseverity = $supportticket->select('state, count(*) as total')
         ->groupBy('state')
         ->findAll();
 
         // Loop through the results and store them in an array
         foreach ($totalseverity as $row) {
             $data['totalstate'][$row['state']] = $row['total'];
         }
 
         // Get the total number of tickets
         $data['totaltickets'] = $supportticket->select('id')->countAllResults();
 
         // Create a new Offices model
         $office = new \App\Models\Offices();
 
         // Get all the offices
         $data['offices'] = $office->findAll();
 
         // Load the dashboard view with the data
         return view('dashboard/index',$data);
    }
}