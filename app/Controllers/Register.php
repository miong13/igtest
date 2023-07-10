<?php

namespace App\Controllers;
use App\Models\UserModel;


class Register extends BaseController
{
    public function index()
    {
        $data['page_title'] = 'Register';
        $data['page'] = 'register';
        // print_r($session);
        return view('register', $data);
    }

    public function add(){
        $user = new Usermodel();

		$fname = $this->request->getPost('f');
		$telph = $this->request->getPost('t');
		$email = $this->request->getPost('e');
		$passw = $this->request->getPost('p');

        $result = $user->addNewUser($fname, $telph, $email, $passw);
        return $result;
    }

    // public function delete(){
    //     $user = new Usermodel();

	// 	$uid = $this->request->getPost('i');

    //     $result = $user->deleteUser($uid);
    //     return $result;
    // }

    // public function edit(){
    //     $user = new Usermodel();

	// 	$uid = $this->request->getPost('i');
	// 	$fname = $this->request->getPost('f');
	// 	$telph = $this->request->getPost('t');
	// 	$email = $this->request->getPost('e');
	// 	$passw = $this->request->getPost('p');

    //     $result = $user->updateUser($uid, $fname, $telph, $email, $passw);
    //     return $result;
    // }


}
