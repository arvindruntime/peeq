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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail_img')->nullable();
            $table->string('thumbnail_video')->nullable();
            $table->string('session_name');
            $table->longText('short_description')->nullable();
            $table->longText('description');
            $table->integer('status')->unsigned()->comment('0 => private, 1 => public')->default(0);
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
        Schema::dropIfExists('sessions');
    }
};
