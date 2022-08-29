@extends('layouts.admin_layout')

@section('content')
   <div class="container">
    <div class="titlebar">
        <h4 class="hf mb-3">Feedbacks</h4>
        
    </div>
   
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    @if(Session::get('Success'))
                    <div class="row">
                     <div class="col-md-8"></div>
                     <div class="col-md-6">
                         <div class="alert alert-success alert-dismissible fade af show" role="alert">
                            {{Session::get('Success')}}
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>
                     </div>
                    </div>
                    
                 @endif
                @if(count($data)>=1)
                  @foreach ($data as $row)
                    <div class="card shadow mb-2">
                       
                        <div class="card-body">
    
                            <div class="row">
                                <div class="col-md-4">
                                    @foreach ($user as $item)
                                  
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
                                    @endforeach
                                  
    
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
                <div class="col-md-2"></div>
            </div>

        </div>
   
   </div>

   <script>
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