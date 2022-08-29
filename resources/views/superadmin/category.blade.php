@extends('layouts.superadmin_layout')
@section('content')
    <div class="container">
        <div class="titlebar">
            <h4 class="hf mb-3">Category</h4>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                            
                               
                                     <h6 class="af" style="font-weight: bolder">Clinic</h6>
                                        <select style="" name="" class="form-select af" id="select_clinic" >
                                            @isset($clinic_id)
                                             <option value="{{$clinic_id}}">{{$clinic_name}}</option>

                                             @else
                                             <option value="">Select Clinic</option>
                                          @endisset
                                             @foreach ($clinics as $clinic)
                                             
                                            <option data-name="{{$clinic->name}}" value="{{$clinic->id}}">{{$clinic->name}}</option>
                                          
                                          
                                            @endforeach
                                          
                                        </select>
                                      
                                   
                            </div>
                        </div>
                  
                    </div>
                    @if(empty($data))
                    <div class="container mt-5 mb-5">
                          

                        <h6 class="text-secondary" style="text-align: center">
                            <img src="https://th.bing.com/th/id/R.8812c95c88f1695fc150b00250c0726f?rik=X1%2bd95kcnnq%2bPg&riu=http%3a%2f%2fmedicsww.org%2fimages%2fno-data.png&ehk=18X%2b44lq6215cwtDSTcnUaYhiSRpOjPBK32mLyIomhs%3d&risl=&pid=ImgRaw&r=0" style="width: 360px" alt="">
                            <br>
                          
                            No Selected Clinic. Select Clinic First to Manage Categories

                        </h6>

                       </div>
                    @else

                    @if(count($data)>=1)
                    
               <div class="container mt-5" id="tablebelow">
                <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-dark btn-sm px-3 mb-2">Add</button>

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
                            <th scope="col">Date-Created</th>
                            <th scope="col">Status</th>
                        
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td style="font-weight: bold" class="text-primary">{{$row->name}}</td>
                                <td>{{Date('F j,Y',strtotime($row->created_at))}}</td>
                                <td>
                                    @php
                                    $count = 0;
                                @endphp
                                @foreach ($doc as $item)
                                    @if($item->category == $row->id)
                                    
                                  @php
                                      $count++;
                                  @endphp
                                    @endif
                                @endforeach
                                  @if($count>=1)
                                  <span class="badge text-bg-success">Used</span>
                                  @else 
                                  <span class="badge text-bg-danger">Unused</span>
                                  @endif

                                 
                                </td>
                              
                             
                                <td>
                                    <div class="btn-group">
                                        <button data-bs-toggle="modal" data-bs-target="#edit{{$row->id}}" class="btn btn-light btn-sm text-success"><i class="fas fa-edit"></i></button>
 <button class="btn btn-light btn-sm text-danger btndelete" data-id="{{$row->id}}"><i class="fas fa-trash-can"></i></button>
                                    </div>
                                </td>
                              </tr>
                                

 <div class="modal fade" id="edit{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<form action="{{route('edit.edit_category')}}" method="post">
@csrf
<div class="modal-body">
<button type="button" style="float: right" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<br><br>
<h6 class="af">
Update Category
</h6>
<input type="text" value="{{$row->name}}" name="category" class="form-control" required>
<input type="hidden" name="id" value="{{$row->id}}">

</div>
<div class="modal-footer">

<button type="submit" class="af btn btn-info btn-sm px-3 py-2">Update</button>
</div>
</form>
</div>
</div>
</div> 
                            @endforeach
                          
                         
                        </tbody>
                      </table>
                </div>
               </div>

                    @else
                           <div class="container mt-5 mb-5">
                          

                            <h6 style="text-align: center">
                                <img src="https://th.bing.com/th/id/R.8812c95c88f1695fc150b00250c0726f?rik=X1%2bd95kcnnq%2bPg&riu=http%3a%2f%2fmedicsww.org%2fimages%2fno-data.png&ehk=18X%2b44lq6215cwtDSTcnUaYhiSRpOjPBK32mLyIomhs%3d&risl=&pid=ImgRaw&r=0" style="width: 360px" alt="">
                                <br>
                                <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-dark btn-sm px-3 mb-2">Add Category</button><br>
                                No Category Found in <span class="text-danger">{{$clinic_name}}</span>.

                            </h6>

                           </div>
                    @endif

                    @endif

                </div>
            </div>

        </div>
            

    </div>

  

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<form action="{{route('add.add_category')}}" method="post">
@csrf
<div class="modal-body">
<button type="button" style="float: right" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
<br><br>
<h6 class="af">
Add Category
</h6>
<input type="text" name="category" class="form-control" required>
@isset($clinic_id)
<input type="hidden" name="clinic" value="{{$clinic_id}}">
@endisset
</div>
<div class="modal-footer">

<button type="submit" class="af btn btn-primary btn-sm px-3 py-2">Save</button>
</div>
</form>
</div>
</div>
</div>
 
    <script>
     
        $('#select_clinic').change(function(){
            var val = $(this).val();  
        window.location.href='{{route("superadmin.sort_clinics","")}}'+'/'+val;
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
    $(this).html('Deleting ..');
    window.location.href='{{route("delete.delete_Category")}}'+'?id='+id;
  } else {
  
  }
});
    })
      
    </script>
@endsection