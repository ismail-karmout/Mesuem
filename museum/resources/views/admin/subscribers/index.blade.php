@extends('layouts.dashboard')


@section('titlePage')
    Gestion des abonnés
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Abonnés</h3>

            <div class="card-tools">
                {{ $subscribers->links() }}
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
                        <th>Crée le </th>
                        <th>supprimé le </th>
                        <th>Opération </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribers as $index => $subscriber)
                        <tr>
                            <td>{{ $index + 1 }}.</td>
                            <td>
                                <div class="user-panel d-flex">

                                    <div class="image">
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                            class="img-circle elevation-2" alt="User Image">
                                    </div>
                                </div>
                            </td>
                            <td>{{ $subscriber->name }}</td>
                            <td>{{ $subscriber->email }}</td>

                            <td><span class="badge text-dark ">{{ $subscriber->created_at }}</span></td>
                            <td><span class="badge bg-success">{{ $subscriber->deleted_at }}</span></td>
                            <td>
                              @if ($subscriber->deleted_at == null)
                                  <form action="{{ route('subscribers.destroy', $subscriber->id) }}" method="POST"
                                      style="display: inline-block">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                  </form>
                              @else
                                    <form action="{{ route('subscribers.restore', $subscriber->id) }}" method="POST"
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
@endsection
