@extends('layouts.user_layout')
@section('content')
    <div class="container">
        <div class="titlebar">
            <h4 class="hf mb-3">Book Appointment</h4>         
        </div>

        <div class="row">
          
            <div class="col-md-8">
              <form method ="post" action="{{route('user.submit')}}" id="booknow">
                @csrf
                
                        <div class="card mb-5 mt-4 shadow" style="background-color: rgba(210, 233, 245, 0.185)">
                         <div class="card-body login">
                                 
                                    <div class="row">
                    <div class="col-md-6">
              
                 <label for="">Date :</label>
                @php
                    $date = date('Y-m-d');
                @endphp

               <input type="date" id="dop" name="dateofappointment" class="authbox mb-2 form-control" placeholder="" value="{{old('dateofappointment')}}" autofocus required min="{{date('Y-m-d',strtotime(date("Y-m-d", strtotime($date)) . " +1 day"))}}" >

               <div class="invalid-feedback">
                <span style="font-size:12px">Please Provide Date or the Date you have entered is already reserved</span>
               </div>
                     </div>
                     <div class="col-md-6">
                        <label for="">Time :</label>
                        <input type="time" name="timeofappointment" class="authbox form-control" placeholder="" value="{{old('timeofappointment')}}" required>

            </div>

                        <div class="col-md-6">
                <label for="">Clinic :</label>
              <select name="Clinic"  class="authbox form-select @error('Clinic') is-invalid @enderror" id="clinic" >
                <option value="">Select Clinic</option>
                @foreach ($clinic as $item)
                <option value="{{$item->id}}">{{$item->name}}</option> 
                @endforeach
                                  
            </select> 
            @error('Clinic')
              <div class="invalid-feedback">
                <span style="font-size:12px">Please Select Clinic</span>
              </div>
            @enderror
                        </div>
             <div class="col-md-6">
                <label for="">Category :</label>
                <div id="category">
                  <select name="Category" class="authbox form-select @error('Category') is-invalid @enderror" id="" disabled>
                  
                               
        </select>    
        @error('Category')
        <div class="invalid-feedback">
          <span style="font-size:12px">Please Select Category</span>
        </div>
      @enderror
                </div>
             
                        </div>

             <div class="col-md-12">
                <label for="">Doctor :</label>
                <div id="doctor">
              <select name="Doctor" class="authbox form-select  @error('Doctor') is-invalid @enderror" id="" disabled>
                                   
            </select>   
            @error('Doctor')
            <div class="invalid-feedback">
              <span style="font-size:12px">Please Select your Doctor</span>
            </div>
          @enderror 
          </div>
                        </div>
                <div class="col-md-12">
              <button type="submit" id="submit" class="authbtn btn btn-primary form-control mt-4 py-3">Submit</button>
                        </div>
                   
                                 </div>
                           
                                 

                          </div>
                        </div>
                      </form>

            </div>
          
          </div>
    </div>

    @if(Session::get('Success'))
    <script>
        swal("Appointment Booked Successfully!", "Your request is still pending, and waiting for approval.", "success");
     </script>
       
    @endif
    <script>
        $('#booknow').submit(function(){
         $('#submit').html('Submitting ..');
        })
 function reveal() {
var reveals = document.querySelectorAll(".reveal");
for (var i = 0; i < reveals.length; i++) {
 var windowHeight = window.innerHeight;
 var elementTop = reveals[i].getBoundingClientRect().top;
 var elementVisible = 150;
 if (elementTop < windowHeight - elementVisible) {
 reveals[i].classList.add("active");
 } else {
 reveals[i].classList.remove("active");
 }
}
}

window.addEventListener("scroll", reveal);

// To check the scroll position on page load
reveal();

$('#clinic').change(function(){
var val = $(this).val();
if(val == ''){
$('#doctor').html('<select name="Doctor" class="authbox form-select @error("Doctor") is-invalid @enderror"  id="" disabled></select> ');
$('#category').html('<select name="Category" class="authbox form-select @error("Category") is-invalid @enderror" id="" disabled> </select>  ');
}
$(this).removeClass('is-invalid');
$.ajax({
 url : '{{route("home.category")}}',
 method :'get',
 data : {sortby:val},
 success : function(data){
  $('#category').html(data);
  $('#doctor').html('<select name="Doctor" class="authbox form-select  id="" disabled></select> ');
 }
})
})




$('#dop').change(function(){
    var val = $(this).val();
    var id = $('#clinic').val();
    $(this).removeClass('is-invalid');
    $('#submit').removeAttr('disabled');

    $.ajax({
 url : '{{route("home.checkifexist")}}',
 method :'get',
 data : {value:val,id:id},
 success : function(data){
    if(data == 'Reserved'){
        $('#dop').addClass('is-invalid');
        $('#submit').attr('disabled',true);
    }
 }
})
})

$('#clinic').change(function(){
    var id = $(this).val();
    var val = $('#dop').val();

    if(val == ''){
 $('#dop').addClass('is-invalid');
 $('#submit').attr('disabled',true);
    }else {
        $.ajax({
 url : '{{route("home.checkifexist")}}',
 method :'get',
 data : {value:val,id:id},
 success : function(data){
    if(data == 'Reserved'){
        $('#dop').addClass('is-invalid');
        $('#submit').attr('disabled',true);
    }
 }
})
    }
   


   
})

</script>
@endsection