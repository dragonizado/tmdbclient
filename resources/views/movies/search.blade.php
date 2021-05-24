@extends('layouts.app')

@section('content')
    @auth
<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-2">
        <advance-search-component></advance-search-component>
    </div>
    <div class="col">
        
            <h3>Result of local movies</h3>
            <show-movies-component>
                @forelse ($user_movies as $movie)
                <movie-front-component local="true" id="{{$movie['id']}}" img="{{$movie['poster_path']}}" title="{{$movie['original_title']}}" date="{{$movie['release_date']}}"></movie-front-component>
                @empty
                <div class="text-center w-100">
                    <p>{{__('No results')}}</p>
                </div>
                @endforelse
            </show-movies-component>
        </div>
    </div>
    <hr>
    @endauth
<h3>Search</h3>
<show-movies-component>
    @if (isset($movies['results']))    
        @forelse ($movies['results'] as $movie)
            @if (isset($movie['poster_path']) && isset($movie['poster_path']) && isset($movie['original_title']) && isset($movie['release_date']))
                <movie-front-component local="false" id="{{$movie['id']}}" img="{{$movie['poster_path']}}" poster="{{$movie['poster_path']}}" title="{{$movie['original_title']}}" date="{{$movie['release_date']}}"></movie-front-component>
            @endif
        @empty
            <div class="text-center w-100">
                <p>{{__('No results')}}</p>
            </div>
        @endforelse
        @else
        <div class="text-center w-100">
            <p>{{__('Disabled')}}</p>
        </div>
    @endif
</show-movies-component>
@endsection