<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ChatController;
use App\Http\Controllers\Api\v1\PlanController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\QuizController;
use App\Http\Controllers\Api\v1\UserController;
// use App\Http\Controllers\Api\v1\ZoomController;
use App\Http\Controllers\Api\v1\EventController;
use App\Http\Controllers\Api\v1\MediaController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\SearchController;
use App\Http\Controllers\Api\v1\SocialController;
use App\Http\Controllers\Api\v1\CmsPageController;
use App\Http\Controllers\Api\v1\CountryController;
use App\Http\Controllers\Api\v1\CurrencyController;
use App\Http\Controllers\Api\v1\RegisterController;
use App\Http\Controllers\Api\v1\TimeZoneController;
use App\Http\Controllers\Api\v1\UserIssueController;
use App\Http\Controllers\Api\v1\PollOptionController;
use App\Http\Controllers\Api\v1\PostCommentController;
use App\Http\Controllers\Api\v1\CourseModuleController;
use App\Http\Controllers\Api\v1\InviteMemberController;
use App\Http\Controllers\Api\v1\NotificationController;
use App\Http\Controllers\Api\v1\PostActivityController;
use App\Http\Controllers\Api\v1\UserActivityController;
use App\Http\Controllers\Api\v1\WelcomePopupController;
use App\Http\Controllers\Api\v1\Zoom\MeetingController;
use App\Http\Controllers\Api\v1\CourseMastersController;
use App\Http\Controllers\Api\v1\EventActivityController;
use App\Http\Controllers\Api\v1\ChangePasswordController;
use App\Http\Controllers\Api\v1\ContactSupportController;
use App\Http\Controllers\Api\v1\ContactUsController;
use App\Http\Controllers\Api\v1\FeaturedController;
use App\Http\Controllers\Api\v1\InteractiveDetailController;
use App\Http\Controllers\Api\v1\VersionControlController;
use App\Http\Controllers\Api\v1\PlanTransactionsController;
use App\Http\Controllers\Api\v1\PushNotificationController;
use App\Http\Controllers\Api\v1\WelcomeChecklistController;
use App\Http\Controllers\Api\v1\NotificationDetailController;
use App\Http\Controllers\Api\v1\UserCourseActivityController;
use App\Http\Controllers\Api\v1\InteractiveWorkbookController;
use App\Http\Controllers\Api\v1\SessionController;
use App\Http\Controllers\Api\v1\SessionPriceTransactionController;
use App\Http\Controllers\Api\v1\UserQuizAnswerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
    if (env('WEB_ENV')=='local') {
        // Define routes specific to the local environment
    } else {
        // Define routes for the live environment
        URL::forceScheme('https');
    }

    Route::group(['prefix' => 'v1'], function ($router) {
        Route::controller(RegisterController::class)->group(function(){
            /** Login & Register API */
            Route::post('register', 'register');
            Route::post('login', 'login');
        });

        Route::controller(UserController::class)->group(function(){
            /** Forgot Password API */
            Route::post('forgot_password', 'forgotPassword');
            /** Reset Password API */
            Route::post('reset_password', 'resetPassword');
        });

        /** Social Login API */
        Route::controller(SocialController::class)->group(function(){
            Route::post('social_login', 'socialLogin');
        });

        /** Countries API */
        Route::controller(CountryController::class)->group(function(){
            Route::get('countries', 'index');
            Route::get('country/{id}', 'show');
            Route::post('country', 'store');
            Route::post('country/{id}', 'update');
            Route::delete('country/{id}', 'destroy');
        });

        /** Timezone API */
        Route::controller(TimeZoneController::class)->group(function() {
            Route::get('time_zones', 'index');
            Route::get('time_zone/{country_id}', 'show');
        });

        /** Currency API */
        Route::controller(CurrencyController::class)->group(function() {
            Route::get('currencies', 'index');
            Route::get('currency/{id}', 'show');
        });

        /** Contact Support API */
        Route::controller(ContactSupportController::class)->group(function(){
            Route::post('contact_support', 'store');
        });

        /** Contact Us API */
        Route::controller(ContactUsController::class)->group(function(){
            Route::post('contact_us', 'store');
        });

        /** Cms Page API */
        Route::controller(CmsPageController::class)->group(function(){
            Route::get('cms_pages', 'cmsPages');
        });

        /** Version control API */
        Route::controller(VersionControlController::class)->group(function(){
            Route::get('version_control', 'versionDetails');
        });
    });


    Route::group(['prefix'=> 'v1', 'middleware' => 'auth:sanctum'], function () {

        /** User Logout API*/
        Route::controller(RegisterController::class)->group(function() {
            Route::post('logout', 'logout');
        });

        /** User API */
        Route::controller(UserController::class)->group(function(){
            Route::get('users', 'index');
            Route::get('user/{id}', 'show');
            Route::post('user', 'store');
            Route::post('user/{id}', 'update');
            Route::delete('user/{id}', 'deleteAccount')->name('delete.account');
            Route::get('member_list', 'memberList');
            Route::get('member/{id}', 'showMember');
            Route::get('block_member_list', 'blockMemberList');
            Route::get('follower_list', 'followerList');
            Route::get('following_list', 'followingList');
        });
        /** User Activity API */
        Route::controller(UserActivityController::class)->group(function() {
            Route::post('member_activity_action', 'memberActivityAction');
            Route::post('member_report', 'memberReport');
        });

        /** Change Password API */
        Route::controller(ChangePasswordController::class)->group(function(){
            Route::post('change_password', 'ChangePassword');
        });

        /** Plans API */
        Route::controller(PlanController::class)->group(function(){
            Route::get('plans', 'index');
            Route::get('plan/{id}', 'show');
            Route::post('plan', 'store');
            Route::post('plan/{id}', 'update');
            Route::delete('plan/{id}', 'destroy');
        });

        /** UserIssue API */
        Route::controller(UserIssueController::class)->group(function(){
            Route::get('user_issues', 'index');
            Route::get('user_issue/{id}', 'show');
            Route::post('user_issue', 'store');
            Route::post('user_issue/{id}', 'update');
            Route::delete('user_issue/{id}', 'destroy');
        });

         /** Event API */
        Route::controller(EventController::class)->group(function(){
            Route::get('events', 'index');
            Route::post('event', 'store');
            Route::get('event/{id}', 'show');
            Route::post('event/{id}', 'update');
            Route::delete('event/{id}', 'destroy');
            Route::get('event_saved_draft', 'saveDraft');
            Route::get('rsvp_list/{id}', 'rsvpList');
            Route::get('events_calendar', 'eventsCalendar');
            Route::post('featured_event_status_update/{id}', 'featuredEventStatusUpdate');
        });

        /** Event Activity Action API */
        Route::controller(EventActivityController::class)->group(function(){
            Route::post('event_activity_action', 'eventActivityAction');
        });

         /** Plan Transaction API */
        Route::controller(PlanTransactionsController::class)->group(function(){
            Route::get('plan_transactions', 'index');
            Route::get('plan_transaction/{id}', 'show');
            Route::post('plan_transaction', 'store');
            Route::post('plan_transaction/{id}', 'update');
            Route::delete('plan_transaction/{id}', 'destroy');
            Route::get('purchase_plan','purchasePlanInfo');

            /** Course Transaction API */
            Route::post('course_transaction', 'coursePurchase');
            Route::get('purchase_course','purchaseCourseInfo');

            /** Session Transaction API */
            Route::post('session_transaction', 'sessionPurchase');
            Route::get('purchase_session','purchaseSessionInfo');
        });

        /** Welcome Popup API */
        Route::controller(WelcomePopupController::class)->group(function(){
            Route::get('welcome_popup', 'index');
        });

        /** Welcome Checklist API */
        Route::controller(WelcomeChecklistController::class)->group(function(){
            Route::get('welcome_checklists', 'index');
            Route::get('download_app', 'downloadApp');
        });

        /** Media API */
        Route::controller(MediaController::class)->group(function() {
            Route::get('media_list', 'index');
            Route::post('media', 'store');
            Route::get('media/{id}', 'show');
            Route::post('media/{id}', 'update');
            Route::delete('media/{id}', 'destroy');
        });

        /** Post API */
        Route::controller(PostController::class)->group(function() {
            Route::get('posts', 'index');
            Route::post('post', 'store');
            Route::get('post/{id}', 'show');
            Route::get('post_edit/{id}', 'postEdit');
            Route::post('post/{id}', 'update');
            Route::delete('post/{id}', 'destroy');
            Route::get('post_by_filter', 'filteredPost');
            Route::post('featured_post_status_update/{id}', 'featuredPostStatusUpdate');
            Route::get('featured_post', 'featuredPost')->name('post.featuredpost');
        });

        /** Poll Answer API */
        Route::controller(PollOptionController::class)->group(function() {
            Route::post('poll_answer', 'pollAnswer');
        });

        /** Post Comment API */
        Route::controller(PostCommentController::class)->group(function() {
            Route::get('posts/{post}/post_comments', 'index');
            Route::post('posts/{post}/post_comment', 'store');
            Route::delete('posts/{post}/post_comment/{postComment}', 'destroy');
        });

        /** Post Activity API */
        Route::controller(PostActivityController::class)->group(function() {
            Route::get('post_activities', 'index');
            Route::post('post_activity', 'store');
            Route::get('post_activity/{id}', 'show');
            Route::post('post_activity/{id}', 'update');
            Route::delete('post_activity/{id}', 'destroy');
            Route::post('post_activity_action', 'postActivityAction');
            Route::post('report', 'report');
        });

        /** Notification API */
        Route::controller(NotificationController::class)->group(function() {
            Route::get('notifications', 'index');
            Route::post('notification', 'store');
            Route::get('notification/{id}', 'show');
            Route::post('notification/{id}', 'update');
            Route::delete('notification/{id}', 'destroy');
        });

        /** Notification Detail API */
        Route::controller(NotificationDetailController::class)->group(function() {
            Route::get('notification_details', 'index');
            Route::post('notification_detail', 'store');
            Route::get('notification_detail/{id}', 'show');
            Route::post('notification_detail/{id}', 'update');
            Route::delete('notification_detail/{id}', 'destroy');
            Route::get('change_status', 'changeStatus');
            Route::get('edit_notification_setting', 'notificationSetting');
        });
        
        /* ZoomController API*/
        // Route::controller(ZoomController::class)->group(function() {
        //     Route::get('zoom_integration', 'getMeetings');
        // });

        /** Push Notification Listing Api */
        Route::controller(PushNotificationController::class)->group(function() {
            Route::get('push_notifications', 'index');
            Route::post('push_notification_update_count/{id}', 'updateViewdNotification');
        });

        /* Global Search API*/
        Route::controller(SearchController::class)->group(function() {
            Route::get('global_search', 'search');
        });

        /* Invite By Member*/
        Route::controller(InviteMemberController::class)->group(function() {
            Route::post('invite_member', 'sendInviteEmail');
            Route::get('sent_invite_members', 'sentInviteMembers');
        });

        /* Chat Member API */
        Route::controller(ChatController::class)->group(function() {
            Route::get('chat_memberlist', 'chatMemberList');
            Route::get('chat_message/{id}' ,'showChatMessage');
            Route::post('chat_documents', 'storeChatDocument');
        });

        /* Zoom Meeting API  */
        Route::controller(MeetingController::class)->group(function() {
            Route::get('/meetings', 'list');
            Route::post('/meetings', 'create');
            Route::get('/meetings/{id}', 'get')->where('id', '[0-9]+');
            Route::post('/meetings/{id}', 'update')->where('id', '[0-9]+');
            Route::delete('/meetings/{id}', 'delete')->where('id', '[0-9]+');
        });

        /** Course API */
        Route::controller(CourseController::class)->group(function(){
            Route::get('courses', 'index');
            Route::post('course', 'store');
            Route::get('course/{id}', 'show');
            Route::post('course/{id}', 'update');
            Route::delete('course/{id}', 'destroy');
            Route::post('featured_course_status_update/{id}', 'featuredCourseStatusUpdate');
            /** Coach List */
            Route::get('coach_list', 'coachList');
        });

        /** Course Module API */
        Route::controller(CourseModuleController::class)->group(function(){
            Route::get('courses/{course_id}/course_modules', 'index');
            Route::post('course_module', 'addUpdate');
            Route::get('course_module/{id}', 'show');
            Route::delete('course_module/{id}', 'destroy');
            Route::get('course_module_detail/{id}', 'showModuleDetail');
        });

        /** Quiz API */
        Route::controller(QuizController::class)->group(function() {
            Route::get('quiz_list', 'index');
            Route::post('quiz', 'store');
            Route::post('quiz/{id}', 'update');
            Route::get('quiz/{id}', 'show');
            Route::get('get_quiz_module_wise/{courseModule}', 'getQuizModuleWise');
            Route::delete('quiz/{id}', 'destroy');
        });
        Route::controller(InteractiveWorkbookController::class)->group(function(){
            Route::get('interactive_workbooks', 'index');
            Route::post('interactive_workbook', 'store');
            Route::get('interactive_workbook/{id}', 'show');
            Route::post('interactive_workbook/{id}', 'update');
            Route::delete('interactive_workbook/{id}', 'destroy');
            Route::get('interactive_workbook_web_url', 'interactiveWorkbookUrl');
        });

        Route::controller(InteractiveDetailController::class)->group(function() {
            Route::post('interactive_detail', 'store');
            Route::delete('interactive_detail/{id}', 'destroy');
            Route::get('interactive_detail/{interactive_workbook_id}', 'getDetailsUserwise');
        });

        Route::controller(UserCourseActivityController::class)->group(function() {
            Route::post('user_course_activity_update_status','updateStatus');
            // Route::post('add_update_user_course_activity','userCourseActivityCreate');
        });

        Route::controller(UserQuizAnswerController::class)->group(function() {
            Route::post('user_quiz_answer', 'UserQuizAnswerApi');
        });

        Route::controller(FeaturedController::class)->group(function() {
            Route::get('dashboard_featured', 'featuredApi');
        });

        Route::controller(SessionController::class)->group(function() {
            Route::get('sessions', 'index');
            Route::post('session', 'store');
            Route::get('session/{id}', 'show');
            Route::post('session/{id}', 'update');
            Route::delete('session/{id}', 'destroy');
            Route::get('one_two_one_session_details', 'oneTwoOneSessionDetails');
            Route::get('applied_user_list/{session_id}', 'appliedUserList');
            Route::get('stripe_session_payment_initialize/{session_duration_id}', 'StripeSessionPaymentInitialize');
        });

        Route::controller(SessionPriceTransactionController::class)->group(function(){
            Route::get('session/{session_id}/session_duration', 'sessionDurationList');
        });
    });
