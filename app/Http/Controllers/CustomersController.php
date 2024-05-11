<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Customers as CustomersResources;

class CustomersController extends BaseController
{
    public function index()
    {
        $customers = Customers::all();
        return $this->sendResponse(CustomersResources::collection($customers), "Post Fetched");
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'customerNumber' => 'required',
            'customerName' => 'required',
            'contactLastName' => 'required',
            'contactFirstName' => 'required',
            'phone' => 'required|numeric',
            'addressLine1' => 'required',
            'addressLine2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postalCode' => 'required',
            'country' => 'required',
            'salesRepEmployeeNumber' => 'required|numeric',
            'creditLimit' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::table('customers')->insert($input);

        $customer = DB::table('customers')->where('customerNumber', $input['customerNumber'])->first();

        return $this->sendResponse(new CustomersResources($customer), 'Post Created.');

    }

    public function show($customerNumber)
    {
        $customer = DB::table('customers')->where('customerNumber', $customerNumber)->first();
        if (is_null($customer)) {
            return $this->sendError('Post does not exits.');
        }
        return $this->sendResponse(new CustomersResources($customer), 'Post fetched.');
    }

    public function update(Request $request, $customerNumber)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'customerNumber' => 'required',
            'customerName' => 'required',
            'contactLastName' => 'required',
            'contactFirstName' => 'required',
            'phone' => 'required|numeric',
            'addressLine1' => 'required',
            'addressLine2' => '',
            'city' => 'required',
            'state' => '',
            'postalCode' => '',
            'country' => 'required',
            'salesRepEmployeeNumber' => 'required|numeric',
            'creditLimit' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $existingCustomer = DB::table('customers')
            ->where('customerNumber', $customerNumber)
            ->first();

        if (is_null($existingCustomer)) {
            return $this->sendError('Customer does not exist.');
        }

        DB::table('customers')
            ->where('customerNumber', $customerNumber)
            ->update($input);

        $updatedCustomer = DB::table('customers')
            ->where('customerNumber', $input['customerNumber'])
            ->first();

        return $this->sendResponse(new CustomersResources($updatedCustomer), 'Customer updated.');
    }

    public function destroy($customerNumber)
    {
        $existingCustomer = DB::table('customers')
            ->where('customerNumber', $customerNumber)
            ->first();

        if (is_null($existingCustomer)) {
            return $this->sendError('Customer does not exist.');
        }

        DB::table('customers')
            ->where('customerNumber', $customerNumber)
            ->delete();

        return $this->sendResponse([], 'Customer deleted.');
    }
}
