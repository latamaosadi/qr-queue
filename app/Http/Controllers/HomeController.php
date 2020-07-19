<?php

namespace App\Http\Controllers;

use App\Counter;
use App\Customer;

class HomeController extends Controller
{
    public function index()
    {
        $lastCustomer = Customer::lastQueue()->first();
        $queue = $lastCustomer ? $lastCustomer->readableQueue : '#0000';

        $counters = Counter::with(['customers' => function ($query) {
            $query->processing();
        }])->where('status', 'active')->get();
        return view('home', compact('queue', 'counters'));
    }
}
