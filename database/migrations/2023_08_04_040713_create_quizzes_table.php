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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('course_module_id')->nullable()->constrained('course_modules')->onUpdate('cascade')->onDelete('cascade');
            $table->string('question')->nullable();
            $table->string('question_image')->nullable();
            $table->enum('question_type', ['multi_select', 'single_select']);
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
        Schema::dropIfExists('quizzes');
    }
};
