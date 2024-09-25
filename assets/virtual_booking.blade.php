@extends('frontend.layout')
@section('pageHeading')
    @if (!empty($pageHeading))
        {{ $pageHeading->customer_booking_page_title ?? __('Virtual Event Bookings') }}
    @else
        {{ __('Virtual Event Bookings') }}
    @endif
@endsection
@section('hero-section')
    <!-- Page Banner Start -->
    <!--<section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"-->
    <!--    data-bg="{{ asset('assets/admin/img/' . $basicInfo->breadcrumb) }}">-->
    <!--    <div class="container">-->
    <!--        <div class="banner-inner">-->
    <!--            <h2 class="page-title">-->
    <!--                @if (!empty($pageHeading))-->
    <!--                    {{ $pageHeading->customer_booking_page_title ?? __('Virtual Event Bookings') }}-->
    <!--                @else-->
    <!--                    {{ __('Event Bookings') }}-->
    <!--                @endif-->
    <!--            </h2>-->
    <!--            <nav aria-label="breadcrumb">-->
    <!--                <ol class="breadcrumb">-->
    <!--                    <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">-->
    <!--                            @if (!empty($pageHeading))-->
    <!--                                {{ $pageHeading->customer_dashboard_page_title ?? __('Dashboard') }}-->
    <!--                            @else-->
    <!--                                {{ __('Dashboard') }}-->
    <!--                            @endif-->
    <!--                        </a></li>-->
    <!--                    <li class="breadcrumb-item active">-->
    <!--                        @if (!empty($pageHeading))-->
    <!--                            {{ $pageHeading->customer_booking_page_title ?? __('Virtual Event Bookings') }}-->
    <!--                        @else-->
    <!--                            {{ __('Virtual Event Bookings') }}-->
    <!--                        @endif-->
    <!--                    </li>-->
    <!--                </ol>-->
    <!--            </nav>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- Page Banner End -->
@endsection
@section('content')
    <!--====== Start Dashboard Section ======-->
    <section class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xxl-11 mx-auto">
                    <div class="content">
                        <h4 class="page-heading">{{ __('Virtual Event Bookings') }}</h4>
                        <div class="custom-card mt-4">
                                    
                                                <table id="example"
                                                    class="dataTables_wrapper dt-responsive table-striped dt-bootstrap4 w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Venue</th>
                                                            <th>Type</th>
                                                            <th>Song Title</th>
                                                            <th>Song Artist</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($bookings as $item)
                                                                <tr>
                                                                    <td>{{ $item->id }}</td>
                                                                    <td>{{ $item->venue_name }}</td>
                                                                    <td>
                                                                        @php
                                                                            if($item->name == '') {
                                                                                echo 'Single';
                                                                            } elseif(!empty($item->name)) {
                                                                                echo 'Duet';
                                                                            }
                                                                        @endphp

                                                                    </td>
                                                                    <td>{{ $item->song_title }}</td>
                                                                    <td>{!! $item->song_artist ?: '<a class="btn btn-primary" href="' . route('event-edit', $item->id) . '">Update</a>' !!}</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-success" data-id="{{ $item->id }}" onclick="getDetials(this)" data-toggle="modal" data-target=".bd-example-modal-lg">Details</button>
                                                                        
                                                                        
                                                                        @php
                                                                            $time = DB::table('singer_rating')->where(['singer_id' => $item->singer_id, 'event_id' => $item->venue, 'singer_event_id' => $item->id])->first();
                                                                            
                                                                            if ($time) {
                                                                                $currentDateTime = \Carbon\Carbon::now();
                                                                                $createdAtDateTime = \Carbon\Carbon::parse($time->created_at);
                                                                                $hoursDifference = $currentDateTime->diffInHours($createdAtDateTime);
                                                                        
                                                                                if ($hoursDifference >= 24) {
                                                                        @endphp
                                                                        
                                                                                <a href="{{ route('score', $item->id) }}" class="btn btn-primary" data-id="{{ $item->id }}" onclick="getRating(this)" data-toggle="modal" data-target=".bd-rating-modal-lg">Score</a>
                                                                        
                                                                        @php
                                                                                }
                                                                            }
                                                                        @endphp

                                                                        
                                                                        

                                                                    </td>
                                                                </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                       
                                
                    </div>
                </div>
            </div>
        </div>
        
        
     
        
    </section>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function getDetials(e) {
            var id = $(e).data("id");
            $.ajax({
                url: "{{route('get_singer_event_detail')}}",
                type: "GET",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    console.log(result)
                    $('#fname').val(result.bookings.fname);
                    $('#venue_name').val(result.bookings.venue_name);
                    $('#song_title').val(result.bookings.song_title);
                    $('#singer_name').val(result.bookings.song_artist);
                    $('#country_name').val(result.bookings.country_name);
                    $('#state_name').val(result.bookings.state_name);
                    $('#performance_date').val(result.bookings.performance_date);
                    $('#key_change').val(result.bookings.key_change);
                    $('#extra_name').val(result.bookings.name);
                    $('#extra_email').val(result.bookings.email);
                    $('#extra_phone').val(result.bookings.phone_no);
                    $('#extra_dob').val(result.bookings.dob);
                    let profile = document.querySelector('#profile');
                    profile.src = `https://app.karaokeidols.com/upload/${result.bookings.profile}`;
                    
                    
                    if (result.bookings.name == '') {
                        $("#optional_div").addClass("d-none");
                        // alert('enter')
                    } else {
                        $("#duet_div").removeClass("d-none");
                        // alert('enter1')
                    }
                    
                }
            });
        }
        
        
        function getRating(e) {
            var id = $(e).data("id");
            $.ajax({
                url: "{{route('score')}}",
                type: "GET",
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    console.log(result)
                    let vocal = 0;
                    let difficulty = 0;
                    let creativity = 0;
                    let performance = 0;
                    let comment = [];
                    let count_judge = result.ratings.length;
                    result.ratings.forEach(rating => {
                        vocal += parseInt(rating.vocal_ability)
                    });
                    result.ratings.forEach(rating => {
                        difficulty += parseInt(rating.song_difficulty)
                    });
                    result.ratings.forEach(rating => {
                        creativity += parseInt(rating.creativity_originality)
                    });
                    result.ratings.forEach(rating => {
                        performance += parseInt(rating.overall_performance)
                    });
                    result.ratings.forEach(rating => {
                        if(rating.feedback!=null){
                            comment.push(rating.feedback)
                        }
                        console.log(comment)
                    });
                    

var totalRating = parseFloat((vocal / count_judge) + (creativity / count_judge) + (performance / count_judge) + (difficulty / count_judge)).toFixed(2);

                    var rating = `<tr>
                                        <td>${(vocal / count_judge).toFixed(2)}</td>
                                        <td>${(difficulty / count_judge).toFixed(2)}</td>
                                        <td>${(creativity / count_judge).toFixed(2)}</td>
                                        <td>${(performance / count_judge).toFixed(2)}</td>
                                        <td>${totalRating}</td>
                                  </tr>`;
                    var comment_table = ""
                    comment.forEach((com,index)=>{
                        comment_table+=`<tr>
                                        <th> ${index+1}</th>
                                        <td>${com}</td>
                                  </tr>`
                    })

                    let rating_result = document.querySelector("#rating_result")
                    rating_result.innerHTML = rating
                    let feedback = document.querySelector("#feedback_div")
                    feedback_div.innerHTML = comment_table


                    
                }
            });
        }
        
    </script>
    <!--====== End Dashboard Section ======-->
@endsection
