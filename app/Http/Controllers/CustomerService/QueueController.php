<?php

namespace App\Http\Controllers\CustomerService;

use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    public function index()
    {
        return view('cs.queue');
    }
}
