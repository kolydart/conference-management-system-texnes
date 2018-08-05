@extends('layouts.app')


@section('content')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css'/>
    <link rel='stylesheet' href='/css/scheduler.min.css'/>

    <h3 class="page-title">Calendar</h3>

    <div id='calendar'></div>

@endsection

@section('javascript')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
    <script src='/js/scheduler.min.js'></script>
    <script>
        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            /**
             * events
             * @type json object
             * @see https://fullcalendar.io/docs/event-object
             */
            events={!! json_encode($events)  !!};
            /**
             * resources (rooms)
             * @example { id: 'a', title: 'Room A' },
             */
            resources={!! json_encode($resources) !!}; 

            $('#calendar').fullCalendar({
                // put your options and callbacks here
                /** academic lisence */
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                events: events,
                resources: resources,
                header: {
                  left: 'prev,next',
                  center: 'title',
                  right: 'agendaDay,agendaThreeDay'
                },

                /** custom view: three days */
                views: {
                  agendaThreeDay: {
                    type: 'agenda',
                    duration: { days: 3 }
                  }
                },                
                defaultView: 'agendaThreeDay',

                /** group by date, then by resource */
                groupByDateAndResource: true,
                
                /** start date */
                defaultDate: '2018-10-11',
                allDaySlot: false,
                minTime: "09:00:00",
                maxTime: "22:00:00",
            })
        });
    </script>
@endsection