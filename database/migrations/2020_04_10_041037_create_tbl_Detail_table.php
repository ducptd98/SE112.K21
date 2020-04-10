<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_Detail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('url', 500)->nullable()->default('');
			$table->string('product_code', 50)->nullable()->default('');
			$table->string('name')->nullable()->default('');
			$table->string('contact')->nullable()->default('');
			$table->string('address')->nullable()->default('');
			$table->string('category1')->nullable()->default('');
			$table->string('category2')->nullable()->default('');
			$table->string('category3')->nullable()->default('');
			$table->string('price', 50)->nullable()->default('');
			$table->string('sale_price', 50)->nullable()->default('');
			$table->string('area', 500)->nullable()->default('');
			$table->text('desc', 65535)->nullable();
			$table->text('images', 65535)->nullable();
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
		Schema::drop('tbl_Detail');
	}

}
