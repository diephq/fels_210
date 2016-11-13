<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use App\User;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get login
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('admin/auth/login');
    }

    /**
     * Post login
     *
     * @param Request $request
     * @internal string $email
     * @internal string $password
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, $this->user->rules_login);

        $user = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (Auth::attempt($user)) {
            return view('admin/layouts/master');
        }

        // authentication failure! lets go back to the login page
        return \Redirect::route('admin_login')
            ->withErrors(['error' => trans('message.admin_user.login_error')]);
    }

}
