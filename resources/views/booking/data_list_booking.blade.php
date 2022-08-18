@extends('layouts.app')
@section('content')
<link href="{{ asset('assets/fullcalendar/lib/main.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/fullcalendar/lib/main.js') }}"></script>
{{-- <link href='../lib/main.css' rel='stylesheet' />
<script src='../lib/main.js'></script> --}}

<style>
    #calendar {
      max-width: 1300px;
      margin: 0 auto;
    }
  </style>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col-xl-12 mb-6 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{$tittle}}</h3>
                        </div>
                        <div class="col text-right">
                            {{-- <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fas fa-plus"></i></button> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
  <script>
    var listBooking = JSON.parse('<?php echo json_encode(@$dataBooking); ?>');
    var nowDate = '{{date("Y-m-d")}}';
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next',
          center: 'title',
          right: 'dayGridMonth,listMonth'
        },
        initialDate: nowDate,
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
        selectable: true,
        events: listBooking
      });

      calendar.render();
    });

  </script>

@endsection
