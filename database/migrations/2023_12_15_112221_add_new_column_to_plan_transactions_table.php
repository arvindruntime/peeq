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
            $table->foreignId('session_price_transaction_id')->nullable()->after('session_id')->constrained('session_price_transactions')->onDelete('cascade');
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
            $table->dropForeign('plan_transactions_session_price_transaction_id_foreign');
            $table->dropColumn('session_price_transaction_id');
        });
    }
};
