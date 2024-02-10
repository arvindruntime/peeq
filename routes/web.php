<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PinController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\CmsPageController;
use App\Http\Controllers\WebEditorController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\v1\ChatController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\QuizController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaymentPlanController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Api\v1\EventController;
use App\Http\Controllers\Api\v1\MediaController;
use App\Http\Controllers\DownloadRSVPController;
use App\Http\Controllers\Api\v1\SearchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Api\v1\FeaturedController;
use App\Http\Controllers\Api\v1\TimeZoneController;
use App\Http\Controllers\Api\v1\ContactUsController;
use App\Http\Controllers\Api\v1\PollOptionController;
use App\Http\Controllers\Api\v1\PostCommentController;
use App\Http\Controllers\Cron\EventReminderController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Api\v1\CourseModuleController;
use App\Http\Controllers\Api\v1\InviteMemberController;
use App\Http\Controllers\Api\v1\PostActivityController;
use App\Http\Controllers\Api\v1\UserActivityController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\InteractiveWorkbookController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Api\v1\EventActivityController;
use App\Http\Controllers\Api\v1\ChangePasswordController;
use App\Http\Controllers\Api\v1\ContactSupportController;
use App\Http\Controllers\Api\v1\UserQuizAnswerController;
use App\Http\Controllers\UserInteractiveDetailController;
use App\Http\Controllers\Api\v1\PlanTransactionsController;
use App\Http\Controllers\Api\v1\PushNotificationController;
use App\Http\Controllers\Api\v1\WelcomeChecklistController;
use App\Http\Controllers\Api\v1\InteractiveDetailController;
use App\Http\Controllers\Api\v1\NotificationDetailController;
use App\Http\Controllers\Api\v1\UserCourseActivityController;
use App\Http\Controllers\Admin\AdminInteractiveWorkbookController;
use App\Http\Controllers\Api\v1\CourseController as V1CourseController;
use App\Http\Controllers\Admin\SessionController as webAdminSessioncontroller;
use App\Http\Controllers\Api\v1\CourseController as userCourseController;
use App\Http\Controllers\Api\v1\InteractiveWorkbookController as byAdmin;
use App\Http\Controllers\CourseController as ControllersCourseController;
use App\Http\Controllers\Api\v1\SessionController as sessionapiController;
use App\Http\Controllers\cron\ProfileCompletionController;
use App\Http\Controllers\SessionController as ControllersSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    if (env('WEB_ENV')=='local') {
        // Define routes specific to the local environment
    } else {
        // Define routes for the live environment
        URL::forceScheme('https');
    }
    
    Route::fallback(function () {
        return view('errors.404');
    });    
    Route::get('/', function () {
        return view('auth.login');
    })->middleware('redirect.authenticated');
    
    Route::get('check_email/{email}',[LoginController::class, 'check_email'])->name('check.email.user');
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('reset-password/{token}/{email}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    
    
    Route::get('download-rsvp/{id}',[DownloadRSVPController::class, 'index'])->name('download.rsvp');
    
    Auth::routes();

    Route::controller(LandingPageController::class)->group(function() {
        Route::get('landing-page', 'index')->name('landing.index');
        Route::get('about', 'aboutUs')->name('landing.about');
        Route::get('contact', 'contactUs')->name('landing.contact');
    });
    
    // Cms Pages
    Route::controller(CmsPageController::class)->group(function() {
        Route::get('privacy-policy', 'privacyPolicy')->name('privacy.policy');
        Route::get('terms-of-service', 'termsAndCondition')->name('terms.conditions');
        Route::get('contact-support', 'contactSupport')->name('contact.support');
        Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
    });

    //contact suppport method
    Route::controller(ContactSupportController::class)->group(function(){
        Route::get('contact_supports', 'index')->name('contact.support.show');
        Route::post('contact_support', 'store')->name('contact.support.store');
    });
        
    Route::controller(CookieController::class)->group(function() {
        Route::post('accept-cookies', 'acceptCookies')->name('accept.cookies');
        Route::post('read-cookies', 'readCookies')->name('read.cookies');
    });
    
    Route::controller(SocialController::class)->group(function(){
        /* Google social API*/
        Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('auth/google/callback', 'handleGoogleCallback');

        /* Facebook social API*/
        Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
        Route::get('auth/facebook/callback', 'handleFacebookCallback');

        /* LinkedIn social API*/
        Route::get('auth/linkedin', 'redirectToLinkedIn')->name('auth.linkedin');
        Route::get('auth/linkedin/callback', 'handleLinkedInCallback');

    });

    Route::controller(EditorController::class)->group(function(){
        Route::get('editor', 'index');
        Route::post('upload-video', 'upload')->name('upload.video');
        Route::post('upload-image', 'uploadImage')->name('upload.image');
        Route::post('upload-file', 'uploadFile')->name('upload.file');
         
               
    });

    Route::controller(PinController::class)->group(function() {
        Route::get('enter-pin', 'enterPinForm')->name('enter.pin.page');
        Route::get('process-pin-submission', 'processPinSubmission')->name('process.pin.submission');
    });
    
    /** Contact Us API */
    Route::controller(ContactUsController::class)->group(function(){
        Route::post('contact_us', 'store')->name('contact_us');
    });

    // Route::controller(WebEditorController::class)->group(function(){
    //     Route::get('web-editor', 'index');
    //     Route::post('upload-video', 'upload')->name('upload.video');
    //     Route::post('upload-image', 'uploadImage')->name('upload.image'); 
               
    // });
    // Route::group(['middleware' => 'auth'], function () {
        
        
        Route::get('success-course-payment/{id}', [PaymentPlanController::class, 'successCoursePayment'])->name('success.course.payment');
        Route::get('cancel-course-payment/{id}', [PaymentPlanController::class, 'cancelCoursePayment'])->name('cancel.course.payment');
        
        /// Route for Session payment
        
        Route::get('success-session-payment/{id}', [PaymentPlanController::class, 'successSessionPayment'])->name('success.session.payment');
        Route::get('cancel-session-payment/{id}', [PaymentPlanController::class, 'cancelSessionPayment'])->name('cancel.session.payment');
        
        
        //Route::get('success-course-payment', 'PaymentPlanController@successCoursePayment')->name('success.course.payment');
        //Route::get('cancel-course-payment', 'PaymentPlanController@cancelCoursePayment')->name('cancel.course.payment');
        
        // Route::get('success-course-payment', 'successCoursePayment')->name('success.course.payment');
        // Route::get('cancel-course-payment', 'cancelCoursePayment')->name('cancel.course.payment');
        
    Route::middleware(['auth','auth.redirect'])->group(function () {

        Route::controller(PaymentPlanController::class)->group(function() {
            Route::get('choose_plan', 'choosePlan')->name('paymentPlans.index');
            Route::get('welcome_checklist_popup', 'goToDashboard')->name('dashboard.welcomepopup');
            Route::get('payment_plan/{id}', 'getPlan')->name('paymentPlans.get');
            Route::post('stripe', 'stripePost')->name('stripe.post');
      
            
            /// Route added on 06-09-2023 //////
            Route::get('course-payment-plan/{id}', 'getCoursePlan')->name('course.payment.plan');
            Route::post('session-payment-plan', 'getSessionPlan')->name('session.payment.plan');
            
        });

        Route::controller(DashboardController::class)->group(function(){
            Route::get('dashboard', 'index')->name('dashboard')->middleware('checkPlanActivation');
        });
        
        // Route::controller(DashboardController::class)->group(function(){
        //     Route::middleware(['welcome.checklist.completed'])->group(function () {
        //         Route::get('dashboard', 'index')->name('dashboard');
        //     });
        //     // Other routes can go here if needed.
        // });    
        
        Route::controller(WelcomeChecklistController::class)->group(function(){
            Route::get('welcome_checklists', 'index')->name('welcome_checklists');
            Route::get('download_app', 'downloadApp')->name('download_app');
        });
        
        Route::controller(UserController::class)->group(function(){
            Route::get('users/{id}', 'show')->name('user.edit');
            Route::post('users/{id}', 'update')->name('user.update');
            Route::get('member_list', 'memberList')->name('member.list');
            Route::get('member/{id}', 'showMember')->name('member');
            Route::get('change-password', 'changePassword')->name('change-password');
            Route::get('follower-list', 'followerList')->name('follower.list');
            Route::get('following-list', 'followingList')->name('following.list');
        });

        Route::controller(PostController::class)->group(function(){
            Route::get('posts', 'index')->name('posts.index');
            Route::get('post/{id}', 'show')->name('show');
            Route::post('posts', 'store')->name('posts.store');
            Route::get('post_edit/{id}', 'postEdit')->name('post.edit');
            Route::post('post/{id}', 'update')->name('post.update');
            Route::delete('posts/{id}', 'destroy')->name('posts.delete');
            Route::post('posts/save/{id}', 'save')->name('posts.save');
            Route::post('posts/mute/{id}', 'mute')->name('posts.mute');
            Route::get('featured_post', 'featuredPost')->name('post.featuredpost');
            Route::post('featured_post_status_update/{id}', 'featuredPostStatusUpdate')->name('posts.featured.post.status.update');
            
            //// Filtered post lists ///
            Route::get('post_by_filter', 'filteredPost')->name('posts.filtered');
        });
        
        /** User Activity API */
        Route::controller(UserActivityController::class)->group(function() {
            Route::post('member_activity_action', 'memberActivityAction')->name('member.activity.action');
            Route::post('member_report', 'memberReport')->name('member.report');
        });
        
        /** Poll Answer API */
        Route::controller(PollOptionController::class)->group(function() {
            Route::post('poll_answer', 'pollAnswer')->name('poll.answer');
        });
        
        /** Plan Transaction API */
        Route::controller(PlanTransactionsController::class)->group(function(){
            Route::get('plan_transactions', 'index');
            Route::get('plan_transaction/{id}', 'show');
            Route::post('plan_transaction', 'store')->name('plan.transaction');
            Route::post('plan_transaction/{id}', 'update');
            Route::delete('plan_transaction/{id}', 'destroy');
            Route::get('purchase_plan','purchasePlanInfo')->name('purchase.plan');
        });
        
        /* Invite By Member*/
        Route::controller(InviteMemberController::class)->group(function() {
            Route::post('invite_member', 'sendInviteEmail')->name('invite.by_email');
            Route::get('sent_invite_members', 'sentInviteMembers')->name('sent.invite.members');
        });
        
        
        /** Event API */
        Route::controller(EventController::class)->group(function(){
            Route::get('events', 'index')->name('events.index');
            Route::post('event', 'store')->name('events.store');
            Route::get('event/{id}', 'show')->name('events.show');
            Route::post('event/{id}', 'update')->name('events.update');
            Route::delete('event/{id}', 'destroy')->name('events.delete');
            Route::post('featured_event_status_update/{id}', 'featuredEventStatusUpdate')->name('events.featured.event.status.update');

            /* Web route */
            Route::get('events_calendar', 'eventsCalendar')->name('events.calendar');
            Route::get('member-attending', 'rsvpList')->name('events.rsvp.list');
            Route::get('events-create', 'eventsCreate')->name('events.create');
            
            // Rout for Draft event
            Route::get('event_saved_draft', 'saveDraft')->name('event.saved.draft');
        });
        
        /** Event Activity Action API */
        Route::controller(EventActivityController::class)->group(function(){
            Route::post('event_activity_action', 'eventActivityAction')->name('events.activity');
        });

        /** Change Password API */
        Route::controller(ChangePasswordController::class)->group(function(){
            Route::post('change-password', 'ChangePassword')->name('change.password');
        });
        
               
        
        //post comment controller
        // Route::controller(PostCommentController::class)->group(function(){
        //     Route::get('posts_comments/{post}/post_comment', 'index')->name('post.comment.index');
        //     Route::post('posts_comments/{post}/post_comment', 'store')->name('post.comment.store');
        //     Route::get('posts_comments/{id}/post_comment', 'show')->name('post.comment.show');
        // });
        
        /** Post Comment API */
        Route::controller(PostCommentController::class)->group(function() {
            Route::get('posts/{post}/post_comments', 'index')->name('posts.comment.index');
            Route::post('posts/{post}/post_comment', 'store')->name('posts.comment.store');
            Route::get('posts/{post}/post_comment/{postComment}', 'show')->name('posts.comment.show');
            Route::post('posts/{post}/post_comment/{postComment}', 'update');
            Route::delete('posts/{post}/post_comment/{postComment}', 'destroy')->name('post.comment.delete');
        });
        
        /* Global Search API*/
        Route::controller(SearchController::class)->group(function() {
            Route::get('global_search', 'search')->name('global.search');
            Route::get('search_results', 'search')->name('search.results');
        });
        
        Route::controller(ChatController::class)->group(function() {
        //    Route::get('chat/{id}', 'chatMemberList')->name('chat'); 
           Route::get('chat_memberlist', 'chatMemberList')->name('chat.memberlist');
           Route::get('chat_message/{id}' ,'showChatMessage')->name('chat.message');
           Route::post('chat/encodestring',  'encodeString')->name('chat.encodestring');
           Route::post('chat/decodestring', 'decodeString')->name('chat.decodestring');
           Route::post('chat/images', 'storeChatImage')->name('chat.storeMedia');
        });
                
        /** Timezone API */
        Route::controller(TimeZoneController::class)->group(function() {
            Route::get('time_zones', 'index')->name('user.time_zones');
            Route::get('time_zone/{country_id}', 'show')->name('user.time_zones');
        });

        /** InterActive Route */
        Route::controller(InteractiveWorkbookController::class)->group(function() {
            Route::get('interactive-workbook', 'index')->name('user.interactive.workbook');
        });
        
        
        Route::controller(ControllersCourseController::class)->group(function() {
            Route::get('course','index')->name('user.courses.index');
            // Route::get('course-buy','courseBuy')->name('user.courses.buy');
            Route::get('course-lists','courseList')->name('user.courses.lists');
            Route::get('course-viewpay','courseViewpay')->name('user.courses.viewpay');
            // Route::get('course-view','courseView')->name('user.courses.view');
            Route::get('course-video','courseVideo')->name('user.courses.video');
            Route::get('course-audio','courseAudio')->name('user.courses.audio');
            Route::get('course-task','courseTask')->name('user.courses.task');
            Route::get('course-quiz','courseQuiz')->name('user.courses.quiz');
            Route::get('course-question','courseQuestion')->name('user.courses.question');
            Route::get('course-link','courseLink')->name('user.courses.link');
            Route::get('course-closure','courseClosure')->name('user.courses.closure');
            // Quiz
            Route::get('quiz-view','quizView')->name('user.courses.quiz');
        });
        
        /** Course Module API */
        Route::controller(CourseModuleController::class)->group(function(){
            Route::get('course-intro/{course_id}/course_modules', 'index')->name('user.courses.intro');
        });
        
        
        /** Course API */
        Route::controller(userCourseController::class)->group(function(){
            Route::get('user-courses', 'index')->name('user.courses.list');
            Route::get('course/{id}', 'show')->name('user.courses.buy');
            
        });
        
        Route::controller(UserCourseActivityController::class)->group(function() {
            Route::post('user-course-activity-update-status','updateStatus')->name('user.course.activity.update.status');
            // Route::post('add_update_user_course_activity','userCourseActivityCreate');
        });
        
        Route::controller(UserQuizAnswerController::class)->group(function() {
            Route::post('user_quiz_answer', 'UserQuizAnswerApi')->name('user.quiz.answer');
        });
        
        Route::controller(FeaturedController::class)->group(function() {
            Route::get('dashboard_featured', 'featuredApi')->name('dashboard.featured');
        });

        Route::controller(ControllersSessionController::class)->group(function() {
            // Route::get('sessions', 'index')->name('user.session.index');
            // Route::get('sessions-details', 'details')->name('user.session.details');
        });
        
        Route::controller(sessionapiController::class)->group(function() {
            Route::get('sessions-list', 'index')->name('admin.session.list');
            Route::post('session-create', 'store')->name('admin.session.create');
            Route::get('session-detail/{id}', 'show')->name('admin.session.detail');
            Route::post('session/{id}', 'update')->name('admin.session.update');
            Route::delete('session/{id}', 'destroy')->name('admin.session.delete');
            Route::get('one_two_one_session_details', 'oneTwoOneSessionDetails')->name('admin.session.oneTwone');
            Route::get('applied_user_list/{session_id}', 'appliedUserList')->name('applied.user.list');
        });

        /* CRON JOB ROUTES*/
        Route::controller(EventReminderController::class)->group(function(){
            /* event one day before reminder email */
            Route::get('event-reminder-one-day-before', 'eventReminderOneDayBefore')->name('event.reminder.one.day.before');
            /* event one hour before reminder email */
            Route::get('event-reminder-one-hour-before', 'eventReminderOneHourBefore')->name('event.reminder.one.hour.before');
        });
        
        Route::controller(ProfileCompletionController::class)->group(function() {
            /* send profile completion emails 24 hours */
            Route::get('send-profile-completion-emails-24-hours', 'profileCompletionReminderDayAfter');
            /* send profile completion emails one week */
            Route::get('send-profile-completion-emails-one-week', 'profileCompletionReminderOneWeekAfter');
        });
        
    }); /// Auth group closed

    Route::controller(InteractiveDetailController::class)->group(function() {
        Route::post('interactive_detail', 'store')->name('interactive.detail.add');
        Route::delete('interactive_detail/{id}', 'destroy');
        Route::get('interactive_detail/{interactive_workbook_id}', 'getDetailsUserwise')->name('interactive.details');
    });
    
    Route::controller(UserInteractiveDetailController::class)->group(function() {
        Route::post('user_interactive_detail', 'store')->name('user.interactive.detail.store');
        Route::get('get_user_interactive_detail', 'get_page')->name('user.interactive.detail.get');
    });
    
    Route::group(['prefix'=> 'admin', 'middleware' => 'auth'], function () {

        Route::controller(AdminDashboardController::class)->group(function() {
            Route::get('dashboard', 'websiteAnalytics')->name('admin.dashboard');
            
        });

        Route::controller(byAdmin::class)->group(function(){
            Route::get('interactive_workbooks', 'index');
            Route::post('interactive_workbook', 'store')->name('interactive.workbook.store');
            Route::get('interactive_workbook/{id}', 'show');
            Route::post('interactive_workbook/{id}', 'update')->name('interactive.workbook.update');
            Route::delete('interactive_workbook/{id}', 'destroy')->name('interactive.workbook.delete');
            Route::get('interactive_workbook_web_url', 'interactiveWorkbookUrl');
        });
        
        /** Course Route */
        Route::controller(CourseController::class)->group(function() {
            Route::get('courses-index', 'index')->name('admin.courses.index');
             Route::get('create-course', 'create')->name('admin.courses.create');
            Route::get('course-inner/{id}','courseInner')->name('admin.courses.inner');
            Route::get('course-module-add/{id}','courseAdd')->name('admin.courses.add.module');
            Route::get('course-module-edit/{id}','courseModuleEdit')->name('admin.courses.edit.module');
            Route::POST('course-module-update/{id}','courseModuleUpdate')->name('admin.courses.update.module');
            // Route::get('course-overview','courseOverview')->name('admin.courses.overview');
            Route::get('course-overview/{course_id}','courseOverview')->name('admin.courses.overview');  // as of now Not using
            Route::get('course-modulesetting','courseModulesetting')->name('admin.courses.modulesetting');
            Route::get('course-addview','courseAddview')->name('admin.courses.addview');
            Route::get('course-setting','courseSetting')->name('admin.courses.setting');
            Route::get('course-edit/{id}','courseEdit')->name('admin.course.edit');

            /** Quiz Routes */
            
            Route::get('quiz-inner/{courseModule}', 'quizInner')->name('admin.quiz.inner');
            
        //    Route::get('quiz-create/{id}', 'createQuiz')->name('admin.quiz.create');
           Route::get('quiz-create', 'createQuiz')->name('admin.quiz.create');
           Route::get('quiz-edit/{courseModule}', 'editQuiz')->name('admin.quiz.edit');
        });
        
        /** Course API */
        Route::controller(V1CourseController::class)->group(function(){
            Route::get('course-list', 'index')->name('admin.courses.list');
            Route::post('course', 'store')->name('admin.course.create');
            Route::get('course-view/{id}', 'show')->name('user.courses.view');
            Route::post('course/{id}', 'update')->name('admin.course.update');
            Route::delete('course/{id}', 'destroy')->name('admin.course.delete');
            Route::post('featured_course_status_update/{id}', 'featuredCourseStatusUpdate')->name('courses.featured.course.status.update');
            /** Coach List */
            Route::get('coach_list', 'coachList');
        });
        
        /** Course Module API */
        Route::controller(CourseModuleController::class)->group(function(){
            // Route::get('course-overview/{course_id}/course_modules', 'index');
            Route::get('courses/{course_id}/course_modules', 'index')->name('admin.courses.overview.xhr');
            Route::post('course_module', 'addUpdate')->name('course.module.add');
            Route::post('course_module/{course_module}', 'addUpdate');
            Route::get('course_module/{id}', 'show')->name('course.module.preview');
            Route::delete('course_module/{id}', 'destroy')->name('course.module.delete');
        });
        
                
        /** Quiz API */
        Route::controller(QuizController::class)->group(function() {
            Route::get('quiz_list', 'index');
            Route::post('quiz', 'store')->name('quiz.add');
            Route::get('quiz/{id}', 'show')->name('quiz.update');
            Route::post('quiz/{id}', 'update')->name('admin.quiz.update.data');
            Route::get('quiz-preview/{courseModule}', 'getQuizModuleWise')->name('admin.quiz.preview');
            Route::delete('quiz/{id}', 'destroy')->name('quiz.delete');
        });

        // Users Route
        Route::controller(UserController::class)->group(function(){
            Route::get('users', 'index')->name('admin.users.index');
            Route::get('user/{id}', 'edit')->name('admin.user.edit');
            Route::get('user/{id}', 'show')->name('admin.user.show');
            Route::post('user/{id}', 'update')->name('admin.user.update');
            Route::delete('user/{id}', 'deleteAccount')->name('delete.account');
        });

        // Plan Routes
        Route::controller(PlanController::class)->group(function(){
            Route::get('plans', 'index')->name('admin.plans.index');
            Route::get('plans/{id}', 'show')->name('admin.plans.show');
            Route::post('plans', 'store')->name('admin.plans.store');
            Route::get('plans/{id}', 'edit')->name('admin.plans.edit');
            Route::post('plans/{id}', 'update')->name('admin.plans.update');
            Route::delete('plans/{id}', 'destroy')->name('admin.plans.delete');
        });

        // Email Template Routes
        Route::controller(EmailTemplateController::class)->group(function(){
            Route::get('email_templates', 'index')->name('admin.emailTemplates.index');
            Route::get('email_template/{id}', 'show')->name('admin.emailTemplate.show');
            Route::post('email_template', 'store')->name('admin.emailTemplate.store');
            Route::get('email_template/{id}', 'edit')->name('admin.emailTemplate.edit');
            Route::post('email_template/{id}', 'update')->name('admin.emailTemplate.update');
            Route::delete('email_template/{id}', 'destroy')->name('admin.emailTemplate.delete');
        });

        // Admin Route
        Route::controller(AdminController::class)->group(function(){
            Route::get('admins', 'index')->name('admin.index');
            Route::get('admins/{id}', 'show')->name('admin.show');
            Route::post('admins', 'store')->name('admin.store');
            Route::get('admins/{id}', 'edit')->name('admin.edit');
            Route::post('admins/{id}', 'update')->name('admin.update');
            Route::delete('admins/{id}', 'destroy')->name('admin.destroy');
        });
        
        /** Post Activity API */
        Route::controller(PostActivityController::class)->group(function() {
            Route::get('post_activities', 'index');
            Route::post('post_activity', 'store');
            Route::get('post_activity/{id}', 'show');
            Route::post('post_activity/{id}', 'update');
            Route::delete('post_activity/{id}', 'destroy');
            Route::post('post_activity_action', 'postActivityAction')->name('post_activity_action');
            Route::post('report', 'report')->name('report');
        });
                
        Route::controller(NotificationDetailController::class)->group(function() {
            Route::get('notification_details', 'index');
            Route::post('notification_detail', 'store');
            Route::get('notification_detail/{id}', 'show');
            Route::post('notification_detail/{id}', 'update');
            Route::delete('notification_detail/{id}', 'destroy');
            Route::get('change_status', 'changeStatus')->name('notification.change_status');
        });
        
        /** Push Notification Listing Api */
        Route::controller(PushNotificationController::class)->group(function() {
            Route::get('push_notifications', 'index')->name('push.notifications');
            Route::post('push_notification_update_count', 'updateViewdNotification')->name('notification.update.count');
        });
        
        /** Media API */
        Route::controller(MediaController::class)->group(function() {
            Route::get('media_list', 'index');
            Route::post('media', 'store')->name('media');
            Route::get('media/{id}', 'show');
            Route::post('media/{id}', 'update');
            Route::delete('media/{id}', 'destroy');
        });

        Route::controller(AdminInteractiveWorkbookController::class)->group(function() {
            // Route::get('add-interactive-workbook', 'addInteractiveWorkbook')->name('admin.interactive.add.workbook');
            // Route::get('add-interactive-workbook/{course_id}/{course_module_id}', 'addInteractiveWorkbook')->name('admin.interactive.add.workbook');
            Route::get('add-interactive-workbooks/{course_id}/{course_module_id}', 'InteractiveWorkbookAdd')->name('admin.interactive.add');
            Route::get('list-interactive-workbook/{courseModule}', 'listInteractiveWorkbook')->name('admin.interactive.list.workbook');
            Route::get('editor-interactive-workbook/{id}', 'editorInteractiveWorkbook')->name('admin.interactive.editor.workbook');
          //  Route::get('view-interactive-workbook/{courseModule}', 'viewInteractiveWorkbook')->name('admin.interactive.view.workbook');
        });

        Route::controller(webAdminSessioncontroller::class)->group(function() {
            Route::get('sessions', 'index')->name('web.admin.session.index');
            Route::get('session-add', 'create')->name('web.admin.session.create');
            Route::get('session-edit/{id}', 'sessionEdit')->name('admin.session.edit');

            
        });
    });
    Route::controller(AdminInteractiveWorkbookController::class)->group(function() {
        Route::get('view-interactive-workbook/{courseModule}/{user}', 'viewInteractiveWorkbook')->name('admin.interactive.view.workbook');
    });
