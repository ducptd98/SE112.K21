<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblStartUrlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_startUrl', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50)->nullable()->default('batdongsan');
			$table->string('region', 50)->nullable()->default('VietNam');
			$table->string('url')->nullable()->default('https://batdongsan.com.vn/');
			$table->string('status', 11)->nullable()->default('TODO')->index('status');
			$table->dateTime('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_startUrl');
	}

}
