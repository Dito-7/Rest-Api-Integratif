<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\Collection;
use App\Http\Resources\Collection as CollectionResource;

class CollectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();
        return $this->sendResponse(
            CollectionResource::collection($collections), 'Posts Fetched,'
        );
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
            'nama' =>'required',
            'jenis' =>'required',
            'jumlahAwal' =>'required',
            'jumlahSisa' =>'required',
            'jumlahAkhir' =>'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $collection = Collection::create($input);
        return $this->sendResponse(new CollectionResource($collection), 'Post Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = Collection::find($id);
        if (is_null($collection)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new CollectionResource($collection), 'Post Fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' =>'required',
            'jenis' =>'required',
            'jumlahAwal' =>'required',
            'jumlahSisa' =>'required',
            'jumlahAkhir' =>'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $collection->nama =$input['nama'];
        $collection->jenis =$input['jenis'];
        $collection->jumlahAwal =$input['jumlahAwal'];
        $collection->jumlahSisa =$input['jumlahSisa'];
        $collection->jumlahAkhir =$input['jumlahAkhir'];
        $collection->save();

        return $this->sendResponse(new CollectionResource($collection), 'Post Updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return $this->sendResponse([], 'Post Deleted');
    }
}
