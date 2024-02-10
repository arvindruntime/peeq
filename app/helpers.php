<?php

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\ChatMsg;
use App\Models\Country;
use App\Models\TimeZone;
use App\Models\PostComment;
use App\Models\Notification;
use App\Models\PostActivity;
use Illuminate\Http\Request;
use App\Models\EventActivity;
use App\Models\WelcomeChecklist;
use App\Models\InteractiveDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TimeZoneResource;
use Laravel\Passport\Client as AuthClient;

if (!function_exists('generateClientTokenWithoutPassword')) {
    function generateClientTokenWithoutPassword($user)
    {
        $auth_client = AuthClient::find(2);
        $params = [
            'grant_type' => 'client_credentials',
            'client_id' => $auth_client->id,
            'client_secret' => $auth_client->secret,
            'username' => $user->phone,
            'password' => '',
        ];

        Request()->request->add($params);
        $proxy = Request::create('oauth/token', 'POST', $params);
        $response = \Route::dispatch($proxy);
        return (array) array_merge(json_decode($response->getContent(), true), [ 'user' => $user->toArray() ]);
    }
}

if (!function_exists('encryptString')) {
    function encryptString($string)
    {
        $cipher_key='~OC+b$&!?HJ$%@@E^%@$$Ujs+d$$OC@!';
        $method = 'aes-256-cbc';

        $iv = '~OC+b$&!?HJ$%@@E';
        
        $encrypted = base64_encode(openssl_encrypt($string, $method, $cipher_key, OPENSSL_RAW_DATA, $iv));

        return $encrypted;
    }
}

if (!function_exists('decryptString')) {
    function decryptString($string)
    {
        $cipher_key='~OC+b$&!?HJ$%@@E^%@$$Ujs+d$$OC@!';
        $method = 'aes-256-cbc';

        $iv = '~OC+b$&!?HJ$%@@E';
        
        $decrypted = openssl_decrypt(base64_decode($string), $method, $cipher_key, OPENSSL_RAW_DATA, $iv);

        return $decrypted;
    }
}

if (!function_exists('unreadMessagesCount')) {
    function unreadMessagesCount($from, $to) {
        return ChatMsg::where('from', $from)->where('user_id', $to)->where('status', '0')->get()->count();
    }
}
if (!function_exists('allMessageCount')) {
    function allMessageCount($from) {
        return ChatMsg::where('from', $from)->get()->count();
    }
}

if (!function_exists('sendError')) {
    function sendError($code = 500, $error = "", $exceptionMsg = '')
    {
        /* Plan Expired or not (start) */
        if(Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = $result['userList']['id'] ?? null; 
        }
        $user = User::find($userId);
        
        if ($user) {
            $userCreatedDate = $user->created_at;
            $oneYearAgo = now()->subYear();
        }
        /* Plan Expired or not (end) */

        if (!empty($exceptionMsg)) {
            \Log::error($exceptionMsg);
        }
        
        $response = [
            'status' => 400,
            'statusState' => 'error',
            'message' => (empty($error) ? 'Something went wrong' : $error),
        ];

        /* Plan Expired or not key (start) */
        if($user) {
            $response['plan_expired'] = (int)$userCreatedDate->lessThan($oneYearAgo);
        } else {
            $response['plan_expired'] = 0;
        }
        /* Plan Expired or not key (end) */

        if (request()->wantsJson()) {
            return response()->json($response, 400);
        }

        return $response;
    }
}

if (!function_exists('sendResponse')) {
    function sendResponse($result, $message = "")
    {
        /* Plan Expired or not (start) */
        if(Auth::check()) {
            $userId = Auth::user()->id;
        } else {
            $userId = $result['userList']['id'] ?? null; 
        }
        $user = User::find($userId);
        
        if ($user) {
            $userCreatedDate = $user->created_at;
            $oneYearAgo = now()->subYear();
        }
        /* Plan Expired or not (end) */
        $data = [
            'status' => 200,
            'statusState' => 'success',
            'data'    => $result,
            'message' => (empty($message) ? 'success' : $message),
        ];

        /* Plan Expired or not key (start) */
        if($user) {
            $data['plan_expired'] = (int)$userCreatedDate->lessThan($oneYearAgo);
        } else {
            $data['plan_expired'] = 0;
        }
        /* Plan Expired or not key (end) */

        if (request()->wantsJson()) {
            return response()->json($data, 200);
        }

        return $data;
    }
}

if (!function_exists('setEmptyData')) {
    /**
    * Apply a empty string instead of null recursively to every member of an array
    * Set "" value instead of NULL in data
    * passing eloquent object inside array_walk_recursive
    * before passing we need to convert into array from eloquent object using ->toArray() method
    * @param array $arr
    * @return array
    */
    function setEmptyData($arr)
    {
        $key = '';
        array_walk_recursive($arr, function (&$item, $key) {
            $item = null === $item ? '' : $item;
        });
        return $arr;
    }
}

if (!function_exists('generateClientToken')) {
    function generateClientToken($user, $password)
    {
        $auth_client = AuthClient::find(2);
        $params = [
            'grant_type' => 'password',
            'client_id' => $auth_client->id,
            'client_secret' => $auth_client->secret,
            'username' => $user->email,
            'password' => $password,
        ];

        Request()->request->add($params);
        $proxy = Request::create('oauth/token', 'POST', $params);
        $response = Route::dispatch($proxy);
        return (array) json_decode($response->getContent());
    }
}

// add by drashti 6 march 2023
if (!function_exists('get_timezone')) {
    function get_timezone()
    {
        return [
            'Pacific/Midway' => '(GMT-11:00) Midway Island, Samoa',
            'America/Adak' => '(GMT-10:00) Hawaii-Aleutian',
            'Etc/GMT+10' => '(GMT-10:00) Hawaii',
            'Pacific/Marquesas' => '(GMT-09:30) Marquesas Islands',
            'Pacific/Gambier' => '(GMT-09:00) Gambier Islands',
            'America/Anchorage' => '(GMT-09:00) Alaska',
            'America/Ensenada' => '(GMT-08:00) Tijuana, Baja California',
            'Etc/GMT+8' => '(GMT-08:00) Pitcairn Islands',
            'America/Los_Angeles' => '(GMT-08:00) Pacific Time (US & Canada)',
            'America/Denver' => '(GMT-07:00) Mountain Time (US & Canada)',
            'America/Chihuahua' => '(GMT-07:00) Chihuahua, La Paz, Mazatlan',
            'America/Dawson_Creek' => '(GMT-07:00) Arizona',
            'America/Belize' => '(GMT-06:00) Saskatchewan, Central America',
            'America/Cancun' => '(GMT-06:00) Guadalajara, Mexico City, Monterrey',
            'Chile/EasterIsland' => '(GMT-06:00) Easter Island',
            'America/Chicago' => '(GMT-06:00) Central Time (US & Canada)',
            'America/New_York' => '(GMT-05:00) Eastern Time (US & Canada)',
            'America/Havana' => '(GMT-05:00) Cuba',
            'America/Bogota' => '(GMT-05:00) Bogota, Lima, Quito, Rio Branco',
            'America/Caracas' => '(GMT-04:30) Caracas',
            'America/Santiago' => '(GMT-04:00) Santiago',
            'America/La_Paz' => '(GMT-04:00) La Paz',
            'Atlantic/Stanley' => '(GMT-04:00) Faukland Islands',
            'America/Campo_Grande' => '(GMT-04:00) Brazil',
            'America/Goose_Bay' => '(GMT-04:00) Atlantic Time (Goose Bay)',
            'America/Glace_Bay' => '(GMT-04:00) Atlantic Time (Canada)',
            'America/St_Johns' => '(GMT-03:30) Newfoundland',
            'America/Araguaina' => '(GMT-03:00) UTC-3',
            'America/Montevideo' => '(GMT-03:00) Montevideo',
            'America/Miquelon' => '(GMT-03:00) Miquelon, St. Pierre',
            'America/Godthab' => '(GMT-03:00) Greenland',
            'America/Argentina/Buenos_Aires' => '(GMT-03:00) Buenos Aires',
            'America/Sao_Paulo' => '(GMT-03:00) Brasilia',
            'America/Noronha' => '(GMT-02:00) Mid-Atlantic',
            'Atlantic/Cape_Verde' => '(GMT-01:00) Cape Verde Is.',
            'Atlantic/Azores' => '(GMT-01:00) Azores',
            'Europe/Belfast' => '(GMT) Greenwich Mean Time : Belfast',
            'Europe/Dublin' => '(GMT) Greenwich Mean Time : Dublin',
            'Europe/Lisbon' => '(GMT) Greenwich Mean Time : Lisbon',
            'Europe/London' => '(GMT) Greenwich Mean Time : London',
            'Africa/Abidjan' => '(GMT) Monrovia, Reykjavik',
            'Europe/Amsterdam' => '(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna',
            'Europe/Belgrade' => '(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague',
            'Europe/Brussels' => '(GMT+01:00) Brussels, Copenhagen, Madrid, Paris',
            'Africa/Algiers' => '(GMT+01:00) West Central Africa',
            'Africa/Windhoek' => '(GMT+01:00) Windhoek',
            'Asia/Beirut' => '(GMT+02:00) Beirut',
            'Africa/Cairo' => '(GMT+02:00) Cairo',
            'Asia/Gaza' => '(GMT+02:00) Gaza',
            'Africa/Blantyre' => '(GMT+02:00) Harare, Pretoria',
            'Asia/Jerusalem' => '(GMT+02:00) Jerusalem',
            'Europe/Minsk' => '(GMT+02:00) Minsk',
            'Asia/Damascus' => '(GMT+02:00) Syria',
            'Europe/Moscow' => '(GMT+03:00) Moscow, St. Petersburg, Volgograd',
            'Africa/Addis_Ababa' => '(GMT+03:00) Nairobi',
            'Asia/Tehran' => '(GMT+03:30) Tehran',
            'Asia/Dubai' => '(GMT+04:00) Abu Dhabi, Muscat',
            'Asia/Yerevan' => '(GMT+04:00) Yerevan',
            'Asia/Kabul' => '(GMT+04:30) Kabul',
            'Asia/Yekaterinburg' => '(GMT+05:00) Ekaterinburg',
            'Asia/Tashkent' => '(GMT+05:00) Tashkent',
            'Asia/Kolkata' => '(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi',
            'Asia/Katmandu' => '(GMT+05:45) Kathmandu',
            'Asia/Dhaka' => '(GMT+06:00) Astana, Dhaka',
            'Asia/Novosibirsk' => '(GMT+06:00) Novosibirsk',
            'Asia/Rangoon' => '(GMT+06:30) Yangon (Rangoon)',
            'Asia/Bangkok' => '(GMT+07:00) Bangkok, Hanoi, Jakarta',
            'Asia/Krasnoyarsk' => '(GMT+07:00) Krasnoyarsk',
            'Asia/Hong_Kong' => '(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi',
            'Asia/Irkutsk' => '(GMT+08:00) Irkutsk, Ulaan Bataar',
            'Australia/Perth' => '(GMT+08:00) Perth',
            'Australia/Eucla' => '(GMT+08:45) Eucla',
            'Asia/Tokyo' => '(GMT+09:00) Osaka, Sapporo, Tokyo',
            'Asia/Seoul' => '(GMT+09:00) Seoul',
            'Asia/Yakutsk' => '(GMT+09:00) Yakutsk',
            'Australia/Adelaide' => '(GMT+09:30) Adelaide',
            'Australia/Darwin' => '(GMT+09:30) Darwin',
            'Australia/Brisbane' => '(GMT+10:00) Brisbane',
            'Australia/Hobart' => '(GMT+10:00) Hobart',
            'Asia/Vladivostok' => '(GMT+10:00) Vladivostok',
            'Australia/Lord_Howe' => '(GMT+10:30) Lord Howe Island',
            'Etc/GMT-11' => '(GMT+11:00) Solomon Is., New Caledonia',
            'Asia/Magadan' => '(GMT+11:00) Magadan',
            'Pacific/Norfolk' => '(GMT+11:30) Norfolk Island',
            'Asia/Anadyr' => '(GMT+12:00) Anadyr, Kamchatka',
            'Pacific/Auckland' => '(GMT+12:00) Auckland, Wellington',
            'Etc/GMT-12' => '(GMT+12:00) Fiji, Kamchatka, Marshall Is.',
            'Pacific/Chatham' => '(GMT+12:45) Chatham Islands',
            'Pacific/Tongatapu' => '(GMT+13:00) Nuku`alofa',
            'Pacific/Kiritimati' => '(GMT+14:00) Kiritimati',
        ];
    }
}
    
    if (!function_exists('welcomeChecklists')) {
        function welcomeChecklists($request)
        {
            $stepVerification = User::where('id', Auth::user()->id)->value('step_verification');
            
            $stepVerification_array = explode(",",$stepVerification);
            
            // if($request['is_mobile']==1)
            // {
            //     $verify_array  = ["1","3","2","4"];
            // }
            // else
            // {    
                // $verify_array  = ["1","3","2","4","5"];
                $verify_array  = ["1","3","2","4",'5']; // Updated by arvind
            // }
            
            $result = array_diff($verify_array,$stepVerification_array);
            
            if($result)
            {
                foreach($result as $value)
                {     
                    if(in_array($value,$stepVerification_array)){
                        $welcome_checklist_complete = 1;
                        $user = Auth::user();
                        $user->welcome_checklist_complete = $welcome_checklist_complete;
                        $user->save();
                    } else {
                        $welcome_checklist_complete = 0;
                    }
                }
            }
            else{
                $welcome_checklist_complete = 1;
                $user = Auth::user();            
                $user->welcome_checklist_complete = $welcome_checklist_complete;
                $user->save();
            }
    
            $is_mobile = $request['is_mobile'] ?? 0;
            $welcomeChecklists = WelcomeChecklist::where('is_mobile', $is_mobile)->get();
    
            foreach ($welcomeChecklists as $key => $step) { 
                $user = Auth::user();
    
                $stepVerification = explode(",",$user->step_verification);
                
                if(in_array($step->id,$stepVerification)) {
                    $step = 'active';
                } else {
                    $step = 'inactive';
                }
        
                $welcomeChecklists[$key]['status'] = $step;
            }
            $message = 'Welcome checklist listed successfully.';
    
            $data = [
                'welcome_checklist_complete' => $welcome_checklist_complete,
                'welcomeChecklists'    => $welcomeChecklists,
            ];
    
            return $data;
    
        }
    }
    
    if (!function_exists('postResponse')) {
        function postResponse($request)
        {
            $userId = Auth::user()->id;
            $posts = Post::select('posts.*', DB::raw('CASE WHEN post_activities.is_like = 1 THEN 1 ELSE 0 END AS is_like'), 
                                                DB::raw('CASE WHEN post_activities.is_save = 1 THEN 1 ELSE 0 END AS is_save'),
                                                DB::raw('CASE WHEN post_activities.is_mute = 1 THEN 1 ELSE 0 END AS is_mute'),
                                                DB::raw('CASE WHEN post_activities.is_report = 1 THEN 1 ELSE 0 END AS is_report'),
                                                DB::raw('CASE WHEN post_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                                                DB::raw('CASE WHEN post_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member'),
                                                DB::raw('CASE WHEN post_activities.is_hide_post = 1 THEN 1 ELSE 0 END AS is_hide_post'))
            ->leftJoin('post_activities', function($join) use ($userId) {
                $join->on('posts.id', '=', 'post_activities.post_id')
                        ->where('post_activities.user_id', '=', $userId);
            })
            // ->with(['user.location', 'pollOptions', 'postComments.user', 'postComments.replies.user'])->where('posts.id', $request)->first();
            ->with(['user.location', 'pollOptions', 'postComments' => function ($query) {
                $query->with(['user', 'replies.user'])
                ->whereHas('user', function ($query) {
                    $query->whereNull('deleted_at');
                })->latest()->take(1);
            }])->where('posts.id', $request)->first();

            $post = $posts->toArray();
                $count_is_like = PostActivity::where('post_id', $post['id'])->where('is_like',1)->get();
                $count_is_like = !empty($count_is_like) ? count($count_is_like) : 0;
                $count_comments = PostComment::where('postcommentable_id', $post['id'])->count();
                // $post_activity = PostActivity::select('user_id')->where('post_id', $post['id'])->where('is_like',1)->orderBy('id', 'DESC')
                //                                 ->with('user', function ($q) {
                //                                     $q->select('id', 'first_name','last_name', 'profile_image');
                //                                 })->limit(3)->get();

                $post_activity = PostActivity::with(['user' => function($query) {
                    $query->select('id', 'first_name', 'last_name', 'profile_image');
                }])
                ->select('post_activities.user_id')
                ->join('users', 'users.id', '=', 'post_activities.user_id')
                ->where('post_activities.post_id', $post['id'])
                ->where('post_activities.is_like', 1)
                ->whereNull('users.deleted_at')
                ->orderBy('post_activities.id', 'DESC')
                ->limit(3)
                ->get();

                $post['post_activity'] = $post_activity;
                $post['count_is_like'] = $count_is_like;
                $post['count_comments'] = $count_comments;

                // Dynamic count
                foreach ($post['poll_options'] as $value => $pollAnswer) {
                    // Total answered member count
                    $idString = $pollAnswer['answer_member_id'];
                    $ids = explode(",", $idString);
                    $answeredMemberCount = count(array_filter($ids));
                    $post['poll_options'][$value]['total_answered_member_count'] = $answeredMemberCount;

                    // Total answer on this question count
                    $totalAnswerOnThisQuestion = 0;
                    foreach ($post['poll_options'] as $option) {
                        $idString = $option['answer_member_id'];
                        $ids = explode(",", $idString);
                        $answeredMemberCount = count(array_filter($ids));
                        $totalAnswerOnThisQuestion += $answeredMemberCount;
                    }
                    $post['poll_options'][$value]['total_answer_on_this_question_count'] = $totalAnswerOnThisQuestion;

                    // Auth user poll option answer key 0 or 1 set
                    if (($post['post_type'] == "poll_percentage" || $post['post_type'] == "poll_multiple_choice") && !empty($post['poll_options'])) {
                        $anweredMemarray = explode(",", $pollAnswer['answer_member_id']);
                        $answerArray = array_filter($anweredMemarray, 'strlen');
                        if(in_array(Auth::user()->id, $answerArray))
                        {
                            $post['poll_options'][$value]['is_answered'] = 1;
                        } else {
                            $post['poll_options'][$value]['is_answered'] = 0;
                        }  
                    }
                }
                // poll expiration key set
                if($post['poll_expiration'] < Carbon::now()->format('Y-m-d H:i:s')) {
                    $post['is_expired'] = 1;
                } else {
                    $post['is_expired'] = 0;
                }

                if(!empty($post)) {
                    return $post;
                }  
                else
                {
                    return false;
                }
        }
    }

    if (!function_exists('postActivityActionResponse')) {
        function postActivityActionResponse($request)
        {
            $userId = Auth::user()->id;
            $posts = Post::select('posts.*', DB::raw('CASE WHEN post_activities.is_like = 1 THEN 1 ELSE 0 END AS is_like'), 
                                                DB::raw('CASE WHEN post_activities.is_save = 1 THEN 1 ELSE 0 END AS is_save'),
                                                DB::raw('CASE WHEN post_activities.is_mute = 1 THEN 1 ELSE 0 END AS is_mute'),
                                                DB::raw('CASE WHEN post_activities.is_report = 1 THEN 1 ELSE 0 END AS is_report'),
                                                DB::raw('CASE WHEN post_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                                                DB::raw('CASE WHEN post_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member'),
                                                DB::raw('CASE WHEN post_activities.is_hide_post = 1 THEN 1 ELSE 0 END AS is_hide_post'))
            ->leftJoin('post_activities', function($join) use ($userId) {
                $join->on('posts.id', '=', 'post_activities.post_id')
                        ->where('post_activities.user_id', '=', $userId);
            })
            ->with(['user.location', 'pollOptions', 'postComments.user', 'postComments.replies.user'])->where('posts.id', $request)->first();

                    if ($posts) {
                        $post = $posts->toArray();
                        $count_is_like = PostActivity::where('post_id', $post['id'])->where('is_like',1)->get();
                        $count_is_like = !empty($count_is_like) ? count($count_is_like) : 0;
                        $count_comments = PostComment::where('postcommentable_id', $post['id'])->count();
                        $post_activity = PostActivity::select('user_id')->where('post_id', $post['id'])->where('is_like',1)->orderBy('id', 'DESC')
                                                        ->with('user', function ($q) {
                                                            $q->select('id', 'first_name','last_name', 'profile_image');
                                                        })->limit(3)->get();
                        $post['post_activity'] = $post_activity;
                        $post['count_is_like'] = $count_is_like;
                        $post['count_comments'] = $count_comments;

                        // Dynamic count
                        foreach ($post['poll_options'] as $value => $pollAnswer) {
                            // Total answered member count
                            $idString = $pollAnswer['answer_member_id'];
                            $ids = explode(",", $idString);
                            $answeredMemberCount = count(array_filter($ids));
                            $post['poll_options'][$value]['total_answered_member_count'] = $answeredMemberCount;

                            // Total answer on this question count
                            $totalAnswerOnThisQuestion = 0;
                            foreach ($post['poll_options'] as $option) {
                                $idString = $option['answer_member_id'];
                                $ids = explode(",", $idString);
                                $answeredMemberCount = count(array_filter($ids));
                                $totalAnswerOnThisQuestion += $answeredMemberCount;
                            }
                            $post['poll_options'][$value]['total_answer_on_this_question_count'] = $totalAnswerOnThisQuestion;

                            // Auth user poll option answer key 0 or 1 set
                            if (($post['post_type'] == "poll_percentage" || $post['post_type'] == "poll_multiple_choice") && !empty($post['poll_options'])) {
                                $anweredMemarray = explode(",", $pollAnswer['answer_member_id']);
                                $answerArray = array_filter($anweredMemarray, 'strlen');
                                if(in_array(Auth::user()->id, $answerArray))
                                {
                                    $post['poll_options'][$value]['is_answered'] = 1;
                                } else {
                                    $post['poll_options'][$value]['is_answered'] = 0;
                                }  
                            }
                        }
                        
                        // poll expiration key set
                        if($post['poll_expiration'] < Carbon::now()->format('Y-m-d H:i:s')) {
                            $post['is_expired'] = 1;
                        } else {
                            $post['is_expired'] = 0;
                        }
                    }

                if(!empty($post)) {
                    return $post;
                }  
                else
                {
                    return false;
                }
        }
    }

    if (!function_exists('downloadApp')) {
        function downloadApp($request)
        {
            $user = Auth::user();
            $stepVerification = User::where('id', $user->id)->value('step_verification');
            
            $stepVerification_array = explode(",",$stepVerification);
                foreach($request->steps as $value)
                {    
                    $key = array_search($value, $stepVerification_array, true);
                    if ($key !== false) {
                        unset($stepVerification_array[$key]);
                    }
                }
            $stepVerification_string = implode(",",$stepVerification_array);
            $steps_string = implode(",",$request->steps);
    
            $user->step_verification = $stepVerification_string.",".$steps_string;

            $user->save();

            $data = $user->step_verification;

            if(!empty($data)) {
                return $data;
            } 
            else
            {
                return false;
            }
        }
    }
    
    if (!function_exists('countryList')) {
        function countryList()
        {
            $countries = Country::all();
            if(!empty($countries)) {
                return $countries;
            } 
            else
            {
                return false;
            }
        }
    }
    
    // if (!function_exists('timeZoneList')) {
    //     function timeZoneList()
    //     {
    //         $timeZones = TimeZone::all();
    //         if(!empty($timeZones)) {
    //             return $timeZones;
    //         } 
    //         else
    //         {
    //             return false;
    //         }
    //     }
    // }
    
    if (!function_exists('timeZoneList')) {
        function timeZoneList($country_id = null)
        {
            $timeZone = TimeZone::where('country_id', $country_id)->get();
            if(!empty($timeZone)) {
                $timeZone = TimeZoneResource::collection($timeZone);
                return  $timeZone;
            }  
            else
            {
                return false;
            }
        
            // $query = TimeZone::where('country_id', $country_id)->get();
    
            // if ($id !== null) {
            //     $timeZone = $query->find($id);
            //     if ($timeZone !== null) {
            //         return $timeZone;
            //     }
            // } else {
            //     $timeZones = $query->get();
            //     if ($timeZones->isNotEmpty()) {
            //         return $timeZones;
            //     }
            // }
    
            // return false;
        }
    }
    
    if (!function_exists('getTimeZoneName')) {
        function getTimeZoneName($timezone_id = null)
        {
            $timeZone = TimeZone::find($timezone_id);
    
            if ($timeZone) {
                return new TimeZoneResource($timeZone);
            } else {
                return false;
            }
        }
    }
    
    if (!function_exists('notificationList')) {
        function notificationList()
        {
            $user = auth()->user();
            if(!empty($user)) {
                
                $notificationSettingArray = explode(",",$user->notification_setting);
                $notifications = Notification::with(['notification_detail' => function ($query) {
                    $query->where('is_hide', 0);
                }])->get();
                
                for($i=0;$i<count($notifications);$i++)
                {
                    foreach($notifications[$i]['notification_detail'] as $key => $notification)
                    {
                        if(in_array($notification['id'],$notificationSettingArray))
                        {
                            $notifications[$i]['notification_detail'][$key]['status'] = 1;
                        }
                        else{
                            $notifications[$i]['notification_detail'][$key]['status'] = 0;    
                        }
                    }
                }
                return $notifications;
            } 
            else
            {
                return false;
            }
        }
    } 
    
    if (!function_exists('eventsList')) {
        function eventsList($request)
        {
            // $type = $request->type;
            $type = $request['type'];
            
            $now = Carbon::now();
            $userId = Auth::user()->id;
            
            $eventsQuery = Event::select('events.*',DB::raw('CASE WHEN event_activities.is_save = 1 THEN 1 ELSE 0 END AS is_save'),
                                                    DB::raw('CASE WHEN event_activities.is_mute = 1 THEN 1 ELSE 0 END AS is_mute'))
                                            ->leftJoin('event_activities', function($join) use ($userId) {
                                            $join->on('events.id', '=', 'event_activities.event_id')
                                            ->where('event_activities.user_id', '=', $userId);
                                            })
                                            ->where('is_save_to_draft', '!=', 1);
            // Filter events based on start and end dates
            if ($type === 'all' || $type === '') {
                $eventsQuery;
            } elseif ($type === 'upcoming') {
                $eventsQuery->where('start_date', '>', $now);
            } elseif ($type === 'past') {
                $eventsQuery->where('end_date', '<', $now);
            }

            // $perPage = $request->query('per_page', 10);
            $eventsQuery->orderBy('start_date', 'asc');
            $events = $eventsQuery->paginate(10);
            
            if(!empty($events)) {
                return $events;
            } else {
                return false;
            }
        } 
    }
        
    if (!function_exists('memberLists')) {
        function memberLists($request)
        {
            $userId = Auth::user()->id;
            $userType = $request['user_type'];
            $per_page = $request['per_page'] ?? 300;

            $query = User::select(
                'users.id', 'users.first_name', 'users.last_name', 'users.user_type', 'users.profile_image', 'users.cover_image',
                DB::raw('CASE WHEN user_activities.is_follow = 1 THEN 1 ELSE 0 END AS is_follow'), 
                DB::raw('CASE WHEN user_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                DB::raw('CASE WHEN user_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member')
            )
                ->leftJoin('user_activities', function($join) use ($userId) {
                    $join->on('users.id', '=', 'user_activities.followers')
                        ->where('user_activities.following', '=', $userId);
                })
                ->where('users.status', 'active')
                // ->where('users.welcome_checklist_complete', 1)
                ->whereNotExists(function ($query) use ($userId) {
                    $query->select(DB::raw(1))
                        ->from('user_activities')
                        ->where(function ($subQuery) use ($userId) {
                            $subQuery->whereColumn('users.id', 'user_activities.block_user_id')
                                ->where('user_activities.blocked_by', $userId);
                        })
                        ->orWhere(function ($subQuery) use ($userId) {
                            $subQuery->whereColumn('users.id', 'user_activities.report_user_id')
                                ->where('user_activities.reported_by', $userId);
                        });
                });

            if ($userType === null || $userType == 'all' || $userType == 'All') {
                $query->orderBy('users.first_name', 'ASC');
            } else if ($userType === 'newest' || $userType == 'Newest') {
                $sevenDaysAgo = Carbon::now()->subDays(7)->toDateTimeString();
                $query->where('users.created_at', '>=', $sevenDaysAgo)
                ->orderBy('users.created_at', 'DESC');
                // $query->where('users.welcome_checklist_complete', 0)
                // ->orderBy('users.id', 'DESC');
            } else if ($userType == 'blocked' || $userType == 'Blocked') {
                $query = User::select(
                    'users.id', 'users.first_name', 'users.last_name', 'users.user_type', 'users.profile_image', 'users.cover_image',
                    DB::raw('CASE WHEN user_activities.is_follow = 1 THEN 1 ELSE 0 END AS is_follow'), 
                    DB::raw('CASE WHEN user_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                    DB::raw('CASE WHEN user_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member')
                )
                    ->join('user_activities', function ($join) use ($userId) {
                        $join->on('users.id', '=', 'user_activities.block_user_id')
                            ->where('user_activities.blocked_by', $userId);
                    })
                    ->orderBy('users.id', 'ASC');
            } else {
                $query->where('users.user_type', $userType)
                ->where('users.welcome_checklist_complete', 1)
                    ->orderBy('users.id', 'ASC');
            }

            $reportedMembers = User::select('users.id')
                ->join('user_activities', 'users.id', '=', 'user_activities.report_user_id')
                ->where('user_activities.is_report_member', '=', 1)
                ->groupBy('users.id')
                ->havingRaw('COUNT(*) >= ?', [3])
                ->pluck('users.id');

            if ($reportedMembers->isNotEmpty()) {
                $query->whereNotIn('users.id', $reportedMembers);
                $query->where('users.id', '!=', $userId);
            }

            
            $perPage = $request->query('per_page', $per_page);
            
            if($perPage)
            {
                $memberLists = $query->paginate($perPage);
            }
                                                         
            if(!empty($memberLists)) {
                return $memberLists;
            } else {
                return false;
            }
        }
    }

    if (!function_exists('memberFollowResponse')) {
        function memberFollowResponse($request)
        {
            $userId = Auth::user()->id;
                $memberLists = User::select('users.id', 'users.first_name', 'users.last_name', 'users.user_type', 'users.profile_image', 'users.cover_image',
                            DB::raw('CASE WHEN user_activities.is_follow = 1 THEN 1 ELSE 0 END AS is_follow'), 
                            DB::raw('CASE WHEN user_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                            DB::raw('CASE WHEN user_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member'))
                    ->leftJoin('user_activities', function($join) use ($userId) {
                        $join->on('users.id', '=', 'user_activities.followers')
                            ->where('user_activities.following', '=', $userId);
                    })->where('users.id',$request)->first();
                    $member = $memberLists->toArray();                                                                      
            if(!empty($member)) {
                return $member;
            }  
            else
            {
                return false;
            }
        }
    }

    if (!function_exists('memberReportResponse')) {
        function memberReportResponse($request)
        {
            $userId = Auth::user()->id;
                $memberLists = User::select('users.id', 'users.first_name', 'users.last_name', 'users.user_type', 'users.profile_image', 'users.cover_image',
                            DB::raw('CASE WHEN user_activities.is_follow = 1 THEN 1 ELSE 0 END AS is_follow'), 
                            DB::raw('CASE WHEN user_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                            DB::raw('CASE WHEN user_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member'))
                    ->leftJoin('user_activities', function($join) use ($userId) {
                        $join->on('users.id', '=', 'user_activities.report_user_id')
                            ->where('user_activities.reported_by', '=', $userId);
                    })->where('users.id',$request)->first();
                    $member = $memberLists->toArray();                                                                      
            if(!empty($member)) {
                return $member;
            }  
            else
            {
                return false;
            }
        }
    }

    if (!function_exists('memberBlockResponse')) {
        function memberBlockResponse($request)
        {
            $userId = Auth::user()->id;
                $memberLists = User::select('users.id', 'users.first_name', 'users.last_name', 'users.user_type', 'users.profile_image', 'users.cover_image',
                            DB::raw('CASE WHEN user_activities.is_follow = 1 THEN 1 ELSE 0 END AS is_follow'), 
                            DB::raw('CASE WHEN user_activities.is_block_member = 1 THEN 1 ELSE 0 END AS is_block_member'),
                            DB::raw('CASE WHEN user_activities.is_report_member = 1 THEN 1 ELSE 0 END AS is_report_member'))
                    ->leftJoin('user_activities', function($join) use ($userId) {
                        $join->on('users.id', '=', 'user_activities.block_user_id')
                            ->where('user_activities.blocked_by', '=', $userId);
                    })->where('users.id',$request)->first();
                    $member = $memberLists->toArray();                                                                      
            if(!empty($member)) {
                return $member;
            }  
            else
            {
                return false;
            }
        }
    }
    
    if (!function_exists('eventResponse')) {
        function eventResponse($eventId)
        {
            $userId = Auth::user()->id;
            $event = Event::select('events.*',
                    DB::raw('CASE WHEN event_activities.is_save = 1 THEN 1 ELSE 0 END AS is_save'),
                    DB::raw('CASE WHEN event_activities.is_mute = 1 THEN 1 ELSE 0 END AS is_mute'),
                    'event_activities.download_rsvps',
                    'event_activities.is_attending',
                    DB::raw('CASE WHEN event_activities.is_calendar = 1 THEN 1 ELSE 0 END AS is_calendar'))
                ->leftJoin('event_activities', function ($join) use ($userId) {
                    $join->on('events.id', '=', 'event_activities.event_id')
                        ->where('event_activities.user_id', '=', $userId);
                })
                ->where('events.id', $eventId)
                ->first();
    
            if ($event) {
                $goingActivities = EventActivity::where('event_id', $event->id)
                    ->where('is_attending', 'going')
                    ->orderBy('id', 'DESC')
                    ->with('user:id,first_name,last_name,user_type,profile_image')
                    ->limit(3)
                    ->get();
                $goingActivities = $goingActivities->pluck('user'); // Keep only the "user" objects
                $eventActivityCount = EventActivity::where('event_id', $event->id)
                    ->where('is_attending', 'going')
                    ->orderBy('id', 'DESC')
                    ->with('user:id,first_name,last_name,user_type,profile_image')
                    ->count();
                    
                // Fetch information for the coach associated with the event
                $coaches = User::whereIn('id', explode(',', $event->coaches))
                ->select('id', 'first_name', 'last_name', 'profile_image')
                ->get();
                $event->coaches = $coaches; // Add coach information to the response
                
                $event->going = $goingActivities;
                $event->total_going = $eventActivityCount;
    
                return $event;
            } else {
                return false;
            }
        }
    }

    if (!function_exists('pushNotification')) {
        function pushNotification($notification_data)
        { 
            $SERVER_API_KEY = env('PUSH_NOTIFICATION_KEY');

            $data = [
                "registration_ids"=> [
                    $notification_data['fcm_token']
                ],
                "notification" => [
                    "title" => $notification_data['title'],
                    "body" => $notification_data['body'],
                    "sound" => "default",
                    "vibrate" => 300,
                    "color" => '#ffde6a',
                    // "icon" => ,  
                ],
                "sound" => "default",
                "priority" => "normal",
                "time_to_live" => 0,
                "data" => [
                    "title" => $notification_data['title'],
                    "body" => $notification_data['body'],
                    "content" => "",
                    "sound" => "default",
                    // "type" => $type,
                    // "action_id" => $action_id,
                    "color" => '#ffde6a',   
                    // "icon" => ,
                    // "notification_date" => $notification_date
                ]
            ];
            $dataString = json_encode($data);
        
            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];
        
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                        
            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
    
        }

    }

    if (!function_exists('get_user_timezone')) {
        function get_user_timezone()
        {
            try {

                if (\Session::has('user_timezone')) {
                    return \Session::get('user_timezone');
                } else {
                    // Get user timezone
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'],
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 10,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                    ));

                    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, env('CURLOPT_SSL_VERIFYHOST', TRUE));
                    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, env('CURLOPT_SSL_VERIFYPEER', TRUE));

                    if (curl_error($curl)) {
                        \Log::error(curl_error($curl));
                        curl_close($curl);
                        return config('app.timezone');
                    }

                    $response = curl_exec($curl);

                    if (!$response) {
                        return config('app.timezone');
                    }

                    curl_close($curl);

                    $data = unserialize($response);
                    if ($data['geoplugin_timezone']) {
                        $timezone = $data['geoplugin_timezone'];
                        \Session::put('user_timezone', $timezone);

                        return $timezone;
                    } else {
                        return config('app.timezone');
                    }
                }
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
                return config('app.timezone');
            }
        }
    }


    if (!function_exists('getSocialIcon')) {
        function getSocialIcon($link)
        {        
            $icons = [
                'facebook.com' => 'fb-icon.png',
                'instagram.com' => 'insta-icon.png',
                'linkedin.com' => 'linkedin-icon.png',
                'youtube.com' => 'youtube-icon.png',
                'twitter.com' => 'twitter-icon.png',
                
                // Add more domain names and their respective icons
            ];

            foreach ($icons as $url => $icon) {
                if (strpos($link, $url) !== false) {
                    return asset("assets/images/$icon");
                }
            }

            return asset('assets/images/default-social-icon.png');
        }
    }

    if (!function_exists('getEventStatus')) {
        function getEventStatus($startDate,$endDate)
        { 
            $startDateTime = Carbon::parse($startDate);
            $endDateTime = Carbon::parse($endDate);
            $totalMinutes = $startDateTime->diffInMinutes($endDateTime);
            
            
            // Check if the duration is less than one hour
            if ($totalMinutes < 60) {
                // Format the duration as "minutes"
                $durationFormatted = "{$totalMinutes} minutes";
            } else {
                // Calculate the duration in hours and minutes
                $durationInHours = floor($totalMinutes / 60); 
                $durationInMinutes = $totalMinutes % 60;      

                // Format the duration as "hours hours minutes minutes"
                $durationFormatted = "{$durationInHours} hours {$durationInMinutes} minutes";
            }

            // Get the current date and time
            $currentDateTime = Carbon::now();

            // Check the status
            if ($currentDateTime < $startDateTime) {
                $eventStatus = 'Upcoming';
            } elseif ($currentDateTime >= $startDateTime && $currentDateTime <= $endDateTime) {
                $eventStatus = 'Ongoing';
            } else {
                $eventStatus = 'Finished';
            }
            return $eventStatus;
        }
    }

    // app/Helpers/DateTimeHelper.php

    if (!function_exists('convertUtcToUserTimezone')) {
        function convertUtcToUserTimezone($utcDate, $timezone)
        {
            // Convert the UTC date to the user's timezone
            $userDate = Carbon::createFromFormat('Y-m-d H:i:s', $utcDate, 'UTC')->setTimezone($timezone);

            // Format the user's date as "15-Aug-2023 15:00"
            return $userDate->format('d-M-Y H:i');
        }
    }

    /* Display Countrywise date format */
    if (!function_exists('getDateTimeFormat')) {
        function getDateTimeFormat($userDate)
        {
            $user = auth()->user();
            if ($user && isset($user->timezone_id) && !empty($user->timezone_id) && $user->timezone_id !== null) {
                $timeZoneInfo = getTimeZoneName($user->timezone_id);

                if ($timeZoneInfo) {
                    $timezone = $timeZoneInfo->timezone ?? "UTC";

                    $date = Carbon::parse($userDate);

                    // Set the timezone for the Carbon instance
                    $date->setTimezone(new DateTimeZone($timezone));

                }
                return $date->format('j-M-Y H:i');
            }
        }
    }

    if (!function_exists('convertToUtc')) {
        function convertToUtc($userDate, $userTimezone)
        {
            $given = Carbon::createFromFormat("Y-m-d H:i:s", $userDate, $userTimezone);
            $given->setTimezone('UTC');
            return $given->format("Y-m-d H:i:s");
        }
    }
    
    if (!function_exists('getUserTimeZone')) {
        function getUserTimeZone()
        {
            $user = auth()->user();
            if ($user && isset($user->timezone_id) && !empty($user->timezone_id) && $user->timezone_id !== null) {
                $timeZoneInfo = getTimeZoneName($user->timezone_id);

                if ($timeZoneInfo) {
                    return $timezone = $timeZoneInfo->timezone ?? "UTC";
                }
            }
        }
    }
    
    /// function create for Zoom to convert usertimezone
    if (!function_exists('convertUtcToUserTimezoneForZoom')) {
        function convertUtcToUserTimezoneForZoom($utcDate, $timezone)
        {
            // Convert the UTC date to the user's timezone
            $userDate = Carbon::createFromFormat('Y-m-d H:i:s', $utcDate, 'UTC')->setTimezone($timezone);
            // Format the user's date as "15-Aug-2023 15:00"
            return $userDate->format('Y-m-d H:i:00');
        }
    }
    
    if (!function_exists('calculateDurationInMinutes')) {
        function calculateDurationInMinutes($startDateTime, $endDateTime)
        {
            try {
                $format = 'd-M-Y H:i';
    
                $start = Carbon::createFromFormat($format, $startDateTime, 'UTC');
                $end = Carbon::createFromFormat($format, $endDateTime, 'UTC');
    
                return $end->diffInMinutes($start);
            } catch (\Exception $e) {
                Log::error('calculateDurationInMinutes : ' . $e->getMessage());
                return 0;
            }
        }
    }
    
    if (!function_exists('getCountryNameById')) {
        function getCountryNameById($id=1)
        {
            $countries = Country::where('id',$id)->first()->country_name;
            if(!empty($countries)) {
                return $countries;
            } 
            else
            {
                return false;
            }
        }
    }
    
    if (!function_exists('coachList')) {
        function coachList()
        {
            $coaches = User::select('id', 'first_name', 'last_name', 'profile_image', 'cover_image', 'user_type')
                            ->where('user_type', 'coach')->get();
            //$message = 'Coach listed successfully.';
            return $coaches;
        }
    }

    if (!function_exists('getDetailsUserwise')) {
        function getDetailsUserwise($interactive_workbook_id,$user_id)
        {
           // $authenticatedUser = Auth::user();

            // if (!$authenticatedUser) {
            //     return response()->json(
            //         [
            //             'status' => 401,
            //             'statusState' => 'error',
            //             'message' => 'User not authenticated.',
            //         ],401
            //     );
            // }
            //$authenticatedUser['id']=$user_id;
            $interactiveDetails = InteractiveDetail::where('user_id', $user_id)
                ->where('interactive_workbook_id', $interactive_workbook_id)
                ->first();
                
            if($interactiveDetails && $interactiveDetails->content!='')
            {
                return $interactiveDetails->content;
            }
            else
            {
                return '';
            }
        }
    }
    
    // app/helpers.php

    if (!function_exists('sessionDurationSelect')) {
        function sessionDurationSelect($name, $selectedValue = null, $attributes = [])
        {
            $options = [
                '30' => '30 Minutes',
                '60' => '60 Minutes',
                '90' => '90 Minutes',
            ];

            $select = '<select name="' . $name . '" class="select2-wrap form-select form-control shadow"';

            foreach ($attributes as $attribute => $value) {
                $select .= ' ' . $attribute . '="' . $value . '"';
            }

            $select .= '>';

            foreach ($options as $value => $label) {
                $selected = ($value == $selectedValue) ? 'selected' : '';
                $select .= '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
            }

            $select .= '</select>';

            return $select;
        }
    }

// app/helpers.php

    if (!function_exists('sessionPriceSelect')) {
        function sessionPriceSelect($name, $selectedValue = null, $attributes = [])
        {
            $options = [
                '500' => '$ 500',
                '1000' => '$ 1000',
                '1500' => '$ 1500',
            ];

            $select = '<select name="' . $name . '" class="select2-wrap form-select form-control shadow"';

            foreach ($attributes as $attribute => $value) {
                $select .= ' ' . $attribute . '="' . $value . '"';
            }

            $select .= '>';

            foreach ($options as $value => $label) {
                $selected = ($value == $selectedValue) ? 'selected' : '';
                $select .= '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
            }

            $select .= '</select>';
            
            return $select;
        }
    }
    
    
    
?>
