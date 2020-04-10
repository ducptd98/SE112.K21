<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductDetail_Model extends Model
{
    protected $table = 'tbl_Detail';

    public static function createDetail($data =  null){
        return ProductDetail_Model::insertGetId($data);
    }

    public static function truncateDetail(){
        return ProductDetail_Model::truncate();
    }

    public static function countDetail(){
        return ProductDetail_Model::count();
    }
}
