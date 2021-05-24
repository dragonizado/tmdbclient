@extends('layouts.app')

@section('content')  
@if (isset($movie['original_title']))    
    <div class="container">
        <div class="row mb-2" style="height: 480px; background-image:url('{{$movie['backdrop_path']}}');background-size: cover; width:100%;">
            <div style="position: relative;background-color: #eeeeee;width: 100%;height: 100%;top: 0px; opacity:.8;"></div>
        </div>
        <div class="row" style="position: relative;margin-top: -435px;width: 100%;">
            <div class="col-md-3">
                <img src="{{$movie['poster_path']}}" class="w-100" alt="{{$movie['original_title']}}">
            </div>
            <div class="col">
                <h2>{{$movie['original_title']}}</h2>
                <p><Strong>overview:</Strong>    {{$movie['overview']}}</p>
                <p><Strong>Votes:</Strong>  {{$movie['vote_count']}}</p>
                <p><Strong>Date:</Strong>  {{$movie['release_date']}}</p>
            </div>
        </div>
    </div>
@else
    <div class="text-center w-100">
        <h2>{{__('404 Not Found')}}</h2>
    </div>
@endif
@endsection