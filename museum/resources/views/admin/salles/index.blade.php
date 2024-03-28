@extends('layouts.dashboard')


@section('titlePage')
    Gestion des Salles
@endsection

@section('content')
<div class="d-flex justify-content-end my-2">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter une Salle
    </button>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Salle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('salles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="name" class="form-label">Nom :</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="description" class="form-label">Description :</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description"
                                value="{{ old('description') }}"></textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="capacity" class="form-label">Capacité :</label>
                            <input type="number" class="form-control" id="capacity" name="capacity"
                                placeholder="Capacité" value="{{ old('capacity') }}">
                            @error('capacity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Salles</h3>

        <div class="card-tools">
            {{ $salles->links() }}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th style="">#</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Capacité (œuvres)</th>
                    <th>liste des œuvres</th>
                    <th>Opérations</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($salles as $index => $salle)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $salle->name }}</td>
                        <td>{{ $salle->description }}</td>
                        <td>{{ $salle->capacity }} ( {{ $salle->artworks->count()}} )</td>
                        <td>
                            @foreach ($salle->artworks as $artwork)
                            <div class="mb-1 d-flex">
                                <img src="{{ asset('/storage/'.$artwork->image )}}" alt=""  width="50">
                                <div class="bg-primary w-50 text-center rounded-end">
                                    {{ $artwork->title }} 
                                </div>
                            </div>
                             
                            @endforeach
                        </td>
                        <td> 
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $salle->id }}">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <div class="modal fade" id="exampleModal{{ $salle->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Salle</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('salles.update', $salle->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-2">
                                                    <label for="name" class="form-label">Nom :</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Nom" value="{{ old('number', $salle->name ?? null) }}">
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-2">
                                                    <label for="description" class="form-label">Description :</label>
                                                    <textarea class="form-control" id="description" name="description"
                                                        placeholder="Description">{{ old('number', $salle->description ?? null) }}</textarea>
                                                    @error('description')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-2">
                                                    <label for="capacity" class="form-label">Capacité :</label>
                                                    <input type="number" class="form-control" id="capacity" name="capacity"
                                                        placeholder="Capacité" value="{{ old('number', $salle->capacity ?? null) }}">
                                                    @error('capacity')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach 

            </tbody>
        </table>
    </div>
</div>
@if ($errors->any())
<script>
    window.onload = function() {
        $('#exampleModal').modal('show');
    }
</script>
@endif
@endsection
