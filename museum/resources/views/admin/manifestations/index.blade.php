@extends('layouts.dashboard')


@section('titlePage')
    Gestion des Manifestation
@endsection

@section('content')
    <div class="d-flex justify-content-end my-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter une Manifestation
        </button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Manifestation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('manifestations.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="theme" class="form-label">Theme :</label>
                                <input type="text" class="form-control" id="theme" name="theme" placeholder="Theme"
                                    value="{{ old('theme') }}">
                                @error('theme')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="start_date" class="form-label">Date de début :</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                    placeholder="Date de début" value="{{ old('start_date') }}">
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="end_date" class="form-label">Date de fin :</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                    placeholder="Date de fin" value="{{ old('end_date') }}">
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="salle" class="form-label">Salles :</label>
                                <select class="form-select" name="salles[]" id="salles" multiple>
                                    @foreach ($salles as $salle)
                                        <option value="{{ $salle->id }}">{{ $salle->name }}</option>
                                    @endforeach
                                </select>
                                @error('salles')
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
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th style="">#</th>
                    <th>theme</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>salle</th>
                    <th>Opérations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($manifestations as $manifestation)
                    <tr>
                        <td>{{ $manifestation->id }}</td>
                        <td>{{ $manifestation->theme }}</td>
                        <td>{{ $manifestation->start_date }}</td>
                        <td>{{ $manifestation->end_date }}</td>
                        <td>
                            @foreach ($manifestation->salles as $salle)
                               
                                    <form action="{{ route('manifestations.detach', $manifestation->id) }}" method="POST">
                                        @csrf
                                        <span class="badge btn-success btn-sm mb-1 position-relative">{{ $salle->name }}
                                        <input type="hidden" name="salle_id" value="{{ $salle->id }}">
                                        <button
                                            class="position-absolute top-0 start-100 translate-middle  bg-danger border border-light rounded-circle">
                                            x
                                            <span class="visually-hidden"></span>
                                        </button>
                                </span><br>
                                </form>
                            @endforeach
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $manifestation->id }}">
                                <i class="nav-icon fas fa-edit"></i>
                            </button>
                            <div class="modal fade" id="edit{{ $manifestation->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Manifestation</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('manifestations.update', $manifestation->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="theme">Théme :</label>
                                                    <input type="text" name="theme" id="theme"
                                                        class="form-control @error('theme') is-invalid @enderror"
                                                        value="{{ old('theme', $manifestation->theme ?? null) }}">
                                                    @error('nathememe')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="start_date">Date de début :</label>
                                                    <input type="datetime-local" name="start_date" id="start_date"
                                                        class="form-control @error('start_date') is-invalid @enderror"
                                                        value="{{ old('start_date', $manifestation->start_date ?? null) }}">
                                                    @error('start_date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="end_date">Date de fin :</label>
                                                    <input type="datetime-local" name="end_date" id="end_date"
                                                        class="form-control @error('end_date') is-invalid @enderror"
                                                        value="{{ old('end_date', $manifestation->end_date ?? null) }}">
                                                    @error('end_date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="salle">Salles :</label>
                                                    <select class="form-select" name="salles[]" id="salles" multiple>
                                                        @foreach ($manifestation->salles as $salle)
                                                            <option value="{{ $salle->pivot->salle_id }}" selected>
                                                                {{ $salle->name }}</option>
                                                        @endforeach
                                                     
                                                        @foreach ($salles as $salle)
                                                            <option value="{{ $salle->id }}">
                                                                {{ $salle->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('salles')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
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
                            <form action="{{ route('manifestations.destroy', $manifestation->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
