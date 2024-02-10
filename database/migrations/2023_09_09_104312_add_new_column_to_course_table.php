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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('upload_pdf')->nullable()->after('member_add_reviews_on_this');
            $table->foreignId('currency_id')->nullable()->after('upload_pdf')->constrained('currencies')->onUpdate('cascade')->onDelete('cascade');
            $table->string('stripe_subscription_course_id')->nullable()->after('currency_id');
            $table->string('google_pay_id')->nullable()->after('stripe_subscription_course_id');
            $table->string('apple_pay_id')->nullable()->after('google_pay_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('upload_pdf');
            $table->dropForeign('courses_currency_id_foreign');
            $table->dropColumn('stripe_subscription_course_id');
            $table->dropColumn('google_pay_id');
            $table->dropColumn('apple_pay_id');
        });
    }
};
