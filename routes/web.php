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

Route::get('/', function() {

    return redirect('/news');
    
});

Route::get('/login', function () {

    return view('login');

})->name('login')->middleware('guest');

Route::get('/logout', function() {

    Auth::logout();
    return redirect('/');

})->middleware('auth');

Route::post('/login', function() {

    request()->validate([
        'email' => 'required|email',
        'password'  => 'required'
    ]);

    $credentials = request()->only('email', 'password');

    if (Auth::attempt($credentials)) {

        return redirect()->intended('/news');
    }    

    return back()->withErrors(['message' => 'Invalid username/password.']);
    
});

Route::middleware(['auth'])->group(function() {


    Route::get('/news/assign', [
        'as'    => 'news.assign',
        'uses'  => 'NewsController@assign'
    ])->middleware('can:admin');

    Route::post('/news/assign', [
        'as'    => 'news.assign-save',
        'uses'  => 'NewsController@storeAssign'
    ])->middleware('can:admin');

    Route::get('/news/{id}/finished', [
        'as'    => 'news.finished',
        'uses'  => 'NewsController@finish'
    ])->middleware('can:admin');

    Route::get('/news/{id}/published', [
        'as'    => 'news.published',
        'uses'  => 'NewsController@publish'
    ])->middleware('can:admin_or_seo');

    Route::get('/news/{id}/seo', [
        'as'    => 'news.seo',
        'uses'  => 'NewsController@seo'
    ])->middleware('can:admin_or_seo');
 
        
    Route::resources([
        'news'  => 'NewsController'
    ]);

    

});
