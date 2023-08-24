<?php

namespace App\Controllers;

class Item extends BaseController
{
    public function index(): string
    {
        //print_r( array(1 =>'Calling index from Item controller'));
        //return '';
        
        $item_model = new \App\Models\ItemModel();
        $data['items'] = $item_model->findAll();
        return view('item/index',$data);
    }

    public function add() {
        $data = array();
        helper(['form']);
        if($this->request->getMethod() == 'post'){
            $post = $this->request->getPost(['name','price','description']);
            $rules = [
                'name' => ['label' => 'item name', 'rules' => 'required'],
                'price' => ['label' => 'price', 'rules' => 'required|numeric'],
                'description' => ['label' => 'description', 'rules' => 'required']
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                // dd($data['validation']->listErrors());
            } else {
                $item_model = new \App\Models\ItemModel();
                $item_model->save($post);
                return redirect()->to('item/index');
            }
        }
        return view('item/add',$data);
    }

    // public function insert() {
    //     if($this->request->getMethod() == 'post'){
    //         $post = $this->request->getPost(['name','price','description']);
    //         //dd($post);

    //         $rules = [];

    //         if (! $this->validate($rules)) {
    //             return view('signup');
    //         }


    //         $item_model = new \App\Models\ItemModel();
    //         $item_model->save($post);
    //         return redirect()->to('item/index');
    //     }
    // }

    public function view($id) {
        //dd($id);
        $item_model = new \App\Models\ItemModel();
        $data['item'] = $item_model->find($id);
        //dd($data['item']);
        return view('item/view',$data);
    }

    public function edit($id) {
        helper(['form']);
        if($this->request->getMethod() == 'post'){
          
            // dd($_POST);
            $post = $this->request->getPost(['name','price','description']);
            $post['name'] = strip_tags($post['name']);
            $post['description'] = strip_tags($post['description']);
            // dd($post);

            $rules = [
                'name' => ['label' => 'item name', 'rules' => 'required'],
                'price' => ['label' => 'price', 'rules' => 'required|numeric'],
                'description' => ['label' => 'description', 'rules' => 'required']
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
                // dd($data['validation']->listErrors());
            } else {
                $item_model = new \App\Models\ItemModel();
                $item_model->update($id, $post);
                return redirect()->to('item/index');
            }
        }


        $item_model = new \App\Models\ItemModel();
        $data['item'] = $item_model->find($id);
        //dd($data['item']);
        return view('item/edit',$data);
    }

    public function delete($id) {
        $item_model = new \App\Models\ItemModel();
        $data['item'] = $item_model->find($id);
        return view('item/delete',$data);
    }

    public function destroy($id){
        $item_model = new \App\Models\ItemModel();
        $item_model->delete($id);
        return redirect()->to('item/index');
    }


    public function test(){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblitem');
        $query   = $builder->get(); 
        $results = $query->getResult() ;
        dd($results);
        
    }

    // public function dd
}
