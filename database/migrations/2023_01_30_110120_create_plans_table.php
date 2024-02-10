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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_title');
            $table->longText('plan_description');
            $table->enum('plan_type', ['monthly', 'yearly']);
            $table->decimal('plan_amount')->nullable();
            $table->string('plan_duration')->nullable();
            $table->string('plan_image')->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->string('stripe_subscription_plan_id')->nullable();
            $table->string('google_pay_id')->nullable();
            $table->string('apple_pay_id')->nullable();
            $table->string('status')->default('active');
            $table->date('created_at')->nullable();
            $table->string('created_by')->nullable();
            $table->date('updated_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->date('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
