<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_Category', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category1')->nullable();
			$table->string('category2')->nullable();
			$table->string('category3')->nullable();
			$table->string('url', 500)->nullable();
			$table->string('url_encode', 200)->nullable();
			$table->string('ignore_code', 200)->nullable()->index('ignore_code');
			$table->string('status')->nullable()->default('TODO')->index('status');
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
		Schema::drop('tbl_Category');
	}

}
