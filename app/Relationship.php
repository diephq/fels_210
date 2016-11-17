<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'target_id', 'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function following()
    {
        return $this->belongsTo('App\User', 'target_id');
    }

    /**
     * Get relationship
     *
     * @param array $params
     * @internal int $user_id
     * @internal int $target_id
     * @return bool|array
     */
    public function getRelationship($params = [])
    {
        if (empty($params)) {
            return false;
        }

        return Relationship::where('user_id', $params['user_id'])
            ->where('target_id', $params['target_id'])
            ->first();
    }

    /**
     * Get list users following
     *
     * @param $userId
     * @return bool|array
     */
    public function getListUserFollowing($userId)
    {
        if (empty($userId)) {
            return false;
        }

        return Relationship::with('following')
            ->where('user_id', $userId)
            ->paginate(config('constants.PAGINATE_USER'));
    }

}
