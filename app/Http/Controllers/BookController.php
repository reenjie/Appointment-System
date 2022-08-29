<?php

namespace App\Http\Controllers;
use App\Models\Clinic;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function category(Request $request){
        $id=  $request->sortby;
        $category = DB::select('select * from categories where id in (select category from doctors where clinic = '.$id.' ) ');

        echo '<select name="Category" class="authbox form-select" id="categories" >';
            echo '<option>Choose Category</option>';
        foreach($category as $item){
            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        echo '</select>';
        
        echo '<script>$("#categories").change(function(){var val = $(this).val(); $.ajax({url : "'.route("home.doctor").'",method :"get",
            data : {sortby:val},success : function(data){$("#doctor").html(data);} }) })</script>';
           

     }

     public function doctor(Request $request){
        $id =  $request->sortby;
        $doctor = Doctor::where('category',$id)->get();

        echo '<select name="Doctor" class="authbox form-select" id="" >';
           echo '<option value="">Choose Doctor</option>';
        foreach($doctor as $item){
            echo '<option value="'.$item->id.'">'.$item->firstname.' '.$item->lastname.'</option>';
        }
        echo '</select>';

     }

     public function book(Request $request){
        $request->validate([
            'Clinic' => 'required',
            'Category' =>'required',
            'Doctor' => 'required',

        ]);
        
        $data =  $request->all();

        session(['book'=>$data]);

           return redirect()->route('login');

     }

     public function disapprove_booking(Request $request){
      $appt = Appointment::where('id',$request->id)->get();
      $userid = $appt[0]['user_id'];
      $clinicid = $appt[0]['clinic'];
      $adate = $appt[0]['dateofappointment'];
      $atime = $appt[0]['timeofappointment'];
      $udetails = User::where('id',$userid)->get();
      $email = $udetails[0]['email'];
      $name = $udetails[0]['name'];
      $clinicdetails = Clinic::where('id',$clinicid)->get();
      $clinicname = $clinicdetails[0]['name'];
      $cliniclocation =  $clinicdetails[0]['street'].' ,'.$clinicdetails[0]['barangay'].' '.$clinicdetails[0]['city'];


       Appointment::where('id',$request->id)->update([
         'status'=>2,
         'remarks'=>$request->remarks,
       ]);

       return redirect()->route('mail.notify_patient',['email'=>$email,'name'=>$name,'doa'=>$adate,'toa'=>$atime,'cname'=>$clinicname,'loc'=>$cliniclocation,'tp' =>'disapproved','remarks'=>$request->remarks]);



    /*    return redirect()->back()->with('Success','Patient Booking Disapproved Successfully. Patient will be able to resend it after 24 hours'); */
     }

     public function approve_booking(Request $request){
      $appt = Appointment::where('id',$request->id)->get();
      $userid = $appt[0]['user_id'];
      $clinicid = $appt[0]['clinic'];
      $adate = $appt[0]['dateofappointment'];
      $atime = $appt[0]['timeofappointment'];
      $udetails = User::where('id',$userid)->get();
      $email = $udetails[0]['email'];
      $name = $udetails[0]['name'];
      $clinicdetails = Clinic::where('id',$clinicid)->get();
      $clinicname = $clinicdetails[0]['name'];
      $cliniclocation =  $clinicdetails[0]['street'].' ,'.$clinicdetails[0]['barangay'].' '.$clinicdetails[0]['city'];
     
 Appointment::where('id',$request->id)->update([
        'status'=>1,
      ]);
      
      return redirect()->route('mail.notify_patient',['email'=>$email,'name'=>$name,'doa'=>$adate,'toa'=>$atime,'cname'=>$clinicname,'loc'=>$cliniclocation,'tp' =>'approved','remarks'=>$request->remarks]);

     /*  return redirect()->back()->with('Success','Patient Booking Approved Successfully. ');  */
    }

    public function complete_booking(Request $request){

      $appt = Appointment::where('id',$request->id)->get();
      $userid = $appt[0]['user_id'];
      $clinicid = $appt[0]['clinic'];
      $adate = $appt[0]['dateofappointment'];
      $atime = $appt[0]['timeofappointment'];
      $udetails = User::where('id',$userid)->get();
      $email = $udetails[0]['email'];
      $name = $udetails[0]['name'];
      $clinicdetails = Clinic::where('id',$clinicid)->get();
      $clinicname = $clinicdetails[0]['name'];
      $cliniclocation =  $clinicdetails[0]['street'].' ,'.$clinicdetails[0]['barangay'].' '.$clinicdetails[0]['city'];


      Appointment::where('id',$request->id)->update([
         'status'=>3,
         'remarks'=>$request->remarks,
         'treatment'=>$request->treatment,
       ]);
       return redirect()->route('mail.notify_patient',['email'=>$email,'name'=>$name,'doa'=>$adate,'toa'=>$atime,'cname'=>$clinicname,'loc'=>$cliniclocation,'tp' =>'completed','remarks'=>$request->remarks,'treatment'=>$request->treatment]);
    /*    return redirect()->back()->with('Success','Appointment Completed Successfully. '); */
    }

    public function checkifexist(Request $request){
      $apptdate =  $request->value;
      $appt = date('Y-m-d',strtotime($apptdate));
      $id = Auth::user()->id;
      $clinic = $request->id;
   
      $check = Appointment::where('user_id',$id)->where('dateofappointment',$appt)->where('clinic',$clinic)->where('status',0)->get();

    
      if(count($check)>=1){
         echo 'Reserved';
      }else {
         echo 'Vacant';
      }
      

    } 
 
}
