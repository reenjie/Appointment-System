@extends('layouts.user_layout')
@section('content')
    <div class="container">

        @if (session()->has('book'))
            <script>
                swal("Appointment Booked Successfully!", "Your request is still pending, and waiting for approval.", "success");
                setInterval(() => {
                    location.reload();
                }, 2000);
            </script>
            {{ session()->forget('book') }}
        @endif
        <div class="titlebar">
            <h4 class="hf mb-3">Dashboard</h4>


        </div>

        @if (Session::has('upt'))
            <script>
                swal("Updated!", "Account updated successfully!", "success")
            </script>
        @endif

        <h5>Booking Updates:</h5>
        <div class="row">

            <div class="col-md-3">
                <a href="{{ route('user.view_pending') }}" style="text-decoration:none">
                    <div class="card shadow bg-light" style="height: 100px;border-left:10px solid rgb(99, 178, 202)">
                        <div class="card-body">
                            <h5 class="text-primary af" style="font-weight:bold">
                                Pending


                            </h5>
                            <span class=" badge bg-danger">
                                @isset($pending)
                                    {{ count($pending) }}
                                @endisset
                            </span>
                            <h1 style="position: absolute;right:10px;top:0;padding:10px">

                                <i class="fas fa-circle-minus text-secondary"></i>
                            </h1>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('user.view_approved') }}" style="text-decoration:none">
                    <div class="card shadow" style="height: 100px;border-left:10px solid rgb(81, 129, 87)">
                        <div class="card-body">
                            <h5 class="text-primary af" style="font-weight:bold">
                                Approved


                            </h5>
                            <span class="badge bg-danger">
                                @isset($approved)
                                    {{ count($approved) }}
                                @endisset
                            </span>
                            <h1 style="position: absolute;right:10px;top:0;padding:10px">

                                <i class="fas fa-check-circle text-secondary"></i>
                            </h1>

                        </div>
                    </div>
                </a>
            </div>





            <div class="col-md-3">
                <a href="{{ route('user.cancelled') }}" style="text-decoration:none">
                    <div class="card shadow" style="height: 100px;border-left:10px solid rgb(194, 63, 63)">
                        <div class="card-body">
                            <h5 class="text-primary af" style="font-weight:bold">
                                Cancelled

                            </h5>
                            <span class="badge bg-danger">
                                @isset($cancelled)
                                    {{ count($cancelled) }}
                                @endisset
                            </span>
                            <h1 style="position: absolute;right:10px;top:0;padding:10px">

                                <i class="fas fa-ban text-secondary"></i>
                            </h1>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">

                <div class="card shadow" style="height: 100px;border-left:10px solid rgb(168, 63, 194)">
                    <div class="card-body">
                        <h5 class="text-primary af" style="font-weight:bold">
                            Referred


                        </h5>
                        <span class="badge bg-danger">
                            @isset($referred)
                                {{ count($referred) }}
                            @endisset
                        </span>
                        <h1 style="position: absolute;right:10px;top:0;padding:10px">
                            <i class="fas fa-circle-arrow-right text-secondary"></i>

                        </h1>

                    </div>
                </div>

            </div>


        </div>



        <div class="row mt-5">
            <div class="col-md-8">
                @isset($clinic)
                    @foreach ($clinic as $row)
                        @php
                            $data = DB::select('select * from appointments where clinic = ' . $row->id . ' and status= 4 or  refferedto = ' . $row->id . '  ');
                        @endphp



                        @foreach ($data as $appt)
                            @if ($appt->clinic == $row->id)
                                <div class="card shadow mb-2 mt-2 border-danger">
                                    <div class="card-body">
                                        <h4 class="text-danger">You have been Referred to :</h4>
                                        <h5 class="text-primary" style="text-transform: uppercase">

                                            <span style="font-size:13px" class="text-dark">Clinic <br> From:</span>
                                            {{ $row->name }} <span style="font-size:13px" class="text-dark"> To:</span>
                                            @foreach ($clinic as $to)
                                                @if ($appt->refferedto == $to->id)
                                                    {{ $to->name }}
                                                @endif
                                            @endforeach

                                        </h5>

                                        @foreach ($doctor as $doc)
                                            @if ($doc->id == $appt->refferedto_doctor)
                                                <li class="list-group-item">
                                                    <h6 style="font-size: 14px">Referred To:</h6>
                                                    <span style="font-weight:bold" class="text-primary"> Dr.
                                                        {{ $doc->firstname . ' ' . $doc->lastname }}</span>



                                                </li>
                                            @endif
                                            @if ($doc->id == $appt->doctor)
                                                <li class="list-group-item">


                                                    <h6 style="font-size: 14px">Referred By:</h6>
                                                    <span style="font-weight:bold" class="text-info"> Dr.
                                                        {{ $doc->firstname . ' ' . $doc->lastname }}</span>
                                                    <br>
                                                    <h6 class="text-secondary mt-2" style="font-size: 13px">
                                                        Remarks :
                                                        <br>
                                                        {{ $appt->remarks }}
                                                        <br>
                                                        <span class="badge bg-warning mt-5 ">Pending</span>
                                                    </h6>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach

                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

                    <div class="card  mt-5" style="background-color: transparent">
                        <div class="card-body">
                            Inspirational Quotes
                            <h6 class="af">
                                “I believe that the greatest gift you can give your family and the world is a healthy you.” –
                                Joyce Meyer
                            </h6>
                        </div>
                    </div>
                @endisset
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="text-info">
                            All Clinics And Their Doctors
                        </h6>
                    </div>
                    <div class="card-body" style="overflow-y: scroll;height:400px">
                        <ul class="list-group list-group-flush">
                            @isset($clinic)
                                @foreach ($clinic as $item)
                                    <li class="list-group-item">
                                        <span class="hf text-secondary" style="font-weight: bold">
                                            {{ $item->name }}
                                        </span>
                                        <br>
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($doctor as $doc)
                                                        @if ($item->id == $doc->clinic)
                                                            <li class="list-group-item">
                                                                <span class="af" style="font-weight: normal;font-size:13px">
                                                                    Dr. {{ $doc->firstname . ' ' . $doc->lastname }}
                                                                </span>
                                                            </li>
                                                        @endif
                                                    @endforeach


                                                </ul>
                                            </div>
                                        </div>

                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Booking Update in Statistics"
                },
                data: [{
                    type: "pie",
                    startAngle: 240,
                    yValueFormatString: "=##0\"\"",
                    indexLabel: "{label} {y}",
                    dataPoints: [{
                            y: @isset($approved)
                                {{ count($approved) }}
                            @endisset ,
                            label: "Approved"
                        },


                        {
                            y: @isset($cancelled)
                                {{ count($cancelled) }}
                            @endisset ,
                            label: "Cancelled"
                        },
                        {
                            y: @isset($pending)
                                {{ count($pending) }}
                            @endisset ,
                            label: "Pending"
                        },

                        {
                            y: @isset($referred)
                                {{ count($referred) }}
                            @endisset ,
                            label: "Referred"
                        },
                        {
                            y: @isset($disapproved)
                                {{ count($disapproved) }}
                            @endisset ,
                            label: "Disapproved"
                        }
                    ]
                }]
            });
            chart.render();

        }
    </script>
@endsection
