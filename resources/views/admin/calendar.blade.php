@extends((gateweb\common\Presenter::before(\Route::currentRouteName(),'.') == 'admin')?'layouts.app':'frontend.app')


@section('content')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css'/>
    <link rel='stylesheet' href='/css/scheduler.min.css'/>


    <div class="row">
      <div class="col-md-6">
        <h3 class="page-title">@lang('Calendar')</h3>        
      </div>
      @if (gateweb\common\Presenter::before(\Route::currentRouteName(),'.') == 'admin')
        <div class="col-md-6 text-right">
          <a href="javascript:jQuery('#calendar').fullCalendar('option', 'filterResourcesWithEvents', !jQuery('#calendar').fullCalendar('option', 'filterResourcesWithEvents'));" class="btn btn-default pull-right">@lang('Show/hide unused Rooms')</a>
          
        </div>
      @endif
    </div>
    
    <div id='calendar'></div>

@endsection

@section('javascript')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
    <script src='/js/scheduler.min.js'></script>
    <script src='/js/fullcalendar_el.js'></script>
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

                defaultView: 'agendaDay',
                // defaultView: 'agendaThreeDay',

                /** hide inactive rooms */
                filterResourcesWithEvents: true,

                /** group by date, then by resource */
                groupByDateAndResource: true,
                
                /** date/time setup */
                allDaySlot: false,
                minTime: "09:00:00",
                maxTime: "22:00:00",
                validRange: {
                  start: '2018-10-11',
                  end: '2018-10-14'
                },

                timeFormat: 'H:mm',
                nowIndicator: true,
                titleFormat: 'dddd, D MMMM YYYY',

                locale: 'el',

            })
        });
    </script>
@endsection