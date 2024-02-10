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
        Schema::create('chat_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_msg_id')->constrained('chat_msgs')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('document');            
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
        Schema::dropIfExists('chat_documents');
    }
};
