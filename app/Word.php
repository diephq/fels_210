<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Answer;

class Word extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'text'
    ];

    /**
     * Get the answers for the word.
     */
    public function answers()
    {
        return $this->hasMany('App\Answer', 'word_id', 'id');
    }

    /**
     * Get category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get results
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany('App\Result');
    }

    /**
     * Get list words random
     *
     * @param array $params
     * @internal param int $categoryId
     * @internal param int $numberWord
     *
     * @return mixed
     */
    public function getListWordByCategoryId($params = [])
    {
        if (empty($params['category_id']) || empty($params['type'])) {
            return false;
        }

        return Word::where('category_id', $params['category_id'])
            ->with('answers')
            ->get()->random($params['type']);
    }

    /**
     * Search list words
     *
     * @param array $params
     * @return mixed
     */
    public function getWords($params = [])
    {
        $user_id = $params['user_id'];

        $words = Word::with('category')
            ->with(['results' => function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            }]);

        if (!empty($params['category_id'])) {
            $words->where('words.category_id', $params['category_id']);
        }

        return $words->groupBy('words.id')
            ->paginate(config('constants.PAGINATE_USER'));
    }

    public function getListWordAdmin()
    {
        return Word::with('category')->paginate(config('constants.PAGINATE_ADMIN'));
    }
}
