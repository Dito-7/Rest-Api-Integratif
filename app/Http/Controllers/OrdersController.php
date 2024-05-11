<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Orders as OrderResource;

class OrdersController extends BaseController
{
    public function index()
    {
        $orders = Orders::all();
        return $this->sendResponse(OrderResource::collection($orders), 'Post Fetched');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'orderNumber' => 'required',
            'orderDate' => 'required',
            'requiredDate' => 'required',
            'shippedDate' => 'required',
            'status' => 'required',
            'comments' => 'required',
            'customerNumber' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::table('orders')->insert($input);

        $orders = DB::table('orders')->where('orderNumber', $input['orderNumber'])->first();

        return $this->sendResponse(new OrderResource($orders), 'Post Created.');
    }

    public function show($id)
    {
        $orders = DB::table('orders')->where('orderNumber', $id)->first();

        if (is_null($orders)) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse(new OrderResource($orders), 'Post retrieved successfully.');
    }

    public function update(Request $request, $orderNumber)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'orderNumber' => 'required',
            'orderDate' => 'required',
            'requiredDate' => 'required',
            'shippedDate' => 'required',
            'status' => 'required',
            'comments' => 'required',
            'customerNumber' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $existingOrder = DB::table('orders')
            ->where('orderNumber', $orderNumber)
            ->first();

        if (is_null($existingOrder)) {
            return $this->sendError('Order does not exist.');
        }

        DB::table('orders')
            ->where('orderNumber', $orderNumber)
            ->update($input);

        $updatedOrder = DB::table('orders')
            ->where('orderNumber', $orderNumber)
            ->first();

        return $this->sendResponse(new OrderResource($updatedOrder), 'Order updated.');
    }

    public function destroy($orderNumber)
    {
        $orders = DB::table('orders')->where('orderNumber', $orderNumber)->first();

        if (is_null($orders)) {
            return $this->sendError('Post not found.');
        }

        DB::table('orders')->where('orderNumber', $orderNumber)->delete();

        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
