<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = $this->user->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        return view('user/detail', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = $this->user->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'avatar' => ['mimes:jpg,jpeg,JPEG,png,gif', 'max:2024'],
            'password' => 'required|min:6|max:30|confirmed',
            'password_confirmation' => 'required'
        ]);

        $params = [
            'id' => $user->id,
            'name' => $user->name = $request->get('name'),
            'email' => $request->get('email'),
            'password' => $user->password = $request->get('password')
        ];

        if (!empty($request->file('avatar'))) {
            $avatarName = time() . $request->file('avatar')->getClientOriginalName();
            $path = public_path() . config('path.to_avatar');
            $request->file('avatar')->move($path, $avatarName);
            $params['avatar'] = config('path.to_avatar') . $avatarName;
        }

        // update user
        $user = $this->user->updateProfile($params);

        if (empty($user)) {
            return redirect(action('UsersController@show', ['id' => $id]))
                ->withErrors(['message' => trans('message.user_update_error')])
                ->withInput();
        }

        return redirect()->back()
            ->with(['alert-success' => trans('message.user_update_success')]);
    }

}
