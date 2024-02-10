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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->longText('course_thumbnail');
            $table->longText('course_preview_video');
            $table->string('course_name');
            $table->longText('course_tagline')->nullable();
            $table->string('coaches');
            $table->longText('description');
            $table->enum('course_price_type', ['free', 'paid'])->default('free');
            $table->decimal('course_price')->nullable();
            $table->integer('member_add_reviews_on_this')->unsigned()->comment('0 => no, 1 => yes')->default(1);
            $table->enum('status', ['private','public'])->default('private');
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
        Schema::dropIfExists('courses');
    }
};
