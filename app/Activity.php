<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
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

    public function getActivities($user_id)
    {
        if (empty($user_id)) {
            return false;
        }

        return DB::table('activities')
            ->join('users', 'activities.user_id', '=', 'users.id')
            ->join('lessons', 'activities.target_id', '=', 'lessons.id')
            ->join('categories', 'lessons.category_id', '=', 'categories.id')
            ->join('relationships', 'activities.user_id', '=', 'relationships.target_id')
            ->where('relationships.user_id', $user_id)
            ->select('activities.id', 'users.id as user_id', 'users.name as user_name', 'users.avatar', 'lessons.type',
                'lessons.name as lesson_name', 'lessons.score', 'lessons.created_at', 'categories.name as category_name')
            ->groupBy('activities.id')
            ->paginate(config('constants.PAGINATE_USER'));
    }

}
