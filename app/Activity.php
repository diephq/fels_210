<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'target_id', 'target_type', 'action_type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Lesson', 'target_id');
    }

    public function relationship()
    {
        return $this->belongsTo('App\Relationship', 'user_id', 'target_id');
    }

    /**
     * @param $userId
     * @return bool
     */
    public function getActivities($userId)
    {
        if (empty($userId)) {
            return false;
        }

        return $this->with('user')
            ->with(['lesson' => function($query) {
                $query->with('category');
            }])
            ->whereHas('relationship', function($query) use($userId) {
                $query->where('user_id', $userId);
            })
            ->paginate(config('constants.PAGINATE_USER'));
    }

}
