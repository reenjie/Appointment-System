@extends('layouts.admin_layout')
@section('content')
    <div class="container">
            <div class="titlebar">
                        <h4 class="hf mb-3">Accepting Referral</h4>                  
                        </div>
                        <a href="{{route('admin.referral')}}" class="btn btn-light btn-sm mb-2">Back</a>
            @foreach ($data as $row)
            
            @endforeach
            <div class="row">
                    
                        <div class="col-md-6">
                                    @foreach ($user as $patient)
                                  
            
                                    <div class="card shadow ">
                                      <div class="card-body">
                                          
                                  <h6 class="af" style="font-weight:bold">{{$patient->name}}</h6>  ( <span style="font-size:13px">{{$patient->email}} </span> )
                                    <br>
                                   <i class="fas fa-phone"></i>   {{$patient->contactno}}
                                    <br>
                                   
                                      </div>
                                    </div>
                                  
                  
                                 
                                        
                                    @endforeach
                                    <form method ="post" action="{{route('edit.rebook')}}" id="booknow">
                                      @csrf
                                              <div class="card mb-5 mt-2 shadow" style="background-color: rgba(210, 233, 245, 0.185)">
                                               <div class="card-body login">
                                                      <h5>Set an Appointment</h5>
                                                          <div class="row">
                                          <div class="col-md-6">
                                    
                                       <label for="">Date :</label>
                                      @php
                                          $date = date('Y-m-d');
                                      @endphp
                                     <input type="date" name="dateofappointment" class="authbox mb-2 form-control" placeholder="" value="{{old('dateofappointment')}}" autofocus required min="{{date('Y-m-d',strtotime(date("Y-m-d", strtotime($date)) . " +1 day"))}}" >
                                           </div>
                                           <div class="col-md-6">
                                              <label for="">Time :</label>
                                              <input type="time" name="timeofappointment" class="authbox form-control " placeholder="" value="{{old('timeofappointment')}}" required>
          
                                  </div>
                                  <input type="hidden" name="apptid" value="{{$id}}">
          
                                              <div class="col-md-6">
                                      <label for="">Clinic :</label>
                                      <input type="hidden" name="Clinic" class="form-control"  value="{{$clinicid}}">
                                      <input type="text" class="form-control" disabled value="{{$clinicname}}">
                        
                              
                                              </div>
                                   <div class="col-md-6">
                                      <label for="">Category :</label>
                                      <div id="category">
                                       {{--  <select name="Category" class="authbox form-select @error('Category') is-invalid @enderror" id="" >
                                        
                          
                                                     
                              </select>  --}}
                              @foreach ($category as $item)
                         
                         <input type="hidden" name="Category" value="{{$item->id}}">
                         <input type="text" disabled class="form-control" value="{{$item->name}}">
                        @endforeach   
                           
                                      </div>
                                   
                                              </div>
          
                                   <div class="col-md-12">
                                      <label for="">Doctor :</label>
                                      <div id="doctor">
                                                <input type="hidden" name="Doctor" value="{{$doctor}}" >
                                                <input type="text" readonly  value="Dr. {{$docname}}" class="form-control" disabled>
                           
                                </div>
                                              </div>
                                      <div class="col-md-12">
                                    <button type="submit" id="submit" class="btn btn-primary form-control mt-4 py-3">Save</button>
                                              </div>
                                         
                                                       </div>
                                                 
                                                       
          
                                                </div>
                                              </div>
                                            </form>
          
                                  </div>
            </div>
    </div>
@endsection