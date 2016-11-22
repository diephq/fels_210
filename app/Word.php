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

    public $rules = [
        'category_id' => 'required|numeric|exists:categories,id',
        'text' => 'required|max:255',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_words()
    {
        return $this->hasMany('App\UserWord');
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
        $userId = $params['user_id'];

        // Get words id learned
        $learnedIds = $this->__getWordLearned($userId);

        $words = Word::with('category')
            ->with('user_words');

        if (!empty($params['category_id'])) {
            $words->where('words.category_id', $params['category_id']);
        }

        if ($params['learned'] == config('constants.LESSON_TESTED')) {
            $words->whereIn('id', $learnedIds);
        }

        if ($params['learned'] == config('constants.LESSON_UN_TESTED')) {
            $words->whereNotIn('id', $learnedIds);
        }

        return $words->groupBy('words.id')
            ->paginate(config('constants.PAGINATE_USER'));
    }

    private function __getWordLearned($userId)
    {
        $words = UserWord::where('user_id', $userId)->groupBy('word_id')->get();

        if (empty($words)) {
            return [];
        }

        $wordIds = [];
        foreach ($words as $word) {
            $wordIds [] = $word->word_id;
        }

        return $wordIds;
    }

    public function getListWordAdmin()
    {
        return Word::with('category')->paginate(config('constants.PAGINATE_ADMIN'));
    }

    public function getWordDetail($id)
    {
        return Word::with('category')->with('answers')->find($id);
    }
}
