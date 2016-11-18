<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWord extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_words';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'word_id', 'deleted_ad'
    ];

    /**
     * Create learned words
     *
     * @param array $params
     * @internal int $user_id
     * @internal int $word_id
     * @return bool
     */
    public function createLearnedWords($params = [])
    {
        if (empty($params)) {
            return false;
        }

        foreach ($params as $item) {
            $result = UserWord::where(['user_id' => $item['user_id'], 'word_id' => $item['word_id']])->first();

            if (empty($result)) {
                UserWord::create([
                    'user_id' => $item['user_id'],
                    'word_id' => $item['word_id']
                ]);
            }
        }

        return true;
    }
}
