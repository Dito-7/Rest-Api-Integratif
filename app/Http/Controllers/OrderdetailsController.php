<?php

namespace App\Http\Controllers;

use App\Models\Orderdetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\Orderdetails as OrderdetailsResource;

class OrderdetailsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderdetails = Orderdetails::all();
        return $this->sendResponse(OrderdetailsResource::collection($orderdetails), 'Post Fetched');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'orderNumber' => 'required',
            'productCode' => 'required',
            'quantityOrdered' => 'required',
            'priceEach' => 'required',
            'orderLineNumber' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::table('orderdetails')->insert($input);

        $orderdetails = DB::table('orderdetails')->where('orderNumber', $input['orderNumber'])->first();

        return $this->sendResponse(new OrderdetailsResource($orderdetails), 'Post Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderdetails = Orderdetails::where('orderNumber', $id)->get();

        if ($orderdetails->isEmpty()) {
            return $this->sendError('No posts with orderNumber ' . $id . ' exist.');
        }
        return $this->sendResponse(
            OrderdetailsResource::collection($orderdetails),
            'Posts fetched.'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderNumber, $productCode)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'quantityOrdered' => 'required',
            'priceEach' => 'required',
            'orderLineNumber' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $existingOrderdetails = DB::table('orderdetails')
            ->where('orderNumber', $orderNumber)
            ->where('productCode', $productCode)
            ->first();

        if (is_null($existingOrderdetails)) {
            return $this->sendError('Product line does not exist.');
        }

        DB::table('orderdetails')
            ->where('orderNumber', $orderNumber)
            ->where('productCode', $productCode)
            ->update($input);

        $updatedOrderdetails = DB::table('orderdetails')
            ->where('orderNumber', $orderNumber)
            ->where('productCode', $productCode)
            ->first();

        return $this->sendResponse(new OrderdetailsResource($updatedOrderdetails), 'Product line updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($orderNumber, $productCode)
    {
        $existingOrderdetails = DB::table('orderdetails')
            ->where('orderNumber', $orderNumber)
            ->where('productCode', $productCode)
            ->first();

        if (is_null($existingOrderdetails)) {
            return $this->sendError('Order details does not exist.');
        }

        DB::table('orderdetails')
            ->where('orderNumber', $orderNumber)
            ->where('productCode', $productCode)
            ->delete();

        return $this->sendResponse([], 'Order details deleted.');
    }
}
