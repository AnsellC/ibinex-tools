<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\User;
use Carbon\Carbon;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->role == 'writer') {
            //my news query
            if( request('mine_show') !== null AND request('mine_show') == "all" ) {

                $mine =  News::where('user_id', \Auth::user()->id)->orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
                $mine_title = "Assigned to me: all";
            }

            elseif( request('mine_show') !== null AND request('mine_show') == "unfinished" ) {

                $mine = News::where([
                    'user_id' => \Auth::user()->id,
                    'is_finished' => 0
                ])->orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));

                $mine_title = "Assigned to me: all unfinished";
            }
            else {

                $mine = News::where('user_id', \Auth::user()->id)->whereDate('created_at', Carbon::today())->orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
                $mine_title = "Assigned to me: Today";
            }

        }
        elseif(\Auth::user()->role == 'seo') {

            //my news query
            if( request('mine_show') !== null AND request('mine_show') == "all" ) {

                $mine =  News::where([
                    'is_finished'  => 1,
                    'is_published' => 0
                ])
                ->orWhere([
                    'is_finished'      => 1,
                    'is_seo_published' => 0,
                                     
                ])->orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
                $mine_title = "Assigned to me: all";
            }

            elseif( request('mine_show') !== null AND request('mine_show') == "unfinished" ) {

                $mine = News::where([
                    'is_finished'  => 1,
                    'is_published' => 0
                ])
                ->orWhere([
                    'is_finished'      => 1,
                    'is_seo_published' => 0,
                ])
                ->orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));

                $mine_title = "Assigned to me: all unfinished";
            }
            else {

                $mine = News::where('is_finished', 1)->whereDate('created_at', Carbon::today())->orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
                $mine_title = "Assigned to me: Today";
            }

        }

        // all news query
        if( request('show') !== null AND request('show') == "all" ) {
            $news = News::orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
            $all_title = "All News Items";
        }
        //show all unfinished
        elseif( request('show') !== null AND request('show') == "unfinished" ) {

            $news = News::where([
                'is_finished' => 0
            ])->orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
            $all_title = "All Unfinished";
        }
        //show all unpublished
        elseif( request('show') !== null AND request('show') == "unpublished" ) {

            $news = News::where([
                'is_published' => 0
            ])->orderBy('id', 'DESC')->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
            $all_title = "All Unpublished";

        }
        //show unfinished today
        elseif( request('show') !== null AND request('show') == "unfinished_today" ) {

            $news = News::where([
                'is_finished' => 0
            ])->orderBy('id', 'DESC')->whereDate('created_at', Carbon::today())->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
            $all_title = "All Unfinished Today";
        }
        //show unpublished today
        elseif( request('show') !== null AND request('show') == "unpublished_today" ) {

            $news = News::where([
                'is_published' => 0
            ])->orderBy('id', 'DESC')->whereDate('created_at', Carbon::today())->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
            $all_title = "All Unpublished Today";
        }
        else {
            $news = News::orderBy('id', 'DESC')->whereDate('created_at', Carbon::today())->paginate(env('TABLE_ITEMS_PER_PAGE', 20));
            $all_title = "All News Items Today";
        }
            
 
 
        if(\Auth::user()->role == 'admin') {

            $mine_title = '';
            $mine = [];
        }
             
        return view('news.index')->with('newsitems', $news)->with('mine', $mine)->with('mine_title', $mine_title)->with('all_title', $all_title);
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
        if( ($news->user_id != \Auth::user()->id) AND !\Auth::user()->role == 'admin' )
            return abort(405);

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
        if( ($news->user_id != \Auth::user()->id) AND !\Auth::user()->role == 'admin' )
            return abort(405);

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
        $news = News::findOrFail($id);
        $news->delete();
        return redirect()->back()->withMsg('News item deleted.');
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

            'url'   => 'required|url|unique:news',
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
