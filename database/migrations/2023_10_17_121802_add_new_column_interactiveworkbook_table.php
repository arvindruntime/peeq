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
        Schema::table('interactiveworkbook', function (Blueprint $table) {
            $table->integer('start_page')->nullable()->after('audio_file');
            $table->integer('end_page')->nullable()->after('start_page');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interactiveworkbook', function (Blueprint $table) {
            $table->dropColumn('start_page');
            $table->dropColumn('end_page');
        });
    }
};
