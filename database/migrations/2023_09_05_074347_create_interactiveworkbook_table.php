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
        Schema::create('interactiveworkbook', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('course_module_id')->nullable()->constrained('course_modules')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('page_no')->nullable();
            $table->longText('pdf_content');
            $table->longText('interactive_content')->nullable();
            $table->string('audio_file')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('interactiveworkbook');
    }
};
