<?php

namespace App\Controllers;
use App\Models\UserModel;


class Api extends BaseController
{
    public function index()
    {

    }

    public function listEmployee(){
        $user = new Usermodel();
        $result = $user->apiListEmployee();
        
        return $this->response->setJSON($result);
    }

    public function employeeByEmail(){
        $user = new Usermodel();
        $email = $this->request->getGet('email');
        // $email = $this->request->getPost('email');
        $result = $user->apiEmployeeByEmail($email);
        
        return $this->response->setJSON($result);
    }

    public function addEmployee(){
        $user = new Usermodel();

		$fname = $this->request->getGet('fullname');
		$telph = $this->request->getGet('tel');
		$email = $this->request->getGet('email');
		$passw = $this->request->getGet('pword');

        $result['message'] = $user->addNewUser($fname, $telph, $email, $passw);
        // return $result;
        return $this->response->setJSON($result);
    }

    public function editEmployee(){
        $user = new Usermodel();

        $id = $this->request->getGet('id');
		$fname = $this->request->getGet('fullname');
		$telph = $this->request->getGet('tel');
		$email = $this->request->getGet('email');
		$passw = $this->request->getGet('pword');

        $result['message'] = $user->updateUser($id, $fname, $telph, $email, $passw);
        // return $result;
        return $this->response->setJSON($result);
    }


    public function signin(){
		$user = new Usermodel();


		$email = $this->request->getGet('email');
		$passw = $this->request->getGet('pword');

		$result['message'] = $user->sign_in($email, $passw);
		// print_r($result);
		// return $result;
        return $this->response->setJSON($result);
	}


}
