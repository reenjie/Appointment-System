@extends('layouts.admin_layout')

@section('content')
    <div class="container">
        <div class="titlebar">
            <h4 class="hf mb-3">Refer</h4>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h6 class="hf">Referral For :</h6>
                        <hr>
                        <span style="font-size:11px">Patient:</span>
                        @foreach ($userpatient as $user)
                        @php
                            $userid = $user->id;
                        @endphp
                            <h6 class="af" style="font-weight:bold"><span class="text-primary">{{$user->name}}</span>
                                    <br>
                                    <span style="font-size:12px">{{$user->email}}</span>
                                    <br>
                                    <span style="font-size:12px"><i class="fas fa-phone"></i>{{$user->contactno}}</span>
                        </h6>
                        @endforeach
                        
                     
                       
                        @php
                                $attachments = DB::select('select * from attachments where appt = '.$id.' ');
                            @endphp
                         @if(count($attachments) == 0)

                            
<button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#fileattach{{$id}}" style="font-size:14px">
Attach file
</button>

<!-- Modal -->
<div class="modal fade" id="fileattach{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="exampleModalLabel"></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('admin.attachedfile')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
      
        <input type="file" name="imgfile[]" multiple required accept="image/*" data-id="{{$id}}" class="onUpload form-control" style="font-size:14px"/>
        <input type="hidden" value="{{$id}}" name="apptid">
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
 

  <button class="clearattach" data-id="{{$id}}" style="float: right;font-size:14px;color:rgb(204, 28, 28);outline:none;border:none"> remove</button>
</div>



@endif
                        <h6 class="af" style="font-size:13px">Remarks:</h6>
                        <input type="hidden" name="id" value="{{ $id }}">
                        <textarea name="" class="rem form-control" id="{{$id}}remarks" cols="4" rows="4" style="resize: none">@if($remarks=='')@else {{ $remarks }}@endif</textarea>
                        <div class="invalid-feedback">
                                    <span class="text-danger" style="font-size:12px">Please Provide Remarks *</span>
                        </div>

                        <br>
                        <input type="checkbox" id="agreement" style="width:18px;height:18px"> <a target="_blank" href="{{route('agreement')}}">Accept the letter of agreement</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="container">
                                    <h6 class="hf">Refer to :</h6>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm af" style="font-size: 14px" id="myTable">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col">Name</th>
                                            <th scope="col">Specialties</th>
                                            <th scope="col">Clinic</th>
                                            <th scope="col">Email & Contact No</th>
                                          {{--   <th scope="col">Date-added</th> --}}
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                            <tr>
                                                <td style="font-weight: bold">Dr. {{ $row->firstname . ' ' . $row->lastname }}</td>
                                                <td>

                                                 @foreach ($category as $item)
                                                        @if ($item->id == $row->category)
                                                            {{ $item->name }}
                                                        @endif
                                                    @endforeach 
                                                </td>
                                                <td>
                                                @foreach ($clinic as $item)
                                                @if ($item->id == $row->clinic)
                                                {{ $item->name }}
                                                @php
                                                    $cl = $item->id;
                                                @endphp
                                                  @endif
                                                @endforeach
                                                </td>
                                                <td>
                                                    {{ $row->email }}
                                                    <br>
                                                    #{{ $row->contact }}
                                                </td>

                                               {{--  <td>{{ Date('h:ia F j,Y', strtotime($row->created_at)) }}</td> --}}

                                                <td>
                                                    <div  class="btn-group">
                                                     <button data-clinic="{{$cl}}" data-id="{{$row->id}}" data-appt="{{$id}}"  class="btnselect btn btn-light text-primary btn-sm">Select </button>
                                                    </div>
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

            $('.btnselect').click(function(){
            var doctorid=  $(this).data('id');
            var clinic = $(this).data('clinic');
            var appt = $(this).data('appt');
            var remarks = $('#'+appt+'remarks').val();
              
            if($('#agreement').prop('checked') == true){
                     if(remarks == ''){
            $('#'+appt+'remarks').addClass('is-invalid');
            }else {
                        swal({
                        title: "Are you sure?",
                        text: "You cannot undo Actions",
                        icon: "warning",
                        buttons: true,
                        dangerMode: false,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
             window.location.href='{{route("edit.update_referral")}}'+'?id='+appt+'&remarks='+remarks+'&DoctorId='+doctorid+'&clinic='+clinic;    
                        } else {
                        
                        }
                        });

            }
            }else {
              swal("Acceptance Required!", "Please Accept the letter of agreement,Check the box to accept", "error");
            }



           
                      
    


            })
            $('.rem').keyup(function(){
                       $(this).removeClass('is-invalid'); 
            })
    </script>
@endsection
