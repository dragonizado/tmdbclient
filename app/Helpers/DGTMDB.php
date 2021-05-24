<?php 
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class DGTMDB{
    private $host;
    private $url;
    private $key;
    private $body;
    private $whereoptions;
    public function __construct(){
        $this->url = "";
        $this->whereoptions = "";
        $this->key = env("TMDB_API_KEY");
    }

    public function where($cond){
        $this->validateQueryOptions();
        $this->whereoptions .= $cond."/";
        $this->url .= $cond;
        return $this;
    }

    public function fetch($res){
        $this->url = env("TMDB_API_DOMAIN").$res;
        return $this;
    }

    public function get(){
        $this->validateQueryOptions();
        $this->url .= "api_key={$this->key}";
        return Http::get($this->url)->json();
    }

    public function getStringUrl(){
        return $this->url;
    }

    private function validateQueryOptions(){
        if(empty($this->whereoptions)){
           $this->url .= "?";
        }else{
            $this->url .= "&";
        }
    }
}




?>