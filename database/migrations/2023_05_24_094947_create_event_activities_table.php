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
        Schema::create('event_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('is_save')->unsigned()->comment('0 => unsave, 1 => save')->default(0);
            $table->integer('is_mute')->unsigned()->comment('0 => unmute, 1 => mute')->default(0);
            $table->string('download_rsvps')->nullable();
            $table->integer('is_calendar')->unsigned()->comment('0 => no, 1 => yes')->default(0);
            $table->enum('is_attending', ['going', 'maybe', 'not_going'])->default('maybe');
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
        Schema::dropIfExists('event_activities');
    }
};
