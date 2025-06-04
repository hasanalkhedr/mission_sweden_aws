@extends('layouts.app')
@section('title', __('Calendrier'))
@section('content')
    <div class="px-20 py-2">
        <div class="inline-block">
            <div class="w-16 h-6 bg-blue-500 inline-block"></div>
            <span class="pl-20 text-lg">Mission Order</span>
        </div>
        <div class="inline-block">
            <div class="w-16 h-6 bg-green-500 inline-block"></div>
            <span class="pl-20 text-lg">Tournee Order</span></div>

    </div>
    <div id="calendar"></div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales-all.global.min.js"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                eventClick: function(info) {
                    // var eventObj = info.event;
                    // if (eventObj.url) {
                    //     window.open(eventObj.url);
                    // } else {}
                },
                headerToolbar: {
                    center: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
          today: "Aujourd'hui",
          month: 'Mois',
          week: 'Semaine',
          day: 'Jour',
          list: 'Agenda'
        },
                initialView: 'dayGridMonth',
                // slotMinTime: '00:00:00',
                // slotMaxTime: '00:00:00',
                events: @json($events),
            });
            calendar.setOption('locale', 'fr');
            calendar.render();
        });
    </script>

@endsection
