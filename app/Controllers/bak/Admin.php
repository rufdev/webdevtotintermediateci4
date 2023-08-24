<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function login()
    {
        if($this->request->getMethod() == 'post'){
            $post = $this->request->getPost(['email','password']);
            // dd($post);
            $admin_model = new \App\Models\AdminModel();
            $admin = $admin_model->where('email',$post['email'])
            ->where('password', sha1($post['password']))
            ->first();
            $session = session();
            if(!$admin){
                // dd('invalid');
                
                $session->setflashdata('invalid','Ivalid username or password');
            } else {
                $this->setAdminSession($admin);
                return redirect()->to('item/index');
            }
        }
     echo view('admin/login');
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('admin/login');
    }


    public function setAdminSession($admin){
        $data = [
            'id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'isAdminLoggedIn' => true,
        ];
        session()->set($data);
    }

    public function test(): string {
        return '$test';
    }
}