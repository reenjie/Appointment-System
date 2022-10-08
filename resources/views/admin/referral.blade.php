@extends('layouts.admin_layout')

@section('content')
   <div class="container">
    <div class="titlebar">
        <h4 class="hf mb-3">Referral Station</h4>
        
    </div>
   
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              @if(Session::get('Success'))
              <div class="row">
           
               <div class="col-md-12">
                   <div class="alert alert-success alert-dismissible fade af show" role="alert">
                      {{Session::get('Success')}}
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
               </div>
              </div>
              
           @endif
              @if(count($referred)>=1)
              @foreach ($referred as $referals)
               

              
                    <h5 class="text-primary" style="text-transform: uppercase">
                    <span style="font-size:13px" class="text-dark">  Clinic:</span>  {{$referals->name}} 
                    </h5>
               
               


                    <ul class="list-group list-group-flush">

                    @foreach ($data as $appt)
                  
                      @if($appt->clinic == $referals->id)
                      <div class="card shadow mb-2">
                        <div class="card-body">
                      
                      @foreach ($doctor as $doc)
                      @if($doc->id == $appt->refferedto_doctor)
                      <li class="list-group-item">
                      <h6 style="font-size: 14px">Referred To:</h6>
                      <span style="font-weight:bold" class="text-primary">     Dr.  {{$doc->firstname.' '.$doc->lastname}}</span>

                    
                      <button data-id="{{$appt->id}}" data-ref ="{{$appt->refferedto_doctor}}" data-patient="{{$appt->user_id}}" class="btnaccept btn btn-primary btn-sm" style="float: right">Accept</button>
                    </li>
                        @endif
                      @if($doc->id == $appt->doctor)
                     
                      <li class="list-group-item">
                  
                       
                          <h6 style="font-size: 14px">Referred By:</h6>
                      <span style="font-weight:bold" class="text-info">  Dr.  {{$doc->firstname.' '.$doc->lastname}}</span>
                          <br >

                          
                        <h6 style="font-size: 14px">Patient Details:</h6>
                          @foreach ($user as $item)
                          @if($appt->user_id == $item->id)
                          {{$item->name}} ( <span style="font-size:13px">{{$item->email}} </span> )
                          <br>
                         <i class="fas fa-phone"></i>   {{$item->contactno}}
                          <br>
                          <h6 class="mt-3" style="font-size: 12px">REMARKS:</h6>
                          <span class="text-danger">{{$appt->remarks}}</span>
                          <br>
                        </li>
                          
                          @endif
                          
                          @endforeach

                       
                     

                         @endif

                       

                         
                          
                        
                       

                      @endforeach
                    </div>
                  </div>
                      @endif
                   
                    @endforeach

                          
                     </ul>
                   
               

              @endforeach
              @else 
              <h6 style="text-align: center" class="af">
                <img src="https://image.freepik.com/free-vector/no-data-concept-illustration_114360-626.jpg" class="img-fluid" alt="">
                <br>
                No Referrals yet..
            </h6>
              @endif
            </div>
            <div class="col-md-5">
              <h5 class="hf">Approved Appointments</h5>
              <hr>
              @if(count($appr_appointments)>=1)
              @foreach ($appr_appointments as $row)
                @foreach ($user as $patient)
                  @if($patient->id == $row->user_id)
            
                  <div class="card shadow mb-2">
                    <div class="card-body">

                      <button style="float:right;text-decoration:none;font-size:13px" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#medhistory">Referral History</button>


                      <div class="modal fade" id="medhistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-body">
                              <button type="button" style="float:right" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="badge mb-4 bg-primary" style="font-size: 15px" id="exampleModalLabel">Referral History</div>
                              <div class="container">
                                <table class="table table-striped table-sm ">
                                  <thead>
                                    <tr class="table-primary text-secondary">
                                    <th>Date-Referred</th>
                                    <th>From</th>
                                    <th>To</th>
                                   
                      
                                    <th>Remarks</th>
                                
                                    </tr>
                                   
                                  </thead>
                                  <tbody>
                               @foreach ($refhistory as $hist )
                                
                                    @if($hist->user_id == $row->user_id)
                                    <tr style="font-size: 14px" >
                                      <td>{{date("@h:ia F j,Y",strtotime($hist->created_at))}}</td>
                                      <td style="font-style: italic" class="text-secondary">
                                        Clinic : <br> 
                                       <span class="text-dark" style="font-style:normal">
                                        @foreach ($clinic as $item1)
                                        @if($item1->id == $hist->from)
                                          {{$item1->name}}
                                        @endif
                                      @endforeach
                                       </span>
                                        <br>
                                       Referredby : <br>  
                                       <span class="text-dark" style="font-style: normal">
                                        Dr.
                                        @foreach ($doctor as $item1)
                                        @if($item1->id == $hist->fromdoctor)
                                          {{$item1->firstname." ".$item1->lastname}}
                                        @endif
                                      @endforeach</span>
                                      </td>
                                      <td style="font-style: italic" class="text-secondary">
                                        Clinic : <br> 
                                       <span class="text-dark" style="font-style:normal">
                                        @foreach ($clinic as $item1)
                                        @if($item1->id == $hist->to)
                                          {{$item1->name}}
                                        @endif
                                      @endforeach
                                       </span>
                                        <br>
                                       Referredby : <br>  
                                       <span class="text-dark" style="font-style: normal">
                                        Dr.
                                        @foreach ($doctor as $item1)
                                        @if($item1->id == $hist->todoctor)
                                          {{$item1->firstname." ".$item1->lastname}}
                                        @endif
                                      @endforeach</span>
                                      </td>
                                      <td> {{$hist->remarks}}
                                      
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
                        
                <h6 class="af" style="font-weight:bold">{{$patient->name}}</h6>  ( <span style="font-size:13px">{{$patient->email}} </span> )
                  <br>
                 <i class="fas fa-phone"></i>   {{$patient->contactno}}
                  <br>
                  <button onclick="window.location.href='{{route('admin.approved')}}' " class="btn btn-light text-primary btn-sm">View Booking</button>
                  <button  data-id="{{$row->id}}" data-pid="{{$patient->id}}" class="btn btn-light text-danger btn-sm btnrefer" style="font-weight: bold;float:right" >REFER</button>
                
                    </div>
                  </div>
                

                  @endif
                @endforeach
             

            
          @endforeach
          @else 
                  
          <h6 style="text-align: center;" class="af">
            No Appointment Found.
          </h6>
          @endif
               
            </div>
          </div>


        </div>
   
   </div>

<script>
  $('.btnaccept').click(function(){
    var id = $(this).data('id');
    var ref = $(this).data('ref');
    var patient = $(this).data('patient');
    
    swal({
  title: "Are you sure?",
  text: "You will have to set the appointment. Proceed?",
  icon: "warning",
  buttons: true,
  dangerMode: false,
})
.then((willDelete) => {
  if (willDelete) {
    window.location.href='{{route("admin.accept_referral")}}'+'?id='+id+'&ref='+ref+'&patient='+patient;
  } else {
  
  }
});

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