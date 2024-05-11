<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\BaseController as BaseController;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products), 'Post Fetched');
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
            'productCode' => 'required',
            'productName' => 'required',
            'productLine' => 'required',
            'productScale' => 'required',
            'productVendor' => 'required',
            'productDescription' => 'required',
            'quantityInStock' => 'required',
            'buyPrice' => 'required',
            'MSRP' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        DB::table('products')->insert($input);

        $product = DB::table('products')->where('productCode', $input['productCode'])->first();

        return $this->sendResponse(new ProductResource($product), 'Post Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('productCode', $id)->first();
        if (is_null($product)) {
            return $this->sendError('Product does not exist.');
        }
        return $this->sendResponse(new ProductResource($product), 'Product fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'productCode' => 'required',
            'productName' => 'nullable',
            'productLine' => 'required',
            'productScale' => 'nullable',
            'productVendor' => 'nullable',
            'productDescription' => 'nullable',
            'quantityInStock' => 'nullable',
            'buyPrice' => 'nullable',
            'MSRP' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $existingProduct = DB::table('products')->where('productCode', $id)->first();

        if (is_null($existingProduct)) {
            return $this->sendError('Product does not exist.');
        }

        DB::table('products')->where('productCode', $id)->update($input);

        $product = DB::table('products')->where('productCode', $input['productCode'])->first();

        return $this->sendResponse(new ProductResource($product), 'Product Updated.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('productCode', $id)->first();

        if (is_null($product)) {
            return $this->sendError('Product does not exist.');
        }

        DB::table('products')->where('productCode', $id)->delete();

        return $this->sendResponse([], 'Product deleted.');
    }

}
