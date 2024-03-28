@extends('layouts.dashboard')


@section('titlePage')
    Profile
@endsection

@section('content')
    <div class="container " style="display: flex; justify-content: center; align-items: center; height: 20">
        <div class="col-md-4 ">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="row  m-3">
                    <label for="name" class="col-form-label">Nom et Prénom :</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', Auth::user()->name ?? null) }}" required autocomplete="name"
                        autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row m-3">
                    <label for="email" class=" col-form-label ">{{ __('Email Address') }}</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email', Auth::user()->email ?? null) }}" required
                        autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row m-3">
                    <label for="old_password" class="col-form-label ">{{ __('Old Password') }}</label>

                    <input id="old_password" type="password"
                        class="form-control @error('old_password') is-invalid @enderror" name="old_password"
                        autocomplete="new-password">

                    @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row m-3">
                    <label for="password" class="col-form-label ">{{ __('Password') }}</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row m-3">
                    <label for="password-confirm" class=" col-form-label ">{{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        autocomplete="new-password">
                </div>
                <div class="row m-3">
                    <label for="category" class=" col-form-label ">Category</label>
                    <select name="category" id="category" class="form-control">

                        <option value="{{ Auth::user()->category }}" selected >{{ Auth::user()->category }}
                        </option>
                        <option value="public">public</option>
                        <option value="étudiant">étudiant</option>
                        <option value="élève">élève</option>
                        <option value="étudiant d'art">étudiant d'art</option>
                        <option value="comité d'entreprise">comité d'entreprise</option>
                    </select>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
