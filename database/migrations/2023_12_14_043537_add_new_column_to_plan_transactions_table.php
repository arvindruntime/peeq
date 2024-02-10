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
            $table->foreignId('session_id')->nullable()->after('course_id')->constrained('sessions')->onDelete('cascade');
            $table->enum('session_price_type', ['free', 'paid','initialized'])->after('session_id')->nullable();
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
            $table->dropForeign('plan_transactions_session_id_foreign');
            $table->dropColumn('session_id');
            $table->dropColumn('session_price_type');
        });
    }
};
