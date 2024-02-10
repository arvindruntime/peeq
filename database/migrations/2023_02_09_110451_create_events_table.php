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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('event_title')->nullable();
            $table->integer('is_also_post_in_feed')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('meeting_id')->nullable();
            $table->text('meeting_start_url')->nullable();
            $table->text('meeting_join_url')->nullable();
            $table->integer('is_repeat_event')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->integer('is_rsvps')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->integer('is_restrick_event_link')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->integer('is_close_rsvps')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->integer('is_header_image_or_video')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->longText('upload_header_image_or_video')->nullable();
            $table->integer('is_thumbnail_image')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->longText('upload_thumbnail')->nullable();
            $table->integer('is_description')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->longText('description')->nullable();
            $table->string('coaches')->nullable();
            $table->integer('is_save_to_draft')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->enum('schedule_type', ['event_now', 'schedule_event'])->default('event_now');
            $table->dateTime('schedule_datetime')->nullable();
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
        Schema::dropIfExists('events');
    }
};
