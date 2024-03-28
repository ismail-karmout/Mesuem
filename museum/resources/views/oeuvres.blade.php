@extends('layouts.app')
@section('image-title')
    <div class='col-12 text-center'>
        <h1 class='display-2 text-light'>Œuvres</h1>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center ">
            @foreach ($artworks as $artwork)
                <div class="card col-3 mx-4 mt-4">
                    <img class="card-img-top " src="{{ asset('/storage/' . $artwork->image) }}" height="220px"
                        alt="Card image cap">
                    <div class="card-body">
                        <h4 class="text-center fw-bold"> {{ $artwork->title }}</h4>
                        <p class="card-text">{{ $artwork->description }}</p>
                        <p><strong>Artiste : </strong>{{ $artwork->artist->name }}</p>
                        <p><strong>Prix : </strong>{{ $artwork->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $artworks->links() }}
        </div>
    </div>
@endsection
