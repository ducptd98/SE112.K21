<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category_Model extends Model
{
    protected $table = 'tbl_Category';
    
    public function getAllCategory(){
        return Category_Model::all();
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
