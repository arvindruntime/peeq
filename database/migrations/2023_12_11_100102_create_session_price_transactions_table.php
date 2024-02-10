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
        Schema::create('session_price_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->nullable()->constrained('sessions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('session_duration')->nullable();
            $table->string('session_price')->nullable();
            $table->longText('calendly_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_price_transactions');
    }
};
