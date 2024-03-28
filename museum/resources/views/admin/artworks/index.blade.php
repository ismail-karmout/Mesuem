@extends('layouts.dashboard')


@section('titlePage')
    Gestion des œuvres
@endsection

@section('content')
    <div class="d-flex justify-content-end my-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter un œuvre
        </button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter œuvre</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('artworks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="name" class="form-label">Numéro :</label>
                                <input type="text" class="form-control" id="number" name="number"
                                    placeholder="Nom et prénom" value="{{ old('number') }}">
                                @error('number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label">Titre :</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Nom et prénom" value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label">Artiste :</label>
                                <select name="artist_id" id="artist_id" class="form-control">
                                    <option value="" disabled selected>Choisir un artiste</option>
                                    @foreach ($artists as $artist)
                                        <option value="{{ $artist->id }}"
                                            @if (old('assurance_type') == $artist->id) {{ 'selected' }} @endif>{{ $artist->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('artist_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label">Salle :</label>
                                <select name="salle_id" id="salle_id" class="form-control">
                                    <option value="" disabled selected>Choisir une salle</option>
                                    @foreach ($salles as $salle)
                                        <option value="{{ $salle->id }}"
                                            @if (old('salle_id') == $salle->id) {{ 'selected' }} @endif>{{ $salle->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('salle_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="name" class="form-label">Prix DH :</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Prix"
                                    value="{{ old('price') }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="name" class="form-label">Origine :</label>
                                <input type="text" class="form-control" id="origine" name="origine"
                                    placeholder="Origine" value="{{ old('origine') }}">
                                @error('origine')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label">Description :</label>
                                <textarea name="description" id="description" cols="2" rows="2" class="form-control">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label">Assurance :</label>
                                <select name="assurance_type" id="assurance_type" class="form-control">
                                    <option value="" disabled selected>Choisir une assurance</option>
                                    <option value="multirisque habitatio"
                                        @if (old('assurance_type') == 'multirisque habitatio') {{ 'selected' }} @endif>multirisque habitatio
                                    </option>
                                    <option value="clou à clou"
                                        @if (old('assurance_type') == 'clou à clou') {{ 'selected' }} @endif>clou à clou</option>
                                    <option value="Tous risques sauf"
                                        @if (old('assurance_type') == 'Tous risques sauf') {{ 'selected' }} @endif>Tous risques sauf
                                    </option>
                                </select>
                                @error('assurance')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label">Conditions de sécurité :</label>
                                <textarea name="security_conditions" id="security_conditions" cols="2" rows="2" class="form-control">{{ old('security_conditions') }}</textarea>
                                @error('security_conditions')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="name" class="form-label">Image :</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    placeholder="image" value="{{ old('image') }}">
                                @error('image')
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
            <h3 class="card-title"> œuvres</h3>

            <div class="card-tools">
                {{ $artworks->links() }}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>number</th>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Artiste</th>
                        <th>Salle</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artworks as $artwork)
                        <tr>
                            <td>{{ $artwork->id }}</td>
                            <td>{{ $artwork->number }}</td>
                            <td><img src="{{ asset('storage/' . $artwork->image) }}" alt="" width="50"></td>
                            <td>{{ $artwork->title }}</td>
                            <td>{{ $artwork->artist->name }}</td>
                            <td> <span  class="badge badge-success text-md">{{ $artwork->salle->name }}</span></td>
                            <td>
                                @if ($artwork->deleted_at)
                                    <form action="{{ route('artworks.restore', $artwork->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Restaurer</button>
                                    </form>
                                @else
                                    <div class="d-flex">


                                        <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                            data-bs-target="#moreInfo{{ $artwork->id }}">
                                            <i class="nav-icon far fa-plus-square"></i>
                                        </button>
                                        <div class="modal fade text-dark" id="moreInfo{{ $artwork->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Plus d'info</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list-group">

                                                            <li class="list-group-item active text-center"
                                                                aria-current="true">
                                                                {{ $artwork->artist->name }}</li>

                                                            <img src="{{ asset('storage/' . $artwork->image) }}"
                                                                alt="{{ $artwork->title }}" width="100%">

                                                            <li class="list-group-item">
                                                                <strong>Titre :</strong> {{ $artwork->title }}
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>Numéro :</strong> {{ $artwork->number }}
                                                            </li>

                                                            <li class="list-group-item">
                                                                <strong>Prix DH :</strong> {{ $artwork->price }}
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>Origine :</strong> {{ $artwork->origine }}
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>Assurance type :</strong>
                                                                {{ $artwork->assurance_type }}
                                                            </li>
                                                            <li class="list-group-item">
                                                                <strong>Conditions de
                                                                    sécurité :</strong>
                                                                {{ $artwork->security_conditions }}
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $artwork->id }}">
                                            <i class="nav-icon fas fa-edit"></i>
                                        </button>
                                        <div class="modal fade" id="edit{{ $artwork->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modifier
                                                            l'oeuvre</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('artworks.update', $artwork->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="number">Numéro</label>
                                                                <input type="text" name="number" id="number"
                                                                    class="form-control @error('number') is-invalid @enderror"
                                                                    value="{{ old('number', $artwork->number ?? null) }}">
                                                                @error('number')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="title">Titre</label>
                                                                <input type="text" name="title" id="title"
                                                                    class="form-control @error('title') is-invalid @enderror"
                                                                    value="{{ old('name', $artwork->title ?? null) }}">
                                                                @error('title')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="artist_id">Artiste</label>
                                                                <select name="artist_id" id="artist_id"
                                                                    class="form-control @error('artist_id') is-invalid @enderror">
                                                                    <option value="">Choisir un artiste</option>
                                                                    @foreach ($artists as $artist)
                                                                        <option value="{{ $artist->id }}"
                                                                            {{ old('artist_id', $artwork->artist_id ?? null) == $artist->id ? 'selected' : '' }}>
                                                                            {{ $artist->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('artist_id')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group"> 
                                                                <label for="salle_id">Salle :</label>
                                                                <select name="salle_id" id="salle_id"
                                                                    class="form-control @error('salle_id') is-invalid @enderror">
                                                                    <option value="">Choisir une salle</option>
                                                                    @foreach ($salles as $salle)
                                                                        <option value="{{ $salle->id }}"
                                                                            {{ old('salle_id', $artwork->salle_id ?? null) == $salle->id ? 'selected' : '' }}>
                                                                            {{ $salle->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('salle_id')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price">Prix DH</label>
                                                                <input type="number" name="price" id="price"
                                                                    class="form-control @error('price') is-invalid @enderror"
                                                                    value="{{ old('price', $artwork->price ?? null) }}">
                                                                @error('price')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="origine">Origine</label>
                                                                <input type="text" name="origine" id="origine"
                                                                    class="form-control @error('origine') is-invalid @enderror"
                                                                    value="{{ old('origine', $artwork->origine ?? null) }}">
                                                                @error('origine')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="assurance_type">Type d'assurance</label>
                                                                <select name="assurance_type" id="assurance_type"
                                                                    class="form-control @error('assurance_type') is-invalid @enderror">
                                                                    <option value="multirisque habitatio"
                                                                        @if (old('assurance_type') == $artwork->assurance_type) {{ 'selected' }} @endif>
                                                                        multirisque habitatio
                                                                    </option>
                                                                    <option value="clou à clou"
                                                                        @if (old('assurance_type') == $artwork->assurance_type) {{ 'selected' }} @endif>
                                                                        clou à clou</option>
                                                                    <option value="Tous risques sauf"
                                                                        @if (old('assurance_type') == $artwork->assurance_type) {{ 'selected' }} @endif>
                                                                        Tous risques sauf
                                                                    </option>
                                                                </select>
                                                                @error('assurance_type')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                                    rows="3">{{ old('description', $artwork->description ?? null) }}</textarea>
                                                                @error('description')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="security_conditions">Conditions de
                                                                    sécurité</label>
                                                                <textarea name="security_conditions" id="security_conditions"
                                                                    class="form-control @error('security_conditions') is-invalid @enderror" rows="3">{{ old('security_conditions', $artwork->security_conditions ?? null) }}</textarea>
                                                                @error('security_conditions')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">Image</label>
                                                                <input type="file" name="image" id="image"
                                                                    class="form-control @error('image') is-invalid @enderror"
                                                                    value="{{ old('image', $artwork->image ?? null) }}">
                                                                @error('image')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">fermer</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>







                                        <form action="{{ route('artworks.destroy', $artwork->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ">Supprimer</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    @if ($errors->any())
        <script>
            window.onload = function() {
                $('#exampleModal').modal('show');
            }
        </script>
    @endif
@endsection
