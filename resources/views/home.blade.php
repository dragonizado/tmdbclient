@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                    <h3 class="">{{ __('Your movies') }} <a href="{{route('site.movie.register')}}" class="btn btn-info float-right">New movie</a></h3>
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <show-movies-component>
                        @forelse ($user_movies as $movie)
                            <movie-front-component local="true" img="{{$movie['poster_path']}}" title="{{$movie['title']}}" date="{{$movie['release_date']}}"></movie-front-component>
                        @empty
                            <div class="text-center w-100">
                                <p>{{__('You have no movies registered ')}}</p>
                            </div>
                        @endforelse
                    </show-movies-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
