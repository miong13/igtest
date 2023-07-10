<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index()
    {
		$data = [
			'hello' => 'hello world'
		];
		
        // echo $_SESSION['uuid'];

        return view('login', $data);
    }

}
