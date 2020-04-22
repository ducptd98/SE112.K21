<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category_Model extends Model
{
    protected $table = 'tbl_Category';
    
    public static function getCategory($where =  null){
        if (!empty($where)) {
            return Category_Model::where($where)->get();
        } return Category_Model::get();
    }

    public static function createCategory($data  =  null){
        return Category_Model::insertGetId($data);
    }

    public static function setCategoryStatus($id =  null,$data =  null){
        return Category_Model::where('id', $id)->update($data);
    }

    public static function truncateCategory(){
        return Category_Model::truncate();
    }
}
