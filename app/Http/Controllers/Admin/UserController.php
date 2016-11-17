<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Session;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = $this->user->paginate(config('constants.PAGINATE_ADMIN'));

        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->user->rules);

        $requestData = $request->all();
        
        $user = $this->user->create($requestData);

        if (empty($user)) {
            return redirect('admin/user')
                ->withErrors(['error' => trans('message.create_user_error')]);
        }

        return redirect('admin/user')
            ->with(['alert-success' => trans('message.create_user_success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->user->findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, $this->user->rules);

        $requestData = $request->all();

        $user = $this->user->findOrFail($id);

        $result = $user->update($requestData);

        if (empty($result)) {
            return redirect('admin/user')
                ->withErrors(['error' => trans('message.user_update_error')]);
        }

        return redirect('admin/user')
            ->with(['alert-success' => trans('message.user_update_success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);

        $user->delete();

        return redirect('admin/user')
            ->with(['alert-success' => trans('message.user_delete_success')]);

    }
}
