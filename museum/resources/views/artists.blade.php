@extends('layouts.app')
@section('image-title')
    <div class='col-12 text-center'>
        <h1 class='display-2 text-light'>ARTISTES</h1>
        {{-- <button class='btn btn-info text-light btn-lg'> </button> --}}
    </div>
@endsection
@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center ">
            @foreach ($artists as $artist)
                <div class="card col-3 mx-4 mt-4">
                    <img class="card-img-top " src="{{ asset('/storage/' . $artist->avatar) }}" height="220px"
                        alt="Card image cap">
                    <div class="card-body">
                        <h4 class="text-center fw-bold"> {{ $artist->name }}</h4>
                        <p class="card-text">{{ $artist->artist->bio}}</p>
                        <p><strong>Type : </strong>{{ $artist->artist->genre}}</p>
                        <p><strong>Origine : </strong>{{ $artist->artist->location}}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $artists->links() }}
        </div>
    </div>
@endsection
