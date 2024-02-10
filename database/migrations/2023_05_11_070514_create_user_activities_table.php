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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('block_user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('blocked_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('report_user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('reported_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->integer('is_block_member')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->integer('is_report_member')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->string('report_for')->nullable();
            $table->text('report_type')->nullable();
            $table->longText('report_description')->nullable();
            $table->integer('is_follow')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            // $table->foreignId('followed_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->integer('followers')->nullable();
            $table->integer('following')->nullable();
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
        Schema::dropIfExists('user_activities');
    }
};
