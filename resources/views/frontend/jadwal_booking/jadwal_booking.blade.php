@extends('frontend.layouts.app')
@section('content')
<link href="{{ asset('assets/fullcalendar/lib/main.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/fullcalendar/lib/main.js') }}"></script>
<style>
    a {
        color: #000 !important;
        text-decoration: none;
    }
</style>
 <!-- Service Start -->

<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url({{asset('assets_frontend/img/background_prime_1.jpg')}});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">{{$tittle}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="/" style="color: red !important">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{$tittle}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">

        <div class="row gx-5">
            <div class="col-lg-12">
                <br>
                @if(session()->has('status') && session()->has('message'))
                    @if (session()->get('status') == 'sukses')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @else
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!</strong> {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria- ="true">&times;</span>
                        </button>
                    </div>
                    @endif
                @endif

                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"></h3>
                            </div>
                            <div class="col text-right">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
</div>



<script src="{{ asset('assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
<script>


    var listBooking = JSON.parse('<?php echo json_encode(@$dataBooking); ?>');
    var nowDate = '{{date("Y-m-d")}}';
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next',
          center: 'title',
          right: 'dayGridMonth'
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
<!-- Booking End -->
@endsection
