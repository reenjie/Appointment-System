@extends('layouts.superadmin_layout')
@section('content')
    <div class="container">

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session()->get('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    @endif

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
                            Visitors
                             
                             
                         </h5>
                        <span class="badge bg-danger">5</span>
                        <h1 style="position: absolute;right:10px;top:0;padding:10px">
                            <i class="fas fa-users text-secondary"></i>
                        </h1>

                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card shadow bg-light" style="height: 100px;border-left:10px solid rgb(73, 133, 86)" >
                    <div class="card-body">
                        <h5 class="text-primary af" style="font-weight:bold" >
                           Clinics
                            
                            
                        </h5>
                        <span class=" badge bg-danger">{{count($Clinic)}}</span>
                        <h1 style="position: absolute;right:10px;top:0;padding:10px">
                            
                            <i class="fas fa-house-chimney-medical text-secondary"></i>
                        </h1>

                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card shadow" style="height: 100px;border-left:10px solid rgb(63, 116, 194)">
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
                <div class="card shadow" style="height: 100px;border-left:10px solid rgb(194, 63, 96)">
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
            
         
        </div>

        <div class="row mt-4">
            
            <div class="col-md-8">
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


                  <br>
                  <!-- Button trigger modal -->
<button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="font-weight:bold">
 Manage Letter of Agreement Content <i class="fas fa-cogs"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="staticBackdropLabel">Letter of Agreement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('updateagreement')}}" method="post">
        @csrf
      <div class="modal-body">
      @php
       $agree = DB::select('SELECT * FROM `agreements`');
       @endphp
      <p>
         @foreach($agree as $item)
                               
        <textarea name="content" required style="width:100%;height:auto;outline:none;border:none;background-color:#edf6fa;"  id="" cols="30" rows="10">{{$item->content}}</textarea>
            @endforeach
       </p>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light text-danger btn-sm" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-light text-primary btn-sm">Update <i class="fas fa-edit"></i></button>
      </div>
      </form>
    </div>
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
                text: "Clinics and Appointments"
            },
            axisY: {
                title: "Appointment Bookings"
            },
            data: [{        
                type: "column",  
                showInLegend: true, 
                legendMarkerColor: "grey",
                legendText: "Clinics",
                dataPoints: [      
                 
                    @foreach ($Clinic as $row)
                   
         

                 @php
            $count = DB::select('select * from appointments where clinic ='.$row->id.' ');
                 @endphp
        
        { y: {{count($count)}}, label: " {{$row->name}}" },
                @endforeach

                ]
            }]
        });
        chart.render();
        
        }
        </script>
@endsection