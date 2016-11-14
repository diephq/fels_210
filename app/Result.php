<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\DB;

class Result extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'word_id', 'lesson_id', 'answer_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answer()
    {
        return $this->belongsTo('App\Answer', 'answer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo('App\Word', 'word_id');
    }

    /**
     * Create records answer for user
     *
     * @param array $params
     * @internal int $word_id
     * @internal int $lesson_id
     * @internal int $answer_id
     *
     * @return bool|array
     */
    public function createResult($params = [])
    {
        if (empty($params)) {
            return false;
        }

        return Result::insert($params);
    }

    /**
     * Insert answers
     *
     * @param array $words
     * @param $lessonId
     *
     * @return bool
     */
    public function insertAnswers($words = [], $lessonId)
    {
        if (empty($lessonId) || empty($words)) {
            return false;
        }

        // Get results by lessonId
        $results = Result::where('lesson_id', $lessonId)->get();

        $params = [];
        // update results
        foreach ($results as $result) {
            foreach ($words as $key => $item) {
                if ($result->word_id == $key) {
                    $params[] = [
                        'id' => $result->id,
                        'answer_id' => (int) $item
                    ];
                }
            }
        }

        $results = [];
        foreach ($params as $value) {
            $results[] = Result::find($value['id'])->update($value);
        }

        return $results;
    }

    /**
     * Get results by lessonId
     *
     * @param int $lessonId
     *
     * @return array|bool
     */
    public function getResult($lessonId)
    {
        if (empty($lessonId)) {
            return false;
        }

        return Result::where('lesson_id', $lessonId)->with('answer')->get();
    }

    /**
     * Get list answers sheet for user
     *
     * @param $lessonId
     * @return bool|array
     */
    public function getListAnswerSheet($lessonId)
    {
        if (empty($lessonId)) {
            return false;
        }

        return Result::where('lesson_id', $lessonId)
            ->with(['word' => function($query) {
                $query->with('answers');
            }])->get();
    }
}
