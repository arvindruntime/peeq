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
        Schema::table('session_price_transactions', function (Blueprint $table) {
            $table->foreignId('currency_id')->nullable()->after('session_price')->constrained('currencies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session_price_transactions', function (Blueprint $table) {
            $table->dropForeign('session_price_transactions_currency_id_foreign');
        });
    }
};
