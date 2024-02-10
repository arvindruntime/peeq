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
        Schema::create('version_controls', function (Blueprint $table) {
            $table->id();
            $table->string('android_version');
            $table->integer('android_is_force_update')->default(0);
            $table->string('android_message');
            $table->string('ios_version');
            $table->integer('ios_is_force_update')->default(0);
            $table->string('ios_message');
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
        Schema::dropIfExists('version_controls');
    }
};
