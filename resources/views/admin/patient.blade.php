@extends('layouts.admin_layout')

@section('content')
   <div class="container">
    <div class="titlebar">
        <h4 class="hf mb-3">Patients</h4>
        
    </div>
   
        <div class="container">
            
          <div class="card">
            <div class="card-body">
                <div class="container">
               <div class="table-responsive">
                <table class="table table-hover table-sm  af" style="font-size:14px;border-radius:13px" id="myTable">
                    <thead>
                      <tr class="table-info">
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                       
                   {{--      <th scope="col" colspan="5">Appointment-Details</th> --}}
                   <th scope="col">Email & Contact#</th>
                   <th scope="col">No of Appointments</th>
                        <th scope="col">Date-Created</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                          
                      <tr>
                        <td scope="row">
                            <h6 style="text-align: center">
                            <img src="https://th.bing.com/th/id/OIP.1yoSL-WO0YU5mQKROudvswHaHa?pid=ImgDet&rs=1" class="rounded-circle" style="width: 80px;height:80px" alt="">
                        </h6>
                        </td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}
                            <br>
                            #{{$row->contactno}}
                        </td>
                        <td>
                          @php
                              $count = 0;
                          @endphp
                          @foreach ($appt as $item)
                              @if($item->user_id == $row->id)
                         @php
                             $count ++;
                         @endphp
                              @endif
                          @endforeach
                          {{$count}}
                        </td>
                     {{--    <td colspan="5">
                            <div class="card">
                                <div class="card-body">
                                  
                                    <h6 style="font-size:12px" class="af">
                                    Date :  <span style="font-weight: bold" class="text-danger">{{date('F j,Y')}}</span>

                                    <br>
                                    Time : <span style="font-weight: bold" class="text-danger">{{date('h:i a')}}</span>
                                    <br>
                                    <hr>
                                

                                    Type : 
                                    <span  style="" class="text-primary">Custom Appointment</span>
                                    </h6>
                                    <button data-bs-toggle="modal" data-bs-target="#apptdetails{{$i}}" class="btn btn-light text-primary btn-sm" style="font-size:13px">View More</button>


            <div class="modal fade" id="apptdetails{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                <div class="modal-content">
                   
                  
                    <div class="modal-body">    
                        <button type="button" style="float: right" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <br><br>
                        <h5 class="hf">Appointment-Details</h5>
                        <h6 style="font-size:13px" class="af">
                         <span style="float: right">   Date :  <span style="font-weight: bold" class="text-danger">{{date('F j,Y')}}</span>

                            <br>
                            Time : <span style="font-weight: bold" class="text-danger">{{date('h:i a')}}</span>
                        </span>
                            <br><br><br>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Type : 
                                    <span  style="font-weight: bold;font-size:15px;" class="text-primary mb-2">Dentistry</span> <br><br>
        
                                 
                                    Appointment-Type : <span class="text-primary">Custom</span><br>
                                   Status : <span class="text-danger">Pending</span>
                                </li>
                                <li class="list-group-item">
                                    Doctor : 
                                    <span  style="font-weight: bold;font-size:15px;" class="text-primary mb-2">Dr. Ong</span> <br><br>
        
                                    Details :
                                    <br>
                                    Contact # : <span class="text-primary">09557653775</span><br>
                                    Email : <span class="text-primary">Ong@gmail.com</span>
                                </li>
                              
                              </ul>

                           
                          

                            <br><br>
                            <h6 style="font-size:12px;text-align:center"></h6>
                            Type : 
                            <span  style="" class="text-primary">Custom Appointment</span>
                            <br>
                            Status : <span class="text-danger af">Pending</span> 
                        </h6>
                    </div>
                    <div class="modal-footer bg-light" ></div>
                 
                </div>
                </div>
            </div>
                                </div>
                            </div>

                        </td> --}}
                        <td>{{date('F j,Y',strtotime($row->created_at))}}</td>
                       
                      </tr>
                      
                      @endforeach
                    </tbody>
                  </table>    
               </div>
            </div>
            </div>
          </div>

        </div>
   
   </div>


@endsection