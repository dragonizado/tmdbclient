<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use App\Models\Movie;
use App\Helpers\DGTMDB;

class SiteController extends Controller
{   
    public function index(){
        $tmdb_api = new DGTMDB();
        $full_movies = $tmdb_api->fetch("movie/popular")->get();
        $user_movies = [];
        $other_user_movies = [];

        if(Auth::check()){
            $user_movies = Movie::where("user_id",Auth::user()->id)->get();
            $other_user_movies = Movie::where("user_id","!=",Auth::user()->id)->get();
        }
        return view("movies.index",compact("full_movies","user_movies","other_user_movies"));
    }

    public function show($id,$local){
        $movie = null;
        if($local == "false"){
            $tmdb_api = new DGTMDB();
            $movie = $tmdb_api->fetch("/movie/{$id}")->get();
            $movie['poster_path'] = "https://image.tmdb.org/t/p/w500".$movie['poster_path'];
            $movie['backdrop_path'] = "https://image.tmdb.org/t/p/w500".$movie['backdrop_path'];
        }else{
            $movie = Movie::where("id",$id)->first();
        }
        return view("movies.show",compact("movie"));
    }

    public function find(Request $request){
        if(count($request->all()) < 1){
            return redirect()->route('site.index');
        }
        $tmdb_api = new DGTMDB();
        $movies = null;
        $user_movies = null;
        $other_params = [];
        $name=null;
        if($request->has("name")){
            $name=$request->input("name");
            $movies = $tmdb_api->fetch('search/movie')->where("query=$name")->get();
        }

        if(Auth::check()){
            $query_model = Movie::query();
            if($request->has("name")){
                $query_model->where("original_title","ILIKE","%{$name}%");
            }
            if($request->has('description')){
                $description = $request->input("description");
                $other_params['description'] = $description;
                $query_model->where("overview","ILIKE","%{$description}%");
            }

            if($request->has('start_date') && 
                !empty($request->input('start_date')) &&
                $request->has('end_date') && 
                !empty($request->input('end_date'))
            ){
                $query_model->where("release_date",">=",$request->input('start_date'));
                $query_model->where("release_date","<=",$request->input('end_date'));
            }
            $user_movies = $query_model->get();
           
        }

        return view("movies.search",compact("movies","name","user_movies","other_params"));
    }

    public function store(Request $request){
        $this->middleware('auth');
        $model = new Movie();
        $model->original_title = $request->input("title");
        $model->overview = $request->input("overview");
        $model->vote_count = 0;
        $file = $request->file('image');
        $backdrop = $request->file('backdrop');
        $destinationPath = 'uploads';
        $fileexten = $file->getClientOriginalExtension();
        $filecexten = $backdrop->getClientOriginalExtension();
        $newFName = date("dmyhis").Str::random(6).".".$fileexten;
        $newFCName = date("dmyhis").Str::random(6).".".$filecexten;
        $file->move($destinationPath,$newFName);
        $backdrop->move($destinationPath,$newFCName);

        $model->poster_path = url("uploads/$newFName");
        $model->backdrop_path = url("uploads/$newFCName");
        $model->release_date = $request->input("date");
        $model->user_id = Auth::user()->id;
        if($model->save()){
            return response()->json(["ok"]);
        }else{
            return response()->json(["Error al guardar los datos"], 401);
        }
    }

    public function create(){
        return view("movies.create");
    }
}