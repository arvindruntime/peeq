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
        Schema::create('invite_members', function (Blueprint $table) {
            $table->id();
            $table->text('email');
            $table->text('subject')->nullable();
            $table->longText('message')->nullable();
            $table->string('user_type')->default('member')->nullable();
            $table->string('invite_by')->nullable();
            $table->string('status')->default('unsubscribed');
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
        Schema::dropIfExists('invite_members');
    }
};
