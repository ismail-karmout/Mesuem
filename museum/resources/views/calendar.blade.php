@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}" />
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <style>
        .fc-day-grid-event .fc-content {
            white-space: normal !important;
        }
    </style>
@endsection
@section('image-title')
    <div class='col-12 text-center'>
        <h1 class='display-2 text-light'>Conférences et Manifestations</h1>
        {{-- <button class='btn btn-info text-light btn-lg'> </button> --}}
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div style="color: #fd7e14">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-square-fill" viewBox="0 0 16 16">
                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z" />
                </svg>
                <span class="text-dark fw-bold">Manifestations</span>
            </div>

            <div style="color: #0dcaf0" class="mx-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-square-fill" viewBox="0 0 16 16">
                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z" />
                </svg>
                <span class="text-dark fw-bold">Conférences</span>
            </div>
        </div>
        <div id="calendar" class="m-5"></div>


    </div>
@endsection
@section('script')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/fr.js') }}"></script>

    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                locale: 'fr',
                events: <?php echo $events; ?>,
                defaultView: 'basicWeek',

                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,


            });

        });
    </script>
@endsection
