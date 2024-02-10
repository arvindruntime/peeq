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
        Schema::table('event_activities', function (Blueprint $table) {
            $table->integer('mail_send_before_hour')->after('is_attending')->nullable();
            $table->integer('mail_send_before_day')->after('mail_send_before_hour')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_activities', function (Blueprint $table) {
            $table->dropColumn('mail_send_before_hour');
            $table->dropColumn('mail_send_before_day');
        });
    }
};
