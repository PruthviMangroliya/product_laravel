<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function get_customer()
    {
        if (!$_POST) {
        
           CustomerModel::all();

        }
    }
}
