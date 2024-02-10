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
        Schema::create('user_course_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('course_module_id')->nullable()->constrained('course_modules')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('introduction')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->default(0);
            $table->integer('video_lesson')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->default(0);
            $table->integer('audio_recording')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->default(0);
            $table->integer('task')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->default(0);
            $table->integer('quiz')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->default(0);
            $table->integer('reflection_questions')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->default(0);
            $table->integer('reference_link')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->default(0);
            $table->integer('closure_video')->unsigned()->comment('0 => lock, 1 => running, 2 => complete')->default(0);
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
        Schema::dropIfExists('user_course_activities');
    }
};
