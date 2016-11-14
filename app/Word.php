<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
