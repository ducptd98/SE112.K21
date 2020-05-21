<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category_Model;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories =  Category_Model::getCategory();
        return response()->json($categories);
    }
    public function search(Request $request)
    {
        $name  = request()->get('title');
        $data = Category_Model::where('category1', 'like', '%' . $name . '%')->orWhere('category2', 'like', '%' . $name . '%')->orwhere('category3', 'like', '%' . $name . '%')->get();
        $total_record = Category_Model::where('category1', 'like', '%' . $name . '%')->orWhere('category2', 'like', '%' . $name . '%')->orwhere('category3', 'like', '%' . $name . '%')->count();
        $return = [
            'total_record' => $total_record,
            'data' => json_encode($data)
        ];
        return response()->json($return);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parent_category)
    {
        $categories =  Category_Model::getCategory(['parent_category'=>$parent_category]);
        return response()->json($categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
