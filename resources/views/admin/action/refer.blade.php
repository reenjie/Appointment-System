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
                        <br>
                        <h6 class="af" style="font-size:13px">Remarks:</h6>
                        <input type="hidden" name="id" value="{{ $id }}">
                        <textarea name="" class="rem form-control" id="{{$id}}remarks" cols="4" rows="4" style="resize: none">@if($remarks=='')@else {{ $remarks }}@endif</textarea>
                        <div class="invalid-feedback">
                                    <span class="text-danger" style="font-size:12px">Please Provide Remarks *</span>
                        </div>
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
            $('.btnselect').click(function(){
            var doctorid=  $(this).data('id');
            var clinic = $(this).data('clinic');
            var appt = $(this).data('appt');
            var remarks = $('#'+appt+'remarks').val();
                      
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


            })
            $('.rem').keyup(function(){
                       $(this).removeClass('is-invalid'); 
            })
    </script>
@endsection
