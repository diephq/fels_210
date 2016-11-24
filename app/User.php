<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'facebook_id', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Validate rules login
     */
    public $rules_login = [
        'email' => 'required|email|max:255',
        'password' => 'required|min:6'
    ];

    /**
     * The validation rules
     *
     * @var array
     */
    public $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'avatar' => ['mimes:jpg,jpeg,JPEG,png,gif', 'max:2024'],
        'password' => 'required|min:6|max:30|confirmed',
        'password_confirmation' => 'required'
    ];

    /**
     * Check is admin
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->role == config('constants.ADMIN_ROLE');
    }

    public function following()
    {
        return $this->hasMany('App\Relationship', 'target_id');
    }

    /**
     * Update user
     *
     * @param array $params
     * @internal int $id
     * @internal string $name
     * @internal string $email
     * @internal string $password
     *
     * @return bool
     */
    public function updateProfile($params = [])
    {
        if (empty($params) || empty($params['id'])) {
            return false;
        }

        $user =  User::find($params['id']);

        if (empty($user)) {
            return false;
        }

        return $user->update($params);
    }

    /**
     * Set the user's password.
     *
     * @param  string  $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getAvatarAttribute($value)
    {
        if (empty($value)) {
            return config('path.to_avatar_default');
        }

        return $value;
    }

    /**
     * Get list user following
     *
     * @param $userId
     * @return bool|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($userId)
    {
        if (empty($userId)) {
            return false;
        }

        return User::where('id', '!=', $userId)
            ->where('role', '!=', config('constants.ADMIN_ROLE'))
            ->where('id', '!=', $userId)
            ->with(['following' => function($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->paginate(config('constants.PAGINATE_USER'));
    }
}
