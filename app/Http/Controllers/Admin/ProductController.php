<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Detail_Model;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_category ,$limit, $offset, Request $request)
    {
        $order =  \request()->get('order');
        if (empty($order)) {
            $order =  'desc';
        }
        $products =  Detail_Model::getPageDetail(['category_parent'=>$parent_category], $limit, $offset, $order);
        $total_record =  Detail_Model::where('category_parent', $parent_category)->count();
        $return = [
            'total_record' => $total_record,
            'data' => json_encode($products)
        ];
        return response()->json($return);
    }

    public function location(){
        $location =  Detail_Model::all()->pluck('address');
        return response()->json($location);
    }

    public function groupbyLocation(){
        $return = Detail_Model::select('address', DB::raw('count(*) as total_record'))
                            ->groupBy('address')
                            ->get();
        return response()->json($return);
    }

    public function searchName(Request $request){
        $name  = request()->get('name');
        $data = Detail_Model::where('name', 'like', '%' . $name . '%')->get();
        $total_record = Detail_Model::where('name', 'like', '%' . $name . '%')->count();
        $return = [
            'total_record' => $total_record,
            'data' => json_encode($data)
        ];
        return response()->json($return);
    }
    public function searchLocation(Request $request){
        $name  = request()->get('location');
        $data = Detail_Model::where('address', 'like', '%' . $name . '%')->get();
        $total_record = Detail_Model::where('address', 'like', '%' . $name . '%')->count();
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
    public function show($id)
    {
        $products =  Detail_Model::getPageDetail(['id'=>$id]);
        $return = [
            'status' => 1,
            'data' => json_encode($products)
        ];
        return $return;
        return response()->json($products);
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
