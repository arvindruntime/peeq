<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\PostActivity;
use Laravel\Sanctum\HasApiTokens;
use Jedrzej\Searchable\Constraint;
use Jedrzej\Pimpable\PimpableTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use PimpableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile_no',
        'status',
        'type',
        'google_id',
        'facebook_id',
        'linkedin_id',
        'apple_id',
        'profile_image',
        'cover_image',
        'fcm_token',
        'is_terms_and_condition',
        'is_agree_to_activity_email',
        'is_agree_to_commercial_email',
        'is_profile_image_skipped',
        'is_plan_activated',
        'referral_code',
        'job_title',
        'company_name',
        'bio',
        'leadership_development',
        'self_development',
        'culture_uplift',
        'networking',
        'personal_link',
        'location',
        'timezone',
        'device_type',
        'first_time_login',
        'is_admin',
        'user_type',
        'general',
        'course',
        'find_resource',
        'step_verification',
        'notification_setting',
        'is_online',
        'is_follow',
        'updated_at',
        'welcome_checklist_complete'
    ];

    protected $searchable = ['search_txt', 'first_name', 'last_name', 'user_type'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'email_verified_at',
        'password',
        'remember_token',
        'created_at', 
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($course) {
            $course->deleted_by = Auth::user()->id;
            $course->save();
        });

    }
    
    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getValue() == '') {
            return true;
        }
        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('first_name', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('last_name', "LIKE", "%" . $constraint->getValue() . "%");
            });
            return true;
        }
        // default logic should be executed otherwise
        return false;
    }

    public function validateForPassportPasswordGrant($password)
    {
        return true;
    }
    protected $appends = [
        'profile_image_url',
        'cover_image_url'
    ];

    public function getProfileImageUrlAttribute()
    {
        
        if ($this->profile_image) { 
            return asset('storage/profile/' . $this->profile_image);
        }
        else{
            return asset('assets/images/user-profile-default.png');
        }
    }

    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('storage/coverImage/' . $this->cover_image);
        }
        else{
            return asset('assets/images/cover-photo.jpg');
        }
    }

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }

    public function post_detail()
    {
        return $this->belongsTo(PostActivity::class);
    }

    public function location()
    {
        return $this->belongsTo(Country::class);
    }

    public function timezone()
    {
        return $this->belongsTo(TimeZone::class);
    }

    public function blocks()
    {
        return $this->hasMany(UserActivity::class, 'block_user_id');
    }

    public function blockedBy()
    {
        return $this->hasMany(UserActivity::class, 'blocked_by');
    }

    public function reports()
    {
        return $this->hasMany(UserActivity::class, 'report_user_id');
    }

    public function reportedBy()
    {
        return $this->hasMany(UserActivity::class, 'reported_by');
    }

    public function purchasePlan()
    {
        return $this->hasOne(PlanTransaction::class);
    }

    public function purchaseCourse()
    {
        return $this->hasMany(PlanTransaction::class);
    }

    public function purchaseSession()
    {
        return $this->hasMany(PlanTransaction::class);
    }

    public function userActivity()
    {
        return $this->hasOne(UserActivity::class);
    }
    
    public function userCoachActivity()
    {
        return $this->hasOne(UserActivity::class, 'followers');
    }
    
    public function chatMsg()
    {
        return $this->hasMany(ChatMsg::class, 'from');
    }

    public function planTransactions()
    {
        return $this->hasMany(PlanTransaction::class, 'user_id', 'id');
    }
}
