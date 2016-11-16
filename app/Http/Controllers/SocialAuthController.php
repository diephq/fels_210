<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;

class SocialAuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $providerUser = Socialite::driver('facebook')->user();

        // register user
        $user = $this->__createOrGetUser($providerUser);

        if (empty($user)) {
            return redirect('/login');
        }

        auth()->login($user);
        return redirect('user/' . $user->id);
    }

    /**
     * Create or get user
     *
     * @param $providerUser
     *
     * @return bool|array
     */
    private function __createOrGetUser($providerUser)
    {
        if (empty($providerUser)) {
            return false;
        }

        // check user in database
        $user = $this->user->where('facebook_id', $providerUser->getId())->first();

        if (!empty($user)) {
            return $user;
        }

        // insert user to db
        $user = $this->user->create([
            'name' => $providerUser->getName(),
            'email' => $providerUser->getEmail(),
            'facebook_id' => $providerUser->getId(),
            'avatar' => $providerUser->getAvatar(),
            'role' => config('constants.USER_ROLE')
        ]);

        return $user;
    }
}
