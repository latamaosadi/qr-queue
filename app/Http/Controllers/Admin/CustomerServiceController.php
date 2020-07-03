<?php

namespace App\Http\Controllers\Admin;

use App\CustomerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerService as Request;
use Illuminate\Support\Facades\Hash;

class CustomerServiceController extends Controller
{
    public function index()
    {
        $customerServices = CustomerService::all();
        return view('admin.customer_service.index', compact('customerServices'));
    }

    public function create()
    {
        return view('admin.customer_service.create');
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 'active';
        CustomerService::create($data);
        return redirect()->route('admin.cs.index');
    }

    public function show(CustomerService $customerService)
    {
        # code...
    }

    public function edit(CustomerService $customerService)
    {
        # code...
    }

    public function update(CustomerService $customerService, Request $request)
    {
        # code...
    }

    public function destroy(CustomerService $customerService)
    {
        # code...
    }
}
