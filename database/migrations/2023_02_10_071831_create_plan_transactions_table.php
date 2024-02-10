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
        Schema::create('plan_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('plan_id')->nullable()->constrained('plans')->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('plan_active_till')->nullable();
            $table->string('promo_code')->nullable();
            $table->longText('promo_code_dis')->nullable();
            $table->decimal('final_amount')->nullable();
            $table->integer('payment_status')->unsigned()->comment('0 => no, 1 => yes')->default(0);
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
        Schema::dropIfExists('plan_transactions');
    }
};
