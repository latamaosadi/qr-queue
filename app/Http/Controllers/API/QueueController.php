<?php

namespace App\Http\Controllers\API;

use App\Counter;
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

        $counters = Counter::with(['customers' => function ($query) {
            $query->processing();
        }])->where('status', 'active')->get();
        $currentCustomer = Customer::processing()->orderBy('created_at', 'desc')->first();
        $currentQueue = $currentCustomer ? $currentCustomer->readableQueue : '#0000';

        return compact('counters') + [
            'inline' => $inline->count(),
            'done' => $done->count(),
            'absent' => $absent->count(),
            'current_queue' => $currentQueue,
        ];
    }

    public function current(Counter $counter)
    {
        $customer = Customer::where('counter_id', $counter->id)->processing()->orderBy('created_at', 'asc')->first();
        return $customer;
    }

    public function process(Counter $counter, Request $request)
    {
        $nextCustomer = Customer::inline()->orderBy('queue', 'asc')->first();

        $nextCustomer->queue_status = QueueStatus::CALLED;
        $nextCustomer->counter_id = $counter->id;
        $nextCustomer->customer_service_id = $counter->customerService->id;
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
            $nextCustomer->counter_id = $customer->counter_id;
            $nextCustomer->customer_service_id = $customer->customer_service_id;
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
            $nextCustomer->counter_id = $customer->counter_id;
            $nextCustomer->customer_service_id = $customer->customer_service_id;
            $nextCustomer->save();

            return $nextCustomer;
        }

        return $customer;
    }

}
