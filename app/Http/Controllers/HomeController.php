<?php

namespace App\Http\Controllers;

use App\Counter;
use App\Customer;

class HomeController extends Controller
{
    public function index()
    {
        // Get last queue
        $lastCustomer = Customer::lastQueue()->first();
        $queue = $lastCustomer ? $lastCustomer->readableQueue : '#0000';

        // Get last queue
        $currentCustomer = Customer::processing()->orderBy('created_at', 'desc')->first();
        $currentQueue = $currentCustomer ? $currentCustomer->readableQueue : '#0000';

        // Get inline amount
        $inlineCount = Customer::inline()->count();

        // Get counters with queue
        $counters = Counter::with(['customers' => function ($query) {
            $query->processing();
        }])->where('status', 'active')->get();

        return view('home', compact('queue', 'counters', 'inlineCount', 'currentQueue'));
    }
}
