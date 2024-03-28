@extends('layouts.dashboard')
@section('files')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}" />
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <style>
        .fc-day-grid-event .fc-content {
            white-space: normal !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
@endsection

@section('titlePage')
    Gestion des œuvres
@endsection

@section('content')
    <form action="{{ route('conferenciers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <label for="conferenciers" class="form-label" id="conferenciers">Conférencier :</label>
                            <select class="form-select" aria-label="Default select example" name="conferencie_id">
                                <option selected disabled>Choisir un conférencier</option>
                                @foreach ($conferenciers as $conferencier)
                                    <option value="{{ $conferencier->id }}">{{ $conferencier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-2">
                            <label for="sujet" class="form-label">Sujet :</label>
                            <input type="text" class="form-control" id="sujet" name="sujet" placeholder="Sujet"
                                value="{{ old('sujet') }}">
                            @error('sujet')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">

                        <div class="mb-2">
                            <label for="date" class="form-label">Date :</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Date"
                                value="{{ old('date') }}">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
    <div id="calendar" class="m-5"></div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="{{ asset('js/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/fr.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                locale: 'fr',
                events: <?php echo $events; ?>,
                displayEventTime: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,

                eventClick: function(event) {
                    var eventDelete = confirm('Are you sure to remove event?');
                    if (eventDelete) {
                        $.ajax({
                            type: "post",
                            url: "/conferences/" + event.id,
                            data: {
                                id: event.id,
                                _method: 'delete',
                            },
                            success: function(response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                iziToast.success({
                                    position: 'topRight',
                                    message: 'Event removed successfully.',
                                });
                            }
                        });
                    }
                }
            });

        });
    </script>
@endsection
