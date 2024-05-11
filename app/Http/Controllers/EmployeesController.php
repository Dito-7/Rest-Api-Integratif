<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Employees as EmployeesResources;
use App\Http\Controllers\BaseController as BaseController;

class EmployeesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::all();
        return $this->sendResponse(EmployeesResources::collection($employees), 'Post Fetched');
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
            'employeeNumber' => 'required',
            'lastName' => 'required',
            'firstName' => 'required',
            'extension' => 'required',
            'email' => 'required',
            'officeCode' => 'required',
            'reportsTo' => 'required',
            'jobTitle' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        DB::table('employees')->insert($input);

        $employee = DB::table('employees')->where('employeeNumber', $input['employeeNumber'])->first();

        return $this->sendResponse(new EmployeesResources($employee), 'Post Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = DB::table('employees')->where('employeeNumber', $id)->first();
        if (is_null($employee)) {
            return $this->sendError('Post does not exits.');
        }
        return $this->sendResponse(new EmployeesResources($employee), 'Post fetched.');
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
            'employeeNumber' => 'required',
            'lastName' => 'nullable',
            'firstName' => 'nullable',
            'extension' => 'nullable',
            'email' => 'nullable',
            'officeCode' => 'nullable',
            'reportsTo' => 'nullable',
            'jobTitle' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $existingProductLine = DB::table('employees')->where('employeeNumber', $id)->first();

        if (is_null($existingProductLine)) {
            return $this->sendError('Product line does not exist.');
        }

        DB::table('employees')->where('employeeNumber', $id)->update($input);

        $employee = DB::table('employees')->where('employeeNumber', $input['employeeNumber'])->first();

        return $this->sendResponse(new EmployeesResources($employee), 'Post Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = DB::table('employees')->where('employeeNumber', $id)->first();

        if (is_null($employee)) {
            return $this->sendError('error employee.');
        }

        DB::table('employees')->where('employeeNumber', $id)->delete();

        return $this->sendResponse([], 'Employee deleted.');
    }
}
