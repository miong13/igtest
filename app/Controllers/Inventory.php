<?php

namespace App\Controllers;


class Inventory extends BaseController
{
    public function index()
    {

        $data['page_title'] = 'Inventory';
        $data['page'] = 'inventory';
        return view('inventory', $data);
    }

}
