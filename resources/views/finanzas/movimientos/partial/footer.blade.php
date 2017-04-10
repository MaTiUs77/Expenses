@include('iaserver.common.footer')
{!! IAScript('assets/highchart/js/highcharts.js') !!}


{!! IAScript('assets/moment.min.js') !!}
{!! IAScript('adminlte/plugins/fullcalendar/fullcalendar.min.js') !!}




<script>
    app.controller("FinanzasController",function($scope,$rootScope,$http,$timeout,$interval, IaCore, toasty)
    {
    });
</script>


<script>
  $(function () {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },

      events: calendarEvents   
    });
  });
</script>