<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Detail_Model extends Model
{
    protected $table = 'tbl_Detail';
    
    public static function getPageDetail($where =  null, $limit =  10, $offset = 0){
        if (!empty($where)) {
            return Detail_Model::where($where)->limit($limit)->offset($offset)->get();
        } return Detail_Model::get();
    }
    
    public static function getDetail($where =  null){
        if (!empty($where)) {
            return Detail_Model::where($where)->get();
        } return Detail_Model::get();
    }

    public static function createDetail($data  =  null){
        return Detail_Model::insertGetId($data);
    }

    public static function setDetailStatus($id =  null,$data =  null){
        return Detail_Model::where('id', $id)->update($data);
    }

    public static function truncateDetail(){
        return Detail_Model::truncate();
    }
}
