@extends('layouts.admin_layout')
@section('content')
    <div class="container" style="background: url(https://img.freepik.com/free-vector/medical-science-healthcare-blue-banner_1017-23667.jpg?w=900&t=st=1660978750~exp=1660979350~hmac=4045ef40e2b6bb31cd3d7bdd34deb90c9cf66d9b3911f4b9a933889e52c77820); background-position:right;background-repeat:no-repeat;background-attachment:fixed">
        <div class="titlebar">
            <h4 class="hf mb-3">Dashboard</h4>
            

        </div>
        @if(Session::has('upt'))
        <script>
            swal ( "Updated!" ,  "Account updated successfully!" ,  "success" )
        </script>
        @endif

        <div class="row">
            <div class="col-md-3">
                <div class="card shadow" style="height: 100px;border-left:10px solid rgb(121, 146, 179)">
                    <div class="card-body">
                        <h5 class="text-primary af" style="font-weight:bold" >
                           Doctors
                             
                             
                         </h5>
                        <span class="badge bg-danger">{{count($Doctor)}}</span>
                        <h1 style="position: absolute;right:10px;top:0;padding:10px">
                           
                            <i class="fas fa-user-doctor text-secondary"></i>
                        </h1>

                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card shadow bg-light" style="height: 100px;border-left:10px solid rgb(73, 133, 86)" >
                    <div class="card-body">
                        <h5 class="text-primary af" style="font-weight:bold" >
                           Categories
                            
                            
                        </h5>
                        <span class=" badge bg-danger">{{count($category)}}</span>
                        <h1 style="position: absolute;right:10px;top:0;padding:10px">
                            
                            <i class="fas fa-list text-secondary"></i>
                        </h1>

                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card shadow" style="height: 100px;border-left:10px solid rgb(63, 116, 194)">
                    <div class="card-body">
                        <h5 class="text-primary af" style="font-weight:bold" >
                          Patients
                             
                         </h5>
                        <span class="badge bg-danger">{{count($Patients)}}</span>
                        <h1 style="position: absolute;right:10px;top:0;padding:10px">
                            
                            <i class="fas fa-bed text-secondary"></i>
                        </h1>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow" style="height: 100px;border-left:10px solid rgb(194, 63, 96)">
                    <div class="card-body">
                        <h5 class="text-primary af" style="font-weight:bold" >
                          Feedbacks
                             
                             
                         </h5>
                        <span class="badge bg-danger">{{count($feedback)}}</span>
                        <h1 style="position: absolute;right:10px;top:0;padding:10px">
                            <i class="fas fa-message text-secondary"></i>
                           
                        </h1>

                    </div>
                </div>
            </div>
            
         
        </div>

        <div class="row mt-4">
            
            <div class="col-md-8">
                @if(count($refer)>=1)
                <div class="card shadow border-danger mb-2 bg-danger">
                   
                    <div class="card-body">
                        <h5 class="hf text-light style="text-align: center">{{count($refer)}} New Referral! </h5>
                        <br>
                        <a href="{{route('admin.referral')}}" class="btn btn-light btn-sm">View All</a>
                    </div>
                </div>
                    
                @endif
              

                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

       
            </div>

            <div class="col-md-4">
                <h5 class="hf">All Doctors</h5>
                <div class="list-group">
                    @foreach ($Doctor as $doc)
                    @if($doc->isavailable == 0)
                    <a href="#" class="list-group-item list-group-item-action list-group-item-primary af">
                        Dr . {{$doc->firstname.' '.$doc->lastname}}
                        
                        <span class="badge text-bg-primary" style="float: right">Available</span>

                    </a>
                        @else
                        <a href="#" class="list-group-item list-group-item-action list-group-item-danger">
                            Dr . {{$doc->firstname.' '.$doc->lastname}}
                            <span class="badge text-bg-danger" style="float: right">Unavailable</span>
        
                        </a>
                        @endif
                    @endforeach
                   {{--  <a href="#" class="list-group-item list-group-item-action list-group-item-primary af">
                        Doc . WIllie Ong

                        <span class="badge text-bg-primary" style="float: right">Available</span>

                    </a>
                
                    --}}
                
                  </div>

                  <div class="card mt-2">
                    <div class="card-body">
                        Total Number of Appointments: <span class="text-secondary" style="font-weight: bold">{{count($Appointment)}}</span>
                    </div>
                  </div>

                  <div class="card shadow mt-2">
                    <div class="card-header">
                        <h6 class="text-primary">
                            New Appointments
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($data as $row)
                            <li class="list-group-item">

                                <span style="font-size:12px">Patient Transaction# {{$row->id}}</span>
                                <br>
                                @foreach ($user as $patient)
                                @if($row->user_id == $patient->id)
                                {{$patient->name}}
                            <br>
                          
                                
                           
                            <span class="text-secondary" style="font-size:13px">{{$patient->email}}</span>
                            <br>
                            <span class="text-secondary" style="font-size:13px">{{$patient->contactno}}</span>
                                @endif
                            @endforeach
                            </li>
                            @endforeach
                          
                           
                          </ul>
                          <a href="{{route('admin.appointment')}}" class=" mt-2 btn btn-link btn-sm">View all</a>
                    </div>
                  </div>

            </div>
        </div>


    </div>
  
     

    <script>
        window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Doctors and Appointments"
            },
            axisY: {
                title: "Appointment Bookings"
            },
            data: [{        
                type: "column",  
                showInLegend: true, 
                legendMarkerColor: "grey",
                legendText: "Doctors",
                dataPoints: [      
                 
                    @foreach ($Doctor as $row)
                   
         

                 @php
            $count = DB::select('select * from appointments where doctor ='.$row->id.' ');
                 @endphp
        
        { y: {{count($count)}}, label: "Dr. {{$row->firstname.' '.$row->lastname}}" },
                @endforeach

                ]
            }]
        });
        chart.render();
        
        }
        </script>
@endsection