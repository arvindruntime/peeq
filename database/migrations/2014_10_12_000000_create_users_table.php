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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('status')->default('active');
            $table->text('profile_image')->nullable();
            $table->text('cover_image')->nullable();
            $table->string('type')->default('normal');
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->string('fcm_token')->nullable();
            $table->longText('bio')->nullable();
            $table->longText('personal_link')->nullable();
            $table->string('device_type')->nullable();
            $table->boolean('leadership_development')->default(0);
            $table->boolean('self_development')->default(0);
            $table->boolean('culture_uplift')->default(0);
            $table->boolean('networking')->default(0);
            $table->boolean('first_time_login')->default(0);
            $table->boolean('is_terms_and_condition')->default(1);
            $table->boolean('is_agree_to_activity_email')->default(0);
            $table->boolean('is_agree_to_commercial_email')->default(0);
            $table->boolean('is_profile_image_skipped')->default(0);
            $table->boolean('is_plan_activated')->default(0);
            $table->string('referral_code')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('user_type')->default('Member');
            $table->string('general')->nullable();
            $table->string('course')->nullable();
            $table->string('find_resource')->nullable();
            $table->string('step_verification')->default('1,3');
            $table->string('notification_setting')->default('4,7,8,10')->nullable();
            $table->integer('mail_send_after_day')->nullable();
            $table->integer('mail_send_after_week')->nullable();
            $table->boolean('is_online')->default(0);
            $table->boolean('is_follow')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
