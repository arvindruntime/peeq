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
        Schema::create('course_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->longText('thumbnail_image')->nullable();
            $table->longText('introduction')->nullable();
            $table->longText('video_lesson')->nullable();
            $table->string('audio_recording')->nullable();
            $table->longText('task')->nullable();
            $table->longText('reflection_questions')->nullable();
            $table->longText('reference_link_description')->nullable();
            $table->longText('reference_link')->nullable();
            $table->longText('closure_video')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_modules');
    }
};
