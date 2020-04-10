<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertTblStartUrlTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tbl_startUrl')->insert(array(
            "id" => 1,
            "name" => "batdongsan",
            "region" => "VietNam",
            "url" => "https://batdongsan.com.vn/",
            "status" => "TODO",
            "created_at" => "2020-04-08 16:19:46",
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('tbl_startUrl');
    }

}
