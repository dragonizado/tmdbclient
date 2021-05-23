<form action="" method="post">
    <select name="type" id="">
        <option value="">Name</option>
        <option value="">Release Date</option>
    </select>
    <input type="text" name="search">
    <button>Buscar</button>
</form>

@foreach ($fullMovies['results'] as $movie)
    <div>
        <img src="https://image.tmdb.org/t/p/w500{{$movie['backdrop_path']}}" alt="{{$movie['original_title']}}">
        <span>{{$movie['vote_average']}}</span>
        <h5>{{$movie['original_title']}}</h5>
        <p>{{$movie['release_date']}}</p>
    </div>
@endforeach