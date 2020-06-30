<?php

namespace App\Http\Controllers\API;

use App\Customer;
use App\Http\Controllers\Controller;
use App\QueueStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function stats()
    {
        $inline = Customer::inline()->get();
        $done = Customer::done()->get();
        $absent = Customer::absent()->get();

        return [
            'inline' => $inline->count(),
            'done' => $done->count(),
            'absent' => $absent->count(),
        ];
    }

    public function current()
    {
        $customer = Customer::processing()->orderBy('created_at', 'asc')->first();
        return $customer;
    }

    public function process(Request $request)
    {
        $nextCustomer = Customer::inline()->orderBy('queue', 'asc')->first();
        $nextCustomer->queue_status = QueueStatus::CALLED;
        $nextCustomer->save();

        return $nextCustomer;
    }

    public function confirm(Customer $customer)
    {
        $customer->queue_status = QueueStatus::HANDLED;
        $customer->interview_start_at = Carbon::now();
        $customer->save();

        return $customer;
    }

    public function skipQueue(Customer $customer, Request $request)
    {
        $customer->queue_status = QueueStatus::ABSENT;
        $customer->save();

        if ($request->input('process_new', false)) {
            $nextCustomer = Customer::inline()->orderBy('queue', 'asc')->first();
            $nextCustomer->queue_status = QueueStatus::CALLED;
            $nextCustomer->save();

            return $nextCustomer;
        }

        return $customer;
    }

    public function finish(Customer $customer, Request $request)
    {
        $customer->queue_status = QueueStatus::DONE;
        $customer->interview_finished_at = Carbon::now();
        $customer->save();

        if ($request->input('process_new', false)) {
            $nextCustomer = Customer::inline()->orderBy('queue', 'asc')->first();
            $nextCustomer->queue_status = QueueStatus::CALLED;
            $nextCustomer->save();

            return $nextCustomer;
        }

        return $customer;
    }

}
