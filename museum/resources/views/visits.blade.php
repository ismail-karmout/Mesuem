@extends('layouts.app')
@section('image-title')
    <div class='col-12 text-center'>
        <h1 class='display-2 text-light'>Visite et tarifs</h1>
    </div>
@endsection
@section('content')
    <div class="container ">
        @auth
            <form action="{{ route('reservations.store') }}" method="POST" >
                @csrf
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <div class="mb-2">
                                <label for="date" class="form-label">Date :</label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date"
                                    value="{{ old('date') }}">
                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-auto">Enregistrer</button>
                        </div>
                    </div>
                    
                </form>
        @endauth

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title"> Tarifs</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="">#</th>
                            <th>Catégorie</th>
                            <th>Tarif DH</th>
                            <th>Réduction %</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tarifs as $index => $tarif)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $tarif->category }}</td>
                                <td> <span class="badge badge-success bg-success">{{ $tarif->tarif }} DH</span></td>
                                <td><span class="badge badge-info bg-info">{{ $tarif->tarif_reduit }} %</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
