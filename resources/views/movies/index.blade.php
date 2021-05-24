@extends('layouts.app')

@section('content')  

@auth

    <div>
        <h2>{{__('Your movies')}} <a href="{{route('site.movie.register')}}" class="btn btn-info ml-3">New</a></h2> 
    </div>
    <show-movies-component>
      @forelse ($user_movies as $movie)
          <movie-front-component local="true" id="{{$movie['id']}}" img="{{$movie['poster_path']}}" title="{{$movie['original_title']}}" date="{{$movie['release_date']}}"></movie-front-component>
      @empty
          <div class="text-center w-100">
              <p>{{__('You have no movies registered ')}}</p>
          </div>
      @endforelse
    </show-movies-component>
    <hr>

  @if (count($other_user_movies) > 0)
    <h2>{{__('Other users')}}</h2> 
    <show-movies-component>
      @foreach ($other_user_movies as $movie)
        <movie-front-component local="true" id="{{$movie['id']}}" img="{{$movie['poster_path']}}" title="{{$movie['original_title']}}" date="{{$movie['release_date']}}"></movie-front-component>
      @endforeach
    </show-movies-component>
  @endif

@endauth
<h2>{{__('Popular')}}</h2>
<show-movies-component>
  @foreach ($full_movies['results'] as $movie)
      <movie-front-component id="{{$movie['id']}}" local="false" img="{{$movie['poster_path']}}" poster="{{$movie['poster_path']}}" title="{{$movie['original_title']}}" date="{{$movie['release_date']}}"></movie-front-component>
  @endforeach
</show-movies-component>
@endsection