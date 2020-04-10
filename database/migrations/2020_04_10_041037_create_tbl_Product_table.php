<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_Product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category1')->nullable();
			$table->string('category2')->nullable()->default('');
			$table->string('category3')->nullable()->default('');
			$table->string('status')->nullable()->default('TODO')->index('status');
			$table->string('url', 500)->nullable()->default('');
			$table->string('url_encode')->nullable()->default('')->unique('url_encode');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_Product');
	}

}
