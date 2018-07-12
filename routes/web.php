<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', function () {

    return view('login');

})->name('login')->middleware('guest');

Route::post('/login', function(){

    request()->validate([
        'email' => 'required|email',
        'password'  => 'required'
    ]);

    $credentials = request()->only('email', 'password');

    if (Auth::attempt($credentials)) {

        return redirect()->intended('dashboard');
    }    

    return back()->withErrors(['message' => 'Invalid username/password.']);
    
});

Route::middleware(['auth'])->group(function() {

    //homepage
    Route::get('/', function () {

        return view('dashboard');
    
    });
    

});
