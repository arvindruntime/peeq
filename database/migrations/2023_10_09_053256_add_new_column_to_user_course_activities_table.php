<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_course_activities', function (Blueprint $table) {
            $table->integer('course_completed')->unsigned()->comment('0 => no, 1 => yes')->after('mark_as_complete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_course_activities', function (Blueprint $table) {
            $table->dropColumn('course_completed');
        });
    }
};
