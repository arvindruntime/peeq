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
        Schema::create('welcome_checklists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('step_number');
            $table->longText('description');
            $table->longText('img_url');
            $table->string('button_title');
            $table->tinyInteger('is_mobile');
            $table->integer('redirection_tag');
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
        Schema::dropIfExists('welcome_checklists');
    }
};
