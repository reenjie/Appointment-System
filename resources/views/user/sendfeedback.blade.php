@extends('layouts.user_layout')
@section('content')
    <div class="container">
            <div class="titlebar">
                        <h4 class="hf mb-3">Send Feedback</h4>         
                    </div>
     
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                            <div class="card-body">
                        <div class="container">
                                    <form action="{{route('add.sendfeedback')}}" method="post">
                                                @csrf
                                  
                         <h6 class="af" style="font-size:14px">Message:</h6>
                      <textarea name="message" class="form-control" style="font-size:13px;resize:none" placeholder="Type your message here.." id="message" cols="30" rows="10"></textarea>
                      <div class="invalid-feedback">
                        <span style="font-size:12px">Please provide your message.</span>
                      </div>
                      <br>
                      <button  type="button" id="sendmessage" style="float: right" class="btn btn-light btn-sm text-success">Send <i class="fas fa-paper-plane"></i></button>

 
          
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
            
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <h6 class="hf">Select Receiver <br>
                                    <span class="text-secondary af" style="font-size:12px;" >Clinics you have requested with appointments</span>
                        </h6>
                      
            <ul class="list-group list-group-flush">
                        @foreach ($clinics as $item)
                        <li class="list-group-item"><span class="text-primary" style="font-weight: bold">{{$item->name}}</span>  <span style="float:right" style="font-size:13px"><button type="submit" class="btn btn-light text-primary btn0-sm" name="selected" value="{{$item->id}}">Select</button></span></li>
                        @endforeach
         
            </ul>
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>

</form>
                        </div>
                         </div>
                            </div>

                                    
                        </div>

                        <div class="col-md-6">
                           <h6 class="af">My Feedbacks</h6>

                           @if(count($data)>=1)
                           @foreach ($data as $row)
                             <div class="card shadow mb-2">
                                
                                 <div class="card-body">
             
                                     <div class="row">
                                         <div class="col-md-4">
                                              
                                                @foreach ($cl as $item)
                                                  @if($item->id == $row->clinic)
                                                     <span class=" text-primary" style="font-weight:bold">
                                                            {{$item->name}}
                                                </span>      
                                                  @endif
                                                @endforeach
                                           {{--   @foreach ($user as $item)
                                           
                                                 @if($item->id == $row->user_id)
                                                 
                                                 <h6 class="af text-primary" style="font-weight: bold;font-size:17px;text-align:center">
                                                     <img src="https://th.bing.com/th/id/OIP.Bt2tDCEAP7IRxzzCaVJEfwHaHa?pid=ImgDet&rs=1" alt="" class="rounded-circle" style="width: 120px">
                                                     <br>
                                                    {{$item->name}}
                                                 <br>
                                                 <span class="text-secondary" style="font-size:13px">{{$item->email}}</span>
                                                 <br>
                                                 <span class="text-secondary" style="font-size:13px">{{$item->contact}}</span>
                                                 </h6>
                                                 @endif
                                             @endforeach --}}
                                           
             
                                         </div>
                                         <div class="col-md-8">
                                             <div class="container">
                                                 <h6 class="af mt-2" style="font-size:14px">
                                                  {{$row->message}}
                                               
                                                 </h6>
                                                 <br>
                                                
         
                                                 <button  style="position: absolute;right:20px;bottom:10px" data-id ="{{$row->id}}" class="btndelete btn btn-light text-secondary btn-sm" style="font-size:13px"><i  class="fas fa-trash-can"></i></button>
                                             </div>
                                             
                                            
             
                                         </div>
                                     </div>
                                    
                                 </div>
                                 
                             </div> 
         
         
                             @endforeach 
                             @else 
                             <h6 style="text-align: center" class="af">
                                 <img src="https://luansteflideas.files.wordpress.com/2011/12/feedback.jpg" class="img-fluid" alt="">
                                 <br>
                                 No Feedbacks yet..
                             </h6>
                             @endif
                        </div>
                    </div>
    </div>

    @if(Session::get('Success'))
    <script>
        swal("Deleted Successfully!", "", "info");
     </script>
      
      @elseif(Session::get('Sent'))
      <script>
            swal("Thanks for Sending Feedback!", "Your Message has been Sent Successfully", "success");
      </script>
    @endif

    <script>
            $('#sendmessage').click(function(){
                  var val = $('#message').val();
                if(val == ''){
                        $('#message').addClass('is-invalid');
                }else {
                   $('#exampleModal').modal('show');     
                }
            })
            $('#message').keyup(function(){
                        $('#message').removeClass('is-invalid');
            })


            $('.btndelete').click(function(){
        var id =$(this).data('id');
       
        swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $(this).html('<span class="text-secondary" style="font-size:11px">Deleting..</span>');
    window.location.href='{{route("delete.delete_feedback")}}'+'?id='+id;
  } else {
  
  }
});
    })
           
    </script>

@endsection