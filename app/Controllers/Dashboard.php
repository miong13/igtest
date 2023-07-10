<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
// use App\Models\PreEmploymentModel;
// use App\Libraries\SupaDupaClass;


class Dashboard extends BaseController
{

	public function index()
	{
		// return view('welcome_message');
		// $data['page'] = $uri->getSegment(3);
		// helper('url');
		$session = session();
		if(!isset($_SESSION['uuid']) || !isset($_SESSION['ulevel'])){
			header('location: /');
			exit();
		}


		$data['page'] = $this->request->uri->getSegments();
		$user = new Usermodel();

		// $uuid = 1;
		// $user_data = $user->user_data($_SESSION['uuid']);

		// $data['name_of_user'] = $user->full_name($user_data);
		$data['fullname'] = $user->getFullName($_SESSION['uuid']);
		$data['page_title'] = 'Dashboard';
		return view('dashboard', $data);
	}

	public function login(){
		$user = new Usermodel();


		$email = $this->request->getPost('e');
		$passw = $this->request->getPost('p');

		$result = $user->sign_in($email, $passw);
		// print_r($result);
		return $result;
	}

	public function logout(){
		// session_start();
		$session = session();
		$session->destroy();
		// if(isset($_SESSION['uuid'])){
			// session_unset();
			// session_destroy();
			// // redirect(base_url());
			header('location: '.base_url());
			exit();
		// }
	}
	//--------------------------------------------------------------------

	public function save_initsched(){

		if(!isset($_SESSION['uuid']) || !isset($_SESSION['ulevel'])){
			return false;
		}

		$txtSetTestSchedDate = $this->request->getPost('txtSetTestSchedDate');
		$txtSetTestSchedTime = $this->request->getPost('txtSetTestSchedTime');
		$txtAppDate = $this->request->getPost('txtAppDate');
		$txtPosition = $this->request->getPost('txtPosition');
		$txtFName = $this->request->getPost('txtFName');
		$txtMName = $this->request->getPost('txtMName');
		$txtLName = $this->request->getPost('txtLName');
		$txtEmail = $this->request->getPost('txtEmail');
		$txtContactNum = $this->request->getPost('txtContactNum');
		$txtAddress = $this->request->getPost('txtAddress');
		$txtSource = $this->request->getPost('txtSource');
		$txtNotes = $this->request->getPost('txtNotes');

		$array_data = [
			"txtSetTestSchedDate" => $txtSetTestSchedDate,
			'txtSetTestSchedTime' => $txtSetTestSchedTime,
			'txtAppDate' => $txtAppDate,
			'txtPosition' => $txtPosition,
			'txtFName' => $txtFName,
			'txtMName' => $txtMName,
			'txtLName' => $txtLName,
			'txtEmail' => $txtEmail,
			'txtContactNum' => $txtContactNum,
			'txtAddress' => $txtAddress,
			'txtSource' => $txtSource,
			'txtNotes' => $txtNotes,
			'user_id' => $_SESSION['uuid']
		];

		$pm = new PreEmploymentmodel();
		$pm->schedules($array_data, 'Initial Interview');
		//save employee
		//`fname`, `mname`, `lname`, `contact_number`, `address`, `bday`, `date_applied`, `date_added`, `addedby`
		//save registered_tester
		//schedules
		//`sid`, `uuid`, `value`, `status`, `added_by`, `date_added`, `date_modified`
	}

	public function schedlist(){
		if(!isset($_SESSION['uuid']) || !isset($_SESSION['ulevel'])){
			return false;
		}

		$pm = new PreEmploymentmodel();
		// $pm->getAllSchedules();
		$status =  $this->request->getPost('status');
		$pm->getSchedules($status);
	}

}
