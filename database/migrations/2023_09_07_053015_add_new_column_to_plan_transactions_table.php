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
        Schema::table('plan_transactions', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable()->after('plan_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('type')->after('course_id')->default('plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_transactions', function (Blueprint $table) {
            $table->dropForeign('plan_transactions_course_id_foreign');
            $table->dropColumn('course_id');
            $table->dropColumn('type');
        });
    }
};
