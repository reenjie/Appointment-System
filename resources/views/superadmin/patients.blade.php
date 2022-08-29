@extends('layouts.superadmin_layout')
@section('content')
    <div class="container">
        <div class="titlebar">
            <h4 class="hf mb-3">Patients</h4>
            

        </div>

        <div class="card shadow-sm">
            <div class="card-body">
           <div class="container">
            <button class="btn btn-dark btn-sm px-3 mb-2" onclick="window.location.href='{{route('superadmin.add_patient')}}'" >Add</button>
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
            <div class="table-responsive">
                <table class="table table-striped table-sm af" style="font-size: 14px" id="myTable">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">Name</th>
                        <th scope="col">Email & Contact No</th>
                        <th scope="col">No of Appointment</th>
                        <th scope="col">Date-registered</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td style="font-weight: bold">{{$row->name}}</td>
                            <td>
                               {{$row->email}}
                                <br>
                                #{{$row->contactno}}
                            </td>
                            <td style="font-weight: bold" class="text-primary">
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($appt as $item)
                                    @if($row->id == $item->user_id)
                                       @php
                                           $count++
                                       @endphp
                                    @endif
                                @endforeach

                              @if($count>=1)
                                {{$count}}
                              @else
                             <span class="text-danger" style="font-size:11px">No booked appointments yet.</span> 
                              @endif

                            </td>
                           
                            <td>{{Date('h:ia F j,Y',strtotime($row->created_at))}}</td>
                            <td>
                                <div class="btn-group">
                                    <button onclick="window.location.href='{{route('superadmin.edit_patient',$row->id)}}' " class="btn btn-light btn-sm text-success"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$row->id}}" class="btndelete btn btn-light btn-sm text-danger"><i class="fas fa-trash-can"></i></button>
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
<script>
        $('.btndelete').click(function(){
     var id =$(this).data('id');
    
     swal({
title: "Are you sure?",
text: "Once deleted, You will not be recovered it.",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
    $(this).html('Deleting');
 window.location.href='{{route("delete.delete_admin")}}'+'?id='+id;
} else {

}
});
 })
 </script>
@endsection