<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Offices as OfficesResources;

class OfficesController extends BaseController
{
    public function index()
    {
        $offices = Offices::all();
        return $this->sendResponse(OfficesResources::collection($offices), 'Post Fetched');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'officeCode' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'addressLine1' => 'required',
            'addressLine2' => '',
            'state' => 'required',
            'country' => 'required',
            'postalCode' => 'required',
            'territory' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::table('offices')->insert($input);

        $offices = DB::table('offices')->where('officeCode', $input['officeCode'])->first();

        return $this->sendResponse(new OfficesResources($offices), 'Post Created.');
    }

    public function show($officeCode)
    {
        $offices = DB::table('offices')->where('officeCode', $officeCode)->first();
        if (is_null($offices)) {
            return $this->sendError('Post does not exits.');
        }
        return $this->sendResponse(new OfficesResources($offices), 'Post fetched.');
    }

    public function update(Request $request, $officeCode)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'officeCode' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'addressLine1' => 'required',
            'addressLine2' => '',
            'state' => 'required',
            'country' => 'required',
            'postalCode' => 'required',
            'territory' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $existingOffice = DB::table('offices')
            ->where('officeCode', $officeCode)
            ->first();

        if (is_null($existingOffice)) {
            return $this->sendError('Office does not exist.');
        }

        DB::table('offices')
            ->where('officeCode', $officeCode)
            ->update($input);

        $updatedOffice = DB::table('offices')
            ->where('officeCode', $input['officeCode'])
            ->first();

        return $this->sendResponse(new OfficesResources($updatedOffice), 'Office updated.');
    }

    public function destroy($officeCode)
    {
        $existingOffice = DB::table('offices')
            ->where('officeCode', $officeCode)
            ->first();

        if (is_null($existingOffice)) {
            return $this->sendError('Office does not exist.');
        }

        DB::table('offices')
            ->where('officeCode', $officeCode)
            ->delete();

        return $this->sendResponse([], 'Office deleted.');
    }
}
