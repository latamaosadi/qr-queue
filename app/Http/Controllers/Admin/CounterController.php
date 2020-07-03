<?php

namespace App\Http\Controllers\Admin;

use App\Counter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Counter as Request;

class CounterController extends Controller
{
    public function index()
    {
        $counters = Counter::all();
        return view('admin.counter.index', compact('counters'));
    }

    public function create()
    {
        return view('admin.counter.create');
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        $data['status'] = 'active';
        Counter::create($data);
        return redirect()->route('admin.counter.index');
    }

    public function show(Counter $counter)
    {
        # code...
    }

    public function edit(Counter $counter)
    {
        return $counter->customerService;
    }

    public function update(Counter $counter, Request $request)
    {
        # code...
    }

    public function destroy(Counter $counter)
    {
        # code...
    }
}
