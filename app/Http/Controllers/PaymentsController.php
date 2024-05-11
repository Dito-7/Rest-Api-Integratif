<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Payments as PaymentResource;
use App\Http\Controllers\BaseController as BaseController;

class PaymentsController extends BaseController
{
    public function index()
    {
        $payments = Payments::all();
        return $this->sendResponse(PaymentResource::collection($payments), 'Post Fetched');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'customerNumber' => 'required|numeric',
            'checkNumber' => 'required|string',
            'paymentDate' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::table('payments')->insert($input);

        $payments = DB::table('payments')->where('customerNumber', $input['customerNumber'])->first();

        return $this->sendResponse(new PaymentResource($payments), 'Post Created.');
    }

    public function show($id)
    {
        $payments = Payments::where('customerNumber', $id)->first();
        if (is_null($payments)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new PaymentResource($payments), 'Post Fetched.');
    }

    public function update(Request $request, $customerNumber, $checkNumber)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'customerNumber' => 'required|numeric',
            'checkNumber' => 'required|string',
            'paymentDate' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $existingPayments = DB::table('payments')
            ->where('customerNumber', $customerNumber)
            ->where('checkNumber', $checkNumber)
            ->first();

        if (is_null($existingPayments)) {
            return $this->sendError('Payments does not exist.');
        }

        DB::table('payments')
            ->where('customerNumber', $customerNumber)
            ->where('checkNumber', $checkNumber)
            ->update($input);

        $updatedPayments = DB::table('payments')
            ->where('customerNumber', $customerNumber)
            ->where('checkNumber', $checkNumber)
            ->first();

        return $this->sendResponse(new PaymentResource($updatedPayments), 'Payments updated.');
    }

    public function destroy($customerNumber, $checkNumber)
    {
        $existingPayments = DB::table('payments')
            ->where('customerNumber', $customerNumber)
            ->where('checkNumber', $checkNumber)
            ->first();

        if (is_null($existingPayments)) {
            return $this->sendError('Payments does not exist.');
        }

        DB::table('payments')
            ->where('customerNumber', $customerNumber)
            ->where('checkNumber', $checkNumber)
            ->delete();

        return $this->sendResponse([], 'Payments deleted.');
    }
}
