<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblIgnoreUrlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_ignore_urls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category1', 500)->nullable()->default('');
			$table->string('category2', 500)->nullable()->default('');
			$table->string('category3', 500)->nullable()->default('');
			$table->string('url', 500)->nullable()->default('')->index('url');
			$table->string('ignore_code', 500)->nullable()->default('');
			$table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_ignore_urls');
	}

}
