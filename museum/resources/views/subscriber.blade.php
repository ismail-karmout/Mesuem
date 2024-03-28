@extends('layouts.dashboard')


@section('titlePage')
    Reservations
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Reservation</h3>

        <div class="card-tools">
            {{ $reservations->links() }}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Guide</th>
                    <th>Date</th>
                    <th>Tarif</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $index => $reservation)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td> Mr/Mme {{ $reservation->visit->guide_name}}</td>
                        <td>{{ $reservation->visit->date }}</td>
                        <td>{{ $reservation->tarif }} DH</td>
                      
                   
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection
