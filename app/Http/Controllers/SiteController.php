<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{   
    public function index(){
        $api = new TMDB();
        $fullMovies = $api->fetch("https://api.themoviedb.org/3/movie/popular")->get();
        return view("movies.index",compact("fullMovies"));
    }
}


class TMDB{
    private $host;
    private $url;
    private $key;
    private $body;
    public function __construct(){
        $this->url = "";
        $this->key = env("TMDB_API_KEY");
    }

    public function fetch($res){
        $this->url = "$res";
        return $this;
    }

    public function get(){
        $this->url .= "?api_key={$this->key}";
        return Http::get($this->url)->json();
    }
}