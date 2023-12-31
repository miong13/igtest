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

    public function deleteEmployee(){
        $user = new Usermodel();

        $id = $this->request->getGet('id');

        $result['message'] = $user->deleteUser($id);
        // return $result;
        return $this->response->setJSON($result);
    }


    public function signin(){
		$user = new Usermodel();


		$email = $this->request->getGet('email');
		$passw = $this->request->getGet('pword');

		$result['message'] = $user->sign_in_api($email, $passw);
		// print_r($result);
		// return $result;
        return $this->response->setJSON($result);
	}

    public function registerWithPhoto(){
        $user = new Usermodel();
        
		$fname = $this->request->getPost('fullname');
		$photo = $this->request->getPost('photo');
		$email = $this->request->getPost('email');
		$passw = $this->request->getPost('pword');

        $result['message'] = $user->addNewUserWPhoto($fname, $photo, $email, $passw);
        return $this->response->setJSON($result);
    }

    public function editEmployeeWithPhoto(){
        $user = new Usermodel();

        $id = $this->request->getPost('id');
		$fname = $this->request->getPost('fullname');
		$telph = $this->request->getPost('photo');
		$email = $this->request->getPost('email');
		$passw = $this->request->getPost('pword');

        $result['message'] = $user->updateUserWPhoto($id, $fname, $telph, $email, $passw);

        // return $result;
        return $this->response->setJSON($result);
    }

}
