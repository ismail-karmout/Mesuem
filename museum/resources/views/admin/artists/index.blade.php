@extends('layouts.dashboard')


@section('titlePage')
    Gestion des artistes
@endsection

@section('content')
    <div class="d-flex justify-content-end my-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter un artiste
        </button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter artiste</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="name" class="form-label">Nom et prénom</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nom et prénom" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Téléphone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="genre" class="form-label">Type</label>
                                <input type="text" class="form-control" id="genre" name="genre"
                                    placeholder="Genre"value="{{ old('genre') }}">
                                @error('genre')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="bio" class="form-label">Bio</label>
                                <input type="text" class="form-control" id="bio" name="bio" placeholder="Bio"
                                    value="{{ old('bio') }}">
                                @error('bio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="location" class="form-label">Origine</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Location" value="{{ old('location') }}">
                                @error('location')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar"
                                    placeholder="Avatar" value="{{ old('avatar') }}">
                                @error('avatar')
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
            <h3 class="card-title"> Artistes</h3>

            <div class="card-tools">
                {{ $artists->links() }}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th style="">#</th>
                        <th>Profile</th>
                        <th>Nom et prénom</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Crée le </th>
                        <th>supprimé le </th>
                        <th>Opération </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artists as $index => $artist)
                        <tr>
                            <td>{{ $index + 1 }}.</td>
                            <td>
                                <div class="user-panel d-flex">

                                    <div class="image">
                                        <img src="{{ asset('storage/' . $artist->avatar) }}"
                                            class="img-circle elevation-2" alt="User Image">
                                    </div>
                                </div>
                            </td>
                            <td>{{ $artist->name }}</td>
                            <td>{{ $artist->email }}</td>
                            <td>{{ $artist->artist->genre }}</td>

                            <td><span class="badge text-dark ">{{ $artist->created_at }}</span></td>
                            <td><span class="badge bg-success">{{ $artist->deleted_at }}</span></td>
                            <td>
                                @if ($artist->deleted_at == null)
                                    {{-- show info --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#artist{{ $artist->id }}">
                                        <i class="nav-icon far fa-plus-square"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="artist{{ $artist->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Plus
                                                        d'informations
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item active text-center"
                                                            aria-current="true">
                                                            {{ $artist->name }}</li>
                                                        <li class="list-group-item">
                                                            <strong>Phone :</strong> {{ $artist->artist->phone }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Type :</strong> {{ $artist->artist->genre }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Bio :</strong> {{ $artist->artist->bio }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Origine :</strong> {{ $artist->artist->location }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">fermer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- update info  --}}
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#artistUpdate{{ $artist->id }}">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="artistUpdate{{ $artist->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifer
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('artists.update', $artist->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">

                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="name">
                                                                Nom</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                value="{{ old('name', $artist->name ?? null) }}">
                                                            @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('email') is-invalid @enderror">
                                                            <label for="email">
                                                                Email</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                value="{{ old('email', $artist->email ?? null) }}">
                                                            @error('email')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('phone') is-invalid @enderror">
                                                            <label for="phone">
                                                                Phone</label>
                                                            <input type="text" name="phone" id="phone"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                value="{{ old('phone', $artist->artist->phone ?? null) }}">
                                                            @error('phone')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('genre') is-invalid @enderror">
                                                            <label for="genre">
                                                                Type</label>
                                                            <input type="text" name="genre" id="genre"
                                                                class="form-control @error('genre') is-invalid @enderror"
                                                                value="{{ old('genre', $artist->artist->genre ?? null) }}">
                                                            @error('genre')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('bio') is-invalid @enderror">
                                                            <label for="bio">
                                                                Bio</label>
                                                            <input type="text" name="bio" id="bio"
                                                                class="form-control @error('bio') is-invalid @enderror"
                                                                value="{{ old('bio', $artist->artist->bio ?? null) }}">
                                                            @error('bio')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('location') is-invalid @enderror">
                                                            <label for="location">
                                                                Origine</label>
                                                            <input type="text" name="location" id="location"
                                                                class="form-control @error('location') is-invalid @enderror"
                                                                value="{{ old('location', $artist->artist->location ?? null) }}">
                                                            @error('location')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('avatar') is-invalid @enderror">
                                                            <label for="avatar">
                                                                Avatar</label>
                                                            <input type="file" name="avatar" id="avatar"
                                                                class="form-control @error('avatar') is-invalid @enderror"
                                                                value="{{ old('avatar', $artist->artist->avatar ?? null) }}">
                                                            @error('avatar')
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
                                    <form action="{{ route('artists.destroy', $artist->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                @else
                                    <form action="{{ route('artists.restore', $artist->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">Restaurer</button>
                                    </form>
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
