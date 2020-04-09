<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Start_Model extends Model
{
    protected $table = 'tbl_startUrl';
    public  static function getStartUrl(){
        return Start_Model::all();
    }
}
