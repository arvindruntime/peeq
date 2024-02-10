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
        Schema::table('chat_connections', function (Blueprint $table) {
            //
            $table->bigInteger('vendor_id')->after('user_id')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_connections', function (Blueprint $table) {
            //
            $table->dropColumn('vendor_id');

        });
    }
};
