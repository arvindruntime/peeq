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
        Schema::table('course_modules', function (Blueprint $table) {
            $table->longText('closure_video_description')->nullable()->after('reference_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_modules', function (Blueprint $table) {
            $table->dropColumn('closure_video_description');
        });
    }
};
