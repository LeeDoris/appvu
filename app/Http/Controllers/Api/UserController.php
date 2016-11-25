<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Hash;
use App\User;
use Hashids;
use App\Transformers\AdminTransformer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends ApiController
{
    public function __construct(Request $request)
    {
//        $this->user = User::where('role_level', '=', 9)->get();
        $this->middleware('authorized:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('role_level', '=', 1)->get();
        return $this->respondWith($user, new AdminTransformer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,User $user)
    {
        $user->fill($request->all());
        $user->slug = null;
        $user->save();

        return $this->respondWith($user, new AdminTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->created_at = hash('adler32', time());
        $user->save();
        return $this->respondWith($user, new AdminTransformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($hashid)
    {
        $id = Hashids::decode($hashid);
        $user = User::find($id);
        return $this->respondWith($user, new AdminTransformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($hashid)
    {
        $id = Hashids::decode($hashid);
        $user = User::find($id);
        return $this->respondWith($user, new AdminTransformer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$hashid)
    {
        $user = User::find($hashid);

        if($request->has('password') && Hash::check($request->get('password'), $user->password)){
            $this->validate($request, [
                'email' => 'email|max:255|unique:users,email,'.$user->hashid,
                'username' => 'max:50|unique:users,username,'.$user->hashid,
                'name' => 'max:255',
                'new_password' => 'min:6|confirmed'
            ]);

            $user->fill($request->all());

            if($request->get('new_password')){
                $user->password = bcrypt($request->get('new_password'));
            }

            $user->save();

            return $this->respondWith($user, new AdminTransformer);
        } else {
            return $this->errorWrongArgs("No Admin.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->respondWithArray([
            'success' => true,
            'message' => 'Successfully deleted admin.'
        ]);
    }

}
