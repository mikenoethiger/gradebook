<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveSemesterToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('active_semester')->unsigned()->nullable();
            $table->foreign('active_semester')->references('id')->on('semesters')->onDelete('cascade');
            $table->integer('active_school')->unsigned()->nullable();
            $table->foreign('active_school')->references('id')->on('schools')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('users_active_semester_foreign');
            $table->dropColumn('active_semester');
            $table->dropForeign('users_active_school_foreign');
            $table->dropColumn('active_school');
		});
	}
}