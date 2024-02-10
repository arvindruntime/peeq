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
        Schema::table('plan_transactions', function (Blueprint $table) {
            $table->enum('device_type', ['android', 'ios', 'web'])->after('promo_code_dis')->nullable();
            $table->enum('course_price_type', ['free', 'paid'])->after('device_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_transactions', function (Blueprint $table) {
            $table->dropColumn('device_type');
            $table->dropColumn('course_price_type');
        });
    }
};
