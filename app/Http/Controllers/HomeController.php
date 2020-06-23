<?php

namespace App\Http\Controllers;

use App\Customer;

class HomeController extends Controller
{
    public function index()
    {
        $lastCustomer = Customer::lastQueue()->first();
        $queue = $lastCustomer ? $lastCustomer->queue : 0;
        return view('home', compact('queue'));
    }
}
