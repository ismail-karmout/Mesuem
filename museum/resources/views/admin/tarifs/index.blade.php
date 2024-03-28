@extends('layouts.dashboard')


@section('titlePage')
    Gestion des Tarifs
@endsection

@section('content')
    <div class="d-flex justify-content-end my-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter Tarif
        </button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Tarif</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('tarifs.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="category" class="form-label">Catégorie :</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    placeholder="category" value="{{ old('category') }}">
                                @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="tarif" class="form-label">Tarif :</label>
                                <input type="number" class="form-control" id="tarif" name="tarif" min="1"
                                    placeholder="tarif" value="{{ old('tarif') }}">
                                @error('tarif')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="tarif_reduit" class="form-label">Réduction % :</label>
                                <input type="number" class="form-control" id="tarif_reduit" name="tarif_reduit"
                                    min="0" max="100" placeholder="Réduction" value="{{ old('tarif_reduit') }}">
                                @error('tarif_reduit')
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
                        <th>Opérations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tarifs as $index => $tarif)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $tarif->category }}</td>
                            <td> <span class="badge badge-success">{{ $tarif->tarif }} DH</span></td>
                            <td><span class="badge badge-info">{{ $tarif->tarif_reduit }} %</span></td>
                            <td>
                                @if($tarif->editable !== 0)
                                <button type="button" class="btn btn-warning " data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $tarif->id }}">
                                    
                                    <i class="fas fa-edit"></i>
                                </button>
                                <div class="modal fade" id="editModal{{ $tarif->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Tarif</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('tarifs.update', $tarif->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-2">
                                                        <label for="category" class="form-label">Catégorie :</label>
                                                        <input type="text" class="form-control" id="category"
                                                            name="category" placeholder="category"
                                                            value="{{ old('category', $tarif->category ?? null) }}">
                                                        @error('category')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="tarif" class="form-label">Tarif :</label>
                                                        <input type="number" class="form-control" id="tarif"
                                                            name="tarif" min="1" placeholder="tarif"
                                                            value="{{ old('tarif', $tarif->tarif ?? null) }}">
                                                        @error('tarif')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="tarif_reduit" class="form-label">Réduction % :</label>
                                                        <input type="number" class="form-control" id="tarif_reduit"
                                                            name="tarif_reduit" min="0" max="100"
                                                            placeholder="Réduction"
                                                            value="{{ old('tarif_reduit', $tarif->tarif_reduit ?? null) }}">
                                                        @error('tarif_reduit')
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

                                <form action="{{ route('tarifs.destroy', $tarif->id) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ">Supprimer</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
