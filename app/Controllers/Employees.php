<?php

namespace App\Controllers;


class Employees extends BaseController
{
    public function index()
    {

        $data['page_title'] = 'Employees';
        $data['page'] = 'employees';
        return view('employees', $data);
    }

}
