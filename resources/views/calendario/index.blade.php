<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
       <!-- Bootstrap 4.1.1 -->
       <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Incluir biblioteca de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluir biblioteca de Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        .container {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.header')

        </nav>

<div class="main-sidebar main-sidebar-postion">
            @include('layouts.sidebar')
</div>

<div class="main-content">
    <div id='calendar'></div>
</div>
   
<script>
$(document).ready(function () {
   
   var SITEURL = "{{ url('/') }}";
     
   $.ajaxSetup({
       headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
     
   var calendar = $('#calendar').fullCalendar({
                       editable: true,
                       events: SITEURL + "/fullcalender",
                       displayEventTime: false,
                       editable: true,
                       eventRender: function (event, element, view) {
                           if (event.allDay === 'true') {
                                   event.allDay = true;
                           } else {
                                   event.allDay = false;
                           }
                       },
                       selectable: true,
                       selectHelper: true,
                       select: function (start, end, allDay) {
                           var title = prompt('Event Title:');
                           if (title) {
                               var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                               var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                               $.ajax({
                                   url: SITEURL + "/fullcalenderAjax",
                                   data: {
                                       title: title,
                                       start: start,
                                       end: end,
                                       type: 'add'
                                   },
                                   type: "POST",
                                   success: function (data) {
                                       displayMessage("Evento creado");
     
                                       calendar.fullCalendar('renderEvent',
                                           {
                                               id: data.id,
                                               title: title,
                                               start: start,
                                               end: end,
                                               allDay: allDay
                                           },true);
     
                                       calendar.fullCalendar('unselect');
                                   }
                               });
                           }
                       },
                       eventDrop: function (event, delta) {
                           var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                           var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
     
                           $.ajax({
                               url: SITEURL + '/fullcalenderAjax',
                               data: {
                                   title: event.title,
                                   start: start,
                                   end: end,
                                   id: event.id,
                                   type: 'update'
                               },
                               type: "POST",
                               success: function (response) {
                                   displayMessage("Evento modificado");
                               }
                           });
                       },
                       eventClick: function (event) {
                           var deleteMsg = confirm("¿Quieres eliminar el evento?");
                           if (deleteMsg) {
                               $.ajax({
                                   type: "POST",
                                   url: SITEURL + '/fullcalenderAjax',
                                   data: {
                                           id: event.id,
                                           type: 'delete'
                                   },
                                   success: function (response) {
                                       calendar.fullCalendar('removeEvents', event.id);
                                       displayMessage("Evento eliminado");
                                   }
                               });
                           }
                       }
    
                   });
    
   });
    
   function displayMessage(message) {
       toastr.success(message, 'Evento');
   } 
</script>
<footer class="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</body>
</html>