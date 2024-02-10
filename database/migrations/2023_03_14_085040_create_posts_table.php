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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('content');
            $table->enum('post_type', ['post', 'article', 'poll_question', 'poll_multiple_choice', 'poll_percentage']);
            $table->enum('schedule_type', ['post_now', 'schedule_post'])->default('post_now');
            $table->dateTime('schedule_datetime')->nullable();
            $table->dateTime('poll_expiration')->nullable();
            $table->integer('status')->unsigned()->comment('0 => public, 1 => private')->default(0);
            $table->foreignId('posted_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
};
