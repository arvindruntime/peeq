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
            $table->dropForeign('plan_transactions_session_price_transaction_id_foreign');
            $table->dropColumn('session_price_transaction_id');
            $table->string('session_duration')->after('transaction_id')->nullable();
            $table->string('session_price')->after('session_duration')->nullable();
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
            $table->dropColumn('session_duration');
            $table->dropColumn('session_price');
        });
    }
};
