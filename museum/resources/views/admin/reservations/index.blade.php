@extends('layouts.dashboard')
@section('files')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}" />
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <style>
        .fc-day-grid-event .fc-content {
            white-space: normal !important;
        }
    </style>
@endsection
@section('titlePage')
    Visites et Reservations
@endsection

@section('content')
<div id="calendar" class="m-5"></div>

@endsection
@section('script')

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
