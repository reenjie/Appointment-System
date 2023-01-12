@extends('layouts.admin_layout')

@section('content')



<div class="dropdown">
    <button style="float: right;margin-right:20px" class="shadow btn btn-light btn-sm mb-2 text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Appointments <i class="fas fa-list"></i>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" style="font-size: 13px" href="{{route('admin.appointment')}}">Pending</a></li>
            <li><a class="dropdown-item" style="font-size: 13px" href="{{route('admin.approved')}}">Approved</a></li>
            <li><a class="dropdown-item" style="font-size: 13px" href="{{route('admin.cancelled')}}">Cancelled</a></li>
            <li><a class="dropdown-item" style="font-size: 13px" href="{{route('admin.disapproved')}}">Disapproved</a></li>
            <li><a class="dropdown-item" style="font-size: 13px" href="{{route('admin.completed')}}">Completed</a></li>
    </ul>
  </div>
   <div class="container">
    <div class="titlebar">
        <h4 class="hf mb-3">Appointments</h4>
     
        <span class="badge bg-primary mb-2" style="text-transform:uppercase">Approved</span>
        @if(Session::get('Success'))
        
             <div class="alert alert-success alert-dismissible fade af show" role="alert">
                {{Session::get('Success')}}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
         
        
     @endif
     
    </div>
   
        <div class="container">
           <div class="row">
            <div class="col-md-5">
        <input type="text" class="form-control mb-2" id="searchkey" placeholder="Search for Trans#,Name,Email and Contact No">
            </div>
           </div>
           <div class="row">
            <div class="col-md-8">
          @if(count($data)>=1)
 @foreach ($data as $row)
                <div class="card shadow mb-2 searchfilter">
                    <div class="card-header">
                       <h6  style="font-size:12px"><span>Patient Transaction# {{$row->id}} </span></h6> 
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="af text-primary" style="font-weight: bold;font-size:17px;text-align:center">
                                    <img src="https://th.bing.com/th/id/OIP.Bt2tDCEAP7IRxzzCaVJEfwHaHa?pid=ImgDet&rs=1" alt="" class="rounded-circle" style="width: 120px">
                                    <br>
                                    @foreach ($user as $patient)
                                    @if($row->user_id == $patient->id)
                                    @php
                                        $p_id = $patient->id;
                                       
                                    @endphp
                                  {{$patient->name}}
                                <br>
                              
                                    
                               
                                <span class="text-secondary" style="font-size:13px">{{$patient->email}}</span>
                                <br>
                                <span class="text-secondary" style="font-size:13px">{{$patient->contactno}}</span>
                                    @endif
                                @endforeach
                                </h6>

                                <br>
                                <h6 style="font-weight: normal;font-size:12px" class="af mb-2">-- Diagnostics --</h6>
                                <textarea name="diagnostics" class="form-control" id="{{$row->id}}diagnostics" cols="30" rows="5"></textarea>
                                <br>
                                <h6 style="font-weight: normal;font-size:12px" class="af mb-2">Medical Certificate</h6>
                                @php
                                $attachments = DB::select('select * from attachments where appt = '.$row->id.' ');
                            @endphp
                         @if(count($attachments) == 0)

                            
<button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#fileattach{{$row->id}}" style="font-size:14px">
Attach file
</button>

<!-- Modal -->
<div class="modal fade" id="fileattach{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="exampleModalLabel"></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('admin.attachedfile')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
      
        <input type="file" name="imgfile[]" multiple required accept="image/*" data-id="{{$row->id}}" class="onUpload form-control" style="font-size:14px"/>
        <input type="hidden" value="{{$row->id}}" name="apptid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
      </div>
    </form>
    </div>
  </div>
</div>

@else
<div class="p-2">

  @foreach ($attachments as $fileitems)
  <a href="{{asset('attachments/').'/'.$fileitems->file}}" target="_blank">
    <i class="fas fa-image"></i> {{$fileitems->file}}
  </a>
  <br>
  @endforeach
 

  <button class="clearattach" data-id="{{$row->id}}" style="float: right;font-size:14px;color:rgb(204, 28, 28);outline:none;border:none"> remove</button>
</div>



@endif
                                {{--  --}}
                              
                                <br>
                               
                                <h6 style="font-weight: normal;font-size:12px" class="af">Add Treatment Data</h6>
                                <textarea name="" id="{{$row->id}}treatment" style="resize: none" class="rem form-control" id="" cols="5" rows="5" placeholder="Type Treatment here."></textarea>
                                

                            </div>
                            <div class="col-md-6">
                              <button style="text-decoration:none;font-size:13px" class="mb-2 btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#medhistory">History</button>


                              <div class="modal fade" id="medhistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <button type="button" style="float:right" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      <div class="badge mb-4 bg-success" style="font-size: 15px" id="exampleModalLabel">History</div>
                                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" style="font-size:14px" aria-selected="true">Medical</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link" style="font-size:14px" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Appointment</button>
                                        </li>
                                   
                                      </ul>
                                      <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                        <div class="container table-responsive">
                                            <table class="table table-striped table-sm " style="font-size:14px">
                                              <thead>
                                                <tr class="table-success text-secondary">
                                                <th>Date-Completed</th>
                                                <th>Diagnostics</th>
                                                <th>Treatment</th>
                                                <th>Remarks</th>
                                  
                                                <th>Doctor</th>
                                                <th>Clinic</th>
                                                </tr>
                                               
                                              </thead>
                                              <tbody>
                                                @foreach ($completeappt as $apt )
                                            
                                                @if($apt->user_id == $row->user_id)
                                                <tr style="font-size: 14px">
                                                  <td>{{date("@h:ma F j,Y",strtotime($apt->updated_at))}}</td>
                                                  <td>{{$apt->diagnostics}}</td>
                                                  <td>{{$apt->treatment}}</td>
                                                  <td>{{$apt->remarks}}</td>
                                                  <td>Dr. {{$apt->doctor}}
                                                    @foreach ($alldoctor as $dc )
                                                        @if($dc->id == $apt->doctor)
                                                        {{$dc->firstname." ".$dc->lastname}}
                                                        <br>
                                                    <span style="font-size: 11px">    {{$dc->email ." | ".$dc->contact}}</span>
                                                        @endif
                                                    @endforeach
                                                  </td>
                                                  <td>
                                                  @foreach ($allclinic as $icc)
                                                  @if($icc->id == $apt->clinic)
                                                  {{$icc->name}}
                                                  @endif
                                                      
                                                  @endforeach
                                                  </td>
                                                </tr>
                                  
                                                @endif
                                               
                                            
                                                @endforeach
                                              </tbody>
                                            </table>
                                            
                                  
                                          </div>
                                  
                                  
                              
                              
                                        </div>
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                          
                                          <div class="container">
                                            <table class="table table-striped table-sm table-bordered" style="font-size:14px">
                                              <thead>
                                                <tr class="table-warning text-secondary">
                                                <th>Date of Appointment</th>
                                                <th>Time of Appointment</th>
                                              
                                                <th>Doctor</th>
                                                <th>Clinic</th>
                                                </tr>
                                               
                                              </thead>
                                              <tbody>
                                                @foreach ($completeappt as $apt )
                                            
                                                @if($apt->user_id == $row->user_id)
                                                <tr style="font-size: 14px">
                                                 <td>{{date('F j,Y',strtotime($apt->dateofappointment))}}</td>
                                                 <td>{{date('h:i a',strtotime($apt->timeofappointment))}}</td>
                                                  <td>Dr. {{$apt->doctor}}
                                                    @foreach ($alldoctor as $dc )
                                                        @if($dc->id == $apt->doctor)
                                                        {{$dc->firstname." ".$dc->lastname}}
                                                        <br>
                                                    <span style="font-size: 11px">    {{$dc->email ." | ".$dc->contact}}</span>
                                                        @endif
                                                    @endforeach
                                                  </td>
                                                  <td>
                                                  @foreach ($allclinic as $icc)
                                                  @if($icc->id == $apt->clinic)
                                                  {{$icc->name}}
                                                  @endif
                                                      
                                                  @endforeach
                                                  </td>
                                                </tr>
                                  
                                                @endif
                                               
                                            
                                                @endforeach
                                              </tbody>
                                            </table>
                                            
                                  
                                          </div>
                                  
                              
                                        </div>
                                     
                                      </div>
                              
                              
                                  
                                    </div>
                                 
                                  </div>
                                </div>
                              </div>
                                <h6 class="af">
                                    Details 
                                    <hr>
                                   <span style="font-size:14px"> Appointment Date </span> : <span class="text-danger">{{date('F j,Y',strtotime($row->dateofappointment))}}</span>
                                   <br>
                                   <span style="font-size:14px"> Time </span> : <span class="text-danger">{{date('h:i a',strtotime($row->timeofappointment))}}</span>
                                    <br><br>
                                    <span style="font-size:14px"> Doctor </span> : <br>
                                    @foreach ($Doctor as $doc)
                                        
                                    @if($doc->id == $row->doctor)
                                    @php
                                        $doctorname = $doc->firstname.' '.$doc->lastname;
                                    @endphp
                                    <span class="text-primary">Dr. {{$doc->firstname.' '.$doc->lastname}}</span> 
                                    @if($doc->isavailable == 1)
                                    <span style="font-size:11px" class="text-danger">(Unavailable)</span>
                                    @endif
                                    <br>
                                    <span class="text-secondary" style="font-size:14px" >
                                      {{$doc->email}}
                                        <br>
                                       {{$doc->contact}}
                                    </span>

                                    @endif
                                    @endforeach
                                </h6>
                                <hr>
                             {{--    @foreach ($Doctor as $docs)
                                @if($docs->id == $row->doctor)
                          
                                @if($docs->isavailable == 0)
                                <button data-id="{{$row->id}}" data-doc = "{{$doctorname}}" class="btnapprove btn btn-primary btn-sm">Approve</button>

                                @else 
                                <button  class="btncannot btn btn-primary btn-sm">Approve</button>
                                @endif
                                @endif
                                @endforeach
                             
                             

                                <button data-id="{{$row->id}}" class="btncancel btn btn-danger btn-sm">Disapprove</button>
 --}}
                                <textarea name="" id="{{$row->id}}remarks" style="resize: none" class="rem form-control" id="" cols="5" rows="5" placeholder="Type Remarks here."></textarea>
                                <div class="invalid-feedback">
                                    <span style="font-size:12px">Please Provide Remarks *</span>
                                </div>
                                <div class="">
                                    <button data-id="{{$row->id}}" class="btndone mt-2 btn btn-primary btn-sm af">Mark as Done</button>

                                    <button data-id="{{$row->id}}" data-pid="{{$p_id}}" style=" font-weight: bold" class="btnrefer mt-2 btn btn-light text-danger btn-sm af">REFER</button>
                                </div>
                             
                            </div>
                        </div>
                       
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
                @endforeach 
                @else 
                <h6 style="text-align: center" class="af">
                    <img src="https://image.freepik.com/free-vector/no-data-concept-illustration_114360-626.jpg" class="img-fluid" alt="">
                    <br>
                    No Appointment yet..
                </h6> 
                @endif


                {{-- --}}
              

            </div>
            <div class="col-md-4">
              {{--   <h6 class="hf">Doctors</h6>
                <hr>
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
                
                {{--  </div>
                  <hr> --}}
            </div>
           </div>
        </div>
   
   </div>
   <script>
$('.clearattach').click(function(){
  var id = $(this).data('id');
  swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this image file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.location.href="{{route('admin.removeAttachment')}}"+'?id='+id;
  } 
});


})

 $('#searchkey').keyup(function(){
      var val = $(this).val();

    $(".searchfilter").filter(function() {
   $(this).toggle($(this).find('h6').text().toLowerCase().indexOf(val) > -1)
            
    });   

   
 })
 $('.rem').keyup(function(){
    $(this).removeClass('is-invalid');
 })
 $('.btndone').click(function(){
        var id = $(this).data('id');
        var val = $('#'+id+'remarks').val();
        var treat = $('#'+id+'treatment').val();
        var diagnostics = $('#'+id+'diagnostics').val();
       if(val == '' && treat == ''){
        $('#'+id+'remarks').addClass('is-invalid');
        $('#'+id+'treatment').addClass('is-invalid');
       }else if(treat == '') {
        $('#'+id+'treatment').addClass('is-invalid');
       }else if(val == '') {
        $('#'+id+'remarks').addClass('is-invalid');
       }else{
        window.location.href='{{route("home.complete_booking")}}'+'?id='+id+'&remarks='+val+'&treatment='+treat+'&diagnostics='+diagnostics;
       }
    })

    $('.btnrefer').click(function(){
        var id = $(this).data('id');
        var pid = $(this).data('pid');
        var val = $('#'+id+'remarks').val();
       if(val == ''){
        $('#'+id+'remarks').addClass('is-invalid');
       }else {
        window.location.href='{{route("admin.refer")}}'+'?id='+id+'&remarks='+val+'&patientId='+pid;
       }
    })
</script>
@endsection