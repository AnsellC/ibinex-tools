<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //has to be here if using resource
        $this->middleware('can:admin');
    }
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'email'     => 'required|email',
            'name'      => 'required',
            'role'      => 'required|in:writer,seo,admin'
        ]);

        $user = new User;
        
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role = $request->role;
        $temp_password = str_random(8);
        $user->password = $temp_password;
        $user->save();

        return view('users.account-created')->with([
            'user'          => $user,
            'temp_password' => $temp_password,
        ]);
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
        $user = User::findOrFail($id);
        return view('users.edit')->with('user', $user);
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
        $user = User::findOrFail($id);

        request()->validate([
            'email'     => 'required|email',
            'name'      => 'required',
            'role'      => 'required|in:writer,seo,admin'
        ]);

        if( isset($request->password) ) {

            request()->validate([
                'password'     => 'required|confirmed',
            ]);
            
            
        }

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->role     = $request->role;

        if( isset($request->password) ) {

            $user->password = bcrypt($request->password);

        }

        $user->save();

        return redirect('/users')->withMsg('User info saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if( $user->id == env('SUPER_ADMIN') )

            return redirect('/users')->withMsg('Cannot delete super user.');

        $user->delete();
        // set all news posted by this user to 0
        $user->news()-update(['user_id' => 0]);
        return redirect('/users')->withMsg('User deleted.');
    }
}
