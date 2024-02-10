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
            $table->integer('mark_as_complete')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->after('closure_video')->default(0);
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
            $table->dropColumn('mark_as_complete');
        });
    }
};
