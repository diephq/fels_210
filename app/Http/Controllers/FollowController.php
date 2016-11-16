<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Relationship;

class FollowController extends Controller
{
    protected $user;
    protected $relationship;

    public function __construct(User $user, Relationship $relationship)
    {
        $this->user = $user;
        $this->relationship = $relationship;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $users = $this->user->getList($user->id);

        return view('follow.index', compact('users'));
    }

    /**
     * @param Request $request
     * @internal int $target_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(Request $request)
    {
        if ($request->ajax()) {
            $targetId = $request->get('target_id');

            $user = Auth::user();

            // check is exist relationship
            $relationship = $this->relationship->getRelationship([
                'user_id' => $user->id,
                'target_id' => $targetId
            ]);

            // remove relationship
            if (!empty($relationship)) {
                $relationship->delete();
                return response()->json(config('constants.UN_FOLLOW'));
            }

            // create relationship
            $this->relationship->create([
                'user_id' => $user->id,
                'target_id' => $targetId
            ]);

            return response()->json(config('constants.FOLLOWING'));
        }
    }


    public function listUserFollowing()
    {
        $user = Auth::user();

        $users = $this->relationship->getListUserFollowing($user->id);

        return view('follow.following', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
