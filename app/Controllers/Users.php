<?php

namespace App\Controllers;
use App\Models\UserModel;


class Users extends BaseController
{
    public function index()
    {
		$session = session();
		if(!isset($_SESSION['uuid']) || !isset($_SESSION['ulevel'])){
			header('location: /');
			exit();
		}

        $user = new Usermodel();

        $data['users_table'] = $user->listUsersTable();
        $data['page_title'] = 'Users';
        $data['page'] = 'users';
        $data['fullname'] = $user->getFullName($_SESSION['uuid']);
        // print_r($session);
        return view('users', $data);
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

    public function delete(){
        $user = new Usermodel();

		$uid = $this->request->getPost('i');

        $result = $user->deleteUser($uid);
        return $result;
    }

    public function edit(){
        $user = new Usermodel();

		$uid = $this->request->getPost('i');
		$fname = $this->request->getPost('f');
		$telph = $this->request->getPost('t');
		$email = $this->request->getPost('e');
		$passw = $this->request->getPost('p');

        $result = $user->updateUser($uid, $fname, $telph, $email, $passw);
        return $result;
    }


}
