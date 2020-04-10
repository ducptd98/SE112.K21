<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product_Model extends Model
{
    protected $table = 'tbl_Product';

    public static function createProduct($data =  null){
        return Product_Model::insertGetId($data);
    }

    public static function getProductLimit($limit =  100 ,  $status ="TODO"){
        return Product_Model::where('status', $status)->limit($limit)->offset(0)->get()->toArray();
    }

    public static function setProductStatus($id =  null,$data =  null){
        return Product_Model::whereIn('id', $id)->update($data);
    }

    public static function truncateProduct(){
        return Product_Model::truncate();
    }

    public static function coutProduct($where =  nulll){
        return Product_Model::where($where)->count();
    }
}
