<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
 

use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Article;
use Carbon\Carbon;
use App\User;
use Auth;
 

class ArticlesController extends Controller
{
    //
    public function index($value='')
    {
    	 
       //return  \Auth::user();
        
        $articles = Article::latest()->get();
    	
    	return view('articles.index' , compact('articles'));
    }

    public function show($id='')
    {
    	# code...
    	$article = Article::find($id);

    	
    	//return dd($article->published_at);
    	return view('articles.show' , compact('article'));
    }

    public function create($value='')
    {
    	# code...
        if(Auth::guest())
        {

            return redirect('articles');

        }
    	return view('articles.create');
    }

    public function store(ArticleRequest $request)
    {
    	  ///Carbon::now();

        $article = new Article($request->all());

       
        \Auth::user()->articles()->save($article);

    	//Article::create($request->all());

    	return redirect('articles');
    }

    public function edit($id='')
    {
    	# code...
    	$article = Article::find($id);

    	return view('articles.edit',compact('article'));
    }

    public function update($id='' , ArticleRequest $request)
    {
    	# code...
    	$article = Article::find($id);

    	
        
    	$article->update($request->all());
        return redirect('articles');
    }

   
}
