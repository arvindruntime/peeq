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
        Schema::create('post_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('is_like')->unsigned()->comment('0 => unlike, 1 => like')->default(0);
            $table->integer('is_save')->unsigned()->comment('0 => unsave, 1 => save')->default(0);
            $table->integer('is_mute')->unsigned()->comment('0 => unmute, 1 => mute')->default(0);
            $table->integer('is_report')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->integer('is_block_member')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->integer('is_report_member')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->integer('is_hide_post')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->string('report_for')->nullable();
            $table->text('report_type')->nullable();
            $table->longText('report_description')->nullable();
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
        Schema::dropIfExists('post_activities');
    }
};
