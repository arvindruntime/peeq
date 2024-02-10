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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->after('personal_link')->constrained('countries')->onDelete('cascade');
            $table->foreignId('timezone_id')->nullable()->after('location_id')->constrained('time_zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_location_id_foreign');
            $table->dropColumn('location_id');
            $table->dropForeign('users_timezone_id_foreign');
            $table->dropColumn('timezone_id');
        });
    }
};
