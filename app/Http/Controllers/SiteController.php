<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{   
    public function index(){
        $tmdbApi = new DGTMDB();
        $fullMovies = $tmdbApi->fetch("movie/popular")->get();
        return view("movies.index",compact("fullMovies"));
    }
}


class DGTMDB{
    private $host;
    private $url;
    private $key;
    private $body;
    public function __construct(){
        $this->url = "";
        $this->key = env("TMDB_API_KEY");
    }

    public function fetch($res){
        $this->url = env("TMDB_API_DOMAIN").$res;
        return $this;
    }

    public function get(){
        $this->url .= "?api_key={$this->key}";
        return Http::get($this->url)->json();
    }
}