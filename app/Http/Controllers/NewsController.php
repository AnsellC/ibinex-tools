<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\User;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
        return view('news.index')->with('newsitems', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit')->with('news', $news);
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
    
        $news = News::findOrFail($id);

        $news->title        = $request->title;
        $news->lead         = $request->lead;
        $news->content      = $request->content;
        $news->is_finished  = $request->is_finished == 1 ? true : false;

        

        if( $request->hasFile('photo') && $request->file('photo')->isValid() ) {
            
            //store the photo then save again
            $path = $request->file('photo')->store('media');
            $news->photo = $path;

        }
        $news->save();

        return redirect('/')->withMsg('News item saved.');
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


    public function assign()
    {
        $users = User::all();
        return view('news.assign')->with('users', $users);
    }

    public function storeAssign()
    {
        $user = User::findOrFail(request('user_id'));

        request()->validate([

            'URL'   => 'required|url|unique:news',
            'user_id'   => 'required|exists:users,id'

        ]);

        $news = new News;
        $news->url = request('url');
        $news->user_id = request('user_id');
        $news->save();

        return redirect('/news')->withMsg('News source added to tracker.');

    }


    public function finish($id)
    {
        $news = News::findOrFail($id);
        $news->is_finished = true;
        $news->save();

        return redirect()->back()->withMsg('Article marked as finished.');

    }

    
    public function publish($id)
    {
        $news = News::findOrFail($id);
        $news->is_published = true;
        $news->save();

        return redirect()->back()->withMsg('Article marked as published on news.ibinex.com.');

    }


    public function seo($id)
    {
        $news = News::findOrFail($id);
        $news->is_seo_published = true;
        $news->save();

        return redirect()->back()->withMsg('Article marked as submitted to social media.');

    }
}
