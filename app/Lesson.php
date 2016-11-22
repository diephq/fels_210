<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'user_id', 'name', 'type', 'score', 'status'
    ];

    /**
     * Validate rules
     *
     * @var array
     */
    public $rules = [
        'lesson_type' => 'required|numeric',
        'category_id' => 'required|numeric|exists:categories,id',
        'user_id' => 'required|numeric||exists:users,id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    /**
     * Get lesson detail
     *
     * @param array $params
     * @internal int $category_id
     * @internal int $user_id
     * @internal int $type
     *
     * @return array|bool
     */
    public function getDetail($params = [])
    {
        if (empty($params['category_id']) || empty($params['user_id'])) {
            return false;
        }

        return Lesson::where('category_id', $params['category_id'])
            ->where('user_id', $params['user_id'])
            ->paginate(config('constants.PAGINATE_COMMON'));
    }

    /**
     * Update score
     *
     * @param array $params
     * @internal int $id
     * @internal int $score
     *
     * @return bool|array
     */
    public function updateScore($params = [])
    {
        if (empty($params || empty($params['id']))) {
            return false;
        }

        return Lesson::find($params['id'])->update($params);
    }
}
