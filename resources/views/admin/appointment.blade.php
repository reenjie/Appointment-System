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
     
        <span style="font-size:12px;cursor: default;">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item text-primary">Pending</li>
                  <li class="breadcrumb-item active" aria-current="page">Approved</li>
                  <li class="breadcrumb-item active" aria-current="page">Cancelled</li>
                  <li class="breadcrumb-item active" aria-current="page">Disapproved</li>
                  <li class="breadcrumb-item active" aria-current="page">Completed</li>
                </ol>
              </nav>
        </span>
        @if(Session::get('Success'))
        
             <div class="alert alert-success alert-dismissible fade af show" role="alert">
                {{Session::get('Success')}}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
         
        
     @endif
     
    </div>
   
        <div class="container">
           <div class="row">
            <div class="col-md-8">
          @if(count($data)>=1)
 @foreach ($data as $row)
                <div class="card shadow mb-2">
                    <div class="card-header">
                        <span style="font-size:12px">Patient Transaction# {{$row->id}}</span>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="af text-primary" style="font-weight: bold;font-size:17px;text-align:center">
                                    <img src="https://th.bing.com/th/id/OIP.Bt2tDCEAP7IRxzzCaVJEfwHaHa?pid=ImgDet&rs=1" alt="" class="rounded-circle" style="width: 120px">
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
                                </h6>

                            </div>
                            <div class="col-md-6">
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
                                @foreach ($Doctor as $docs)
                                @if($docs->id == $row->doctor)
                          
                                @if($docs->isavailable == 0)
                                <button data-id="{{$row->id}}" data-doc = "{{$doctorname}}" class="btnapprove btn btn-primary btn-sm">Approve</button>

                                @else 
                                <button  class="btncannot btn btn-primary btn-sm">Approve</button>
                                @endif
                                @endif
                                @endforeach
                             
                             

                                <button data-id="{{$row->id}}" class="btncancel btn btn-danger btn-sm">Disapprove</button>

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
                <h6 class="hf">Doctors</h6>
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
                
                  </div>
                  <hr>
            </div>
           </div>
        </div>
   
   </div>
   <script>
   $('.btnapprove').click(function(){
        var id =$(this).data('id');
        var doc = $(this).data('doc');
             
        swal({
  title: "Are you sure to Approved this Booking? ",
  text: "Please make sure that Dr. "+doc+" is Available, before proceeding..",
  icon: "warning",
  buttons: true,
  dangerMode: false,
})
.then((willDelete) => {
  if (willDelete) {
    $(this).removeClass('btn-primary').addClass('btn-light').html('<span class="text-primary" style="font-size:12px">Approving..</span>'); 
   window.location.href='{{route("home.approve_booking")}}'+'?id='+id;
  } else {
  
  }
});
    })

    $('.btncannot').click(function(){
        swal({
            title:"Doctor Unavailable!",
            text: "Disapproved Appointment or wait for the Doctors availability",
            dangerMode: true,
            });
    })
    $('.btncancel').click(function(){
        var id =$(this).data('id');

        swal("Please Write a Remarks:", {
  content: "input",
  icon: "warning",
  dangerMode: true,
})
.then((value) => {
 if(value == ''){
    swal({
  title: "Remarks Required!",
  text: "Please provide a Remarks to inform the patient.",
  icon: "error",
  button: "Close",
  dangerMode: true,
});
 }else {
    $(this).removeClass('btn-primary').addClass('btn-light').html('<span class="text-danger" style="font-size:12px">Disapproving..</span>'); 
   window.location.href='{{route("home.disapprove_booking")}}'+'?id='+id+'&remarks='+value;
 }
});
       
     /*    swal({
  title: "Are you sure to Disapproved this Booking? ",
  text: "Patient can still resend the request after 1 day of disapproval",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $(this).removeClass('btn-primary').addClass('btn-light').html('<span class="text-danger" style="font-size:12px">Disapproving..</span>'); 
   window.location.href='{{route("home.disapprove_booking")}}'+'?id='+id;
  } else {
  
  }
}); */
    })
</script>
@endsection