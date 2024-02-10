<?php

namespace App\Models;

use App\Models\PostActivity;
use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    use PimpableTrait;
    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'content',
        'post_type',
        // 'poll_id',
        'schedule_type',
        'schedule_datetime',
        'poll_expiration',
        'timezone_id',
        'status',
        'is_featured',
        'posted_by',
        'created_at'
    ];
    protected $searchable = ['search_txt', 'content', 'first_name', 'last_name'];
    
    protected $hidden = [
        'updated_at'
    ];

    protected $casts = [
        'is_featured' => 'integer',
    ];

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getValue() == '') {
            return true;
        }
        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('content', "LIKE", "%" . $constraint->getValue() . "%");
            })
            ->orWhereHas('user', function($query) use ($constraint) {
                $query->where('first_name', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('last_name', "LIKE", "%" . $constraint->getValue() . "%");
            });

            return true;
        }
        // default logic should be executed otherwise
        return false;
    }
    
    public function toArray()
    {
        $array = parent::toArray();

        // Modify the `created_at` timestamp to hours ago
        $array['created_at'] = Carbon::parse($this->attributes['created_at'])
                                    ->diffForHumans();

        return $array;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'first_name', 'last_name', 'email', 'profile_image', 'cover_image', 'location_id', 'step_verification', 'user_type', 'fcm_token', 'notification_setting');
    }

    public function location()
    {
        return $this->belongsTo(Country::class, 'location_id');
    }

    public function postComments()
    {
        return $this->morphMany('App\Models\PostComment', 'postcommentable')->whereNull('parent_id')->orderBy('id', 'DESC');
    }

    public function postActivities()
    {
        return $this->hasMany(PostActivity::class, 'post_id');
    }

    public function timezone()
    {
        return $this->belongsTo(TimeZone::class, 'timezone_id');
    }

    public function pollOptions()
    {
        return $this->hasMany(PollOption::class, 'post_id');
    }
    
}
