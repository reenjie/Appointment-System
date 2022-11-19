<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Feedback;
use App\Models\Ref_history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){

        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $appt = Appointment::where('clinic',$id)->get();
        $Doctor= Doctor::where('clinic',$id)->get();
        $category = Category::where('clinic',$id)->get();
        $Appointment = Appointment::where('clinic',$id)->get();
        $data = Appointment::where('clinic',$id)->where('status',0)->limit(4)->get();
         $user = User::all();
        $Patients = DB::select('select * from users where user_type="patient" and id in (select user_id from appointments where clinic ='.$id.' )');
        $Clinic = Clinic::all();
        $feedback = Feedback::where('clinic',$id)->get();
        $refer =   DB::select('select * from clinics where id in (select clinic from appointments where status=4 and refferedto ='.$id.' ) ');
     
    
        $tab = 'dashboard';
       return view('admin.dashboard',compact('tab','appt','clinicsName','Doctor','Appointment','Patients','Clinic','category','data','user','feedback','refer'));
    }
    public function appointment(){
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Appointment::where('clinic',$id)->where('status',0)->get();
      
        $Doctor = Doctor::where('clinic',$id)->get();  
        $completeappt = Appointment::where('status',3)->get();
        $alldoctor = Doctor::all();
        $allclinic = Clinic::all();
        $user = User::all();
        $tab = 'appointment';

        /* 
          $completeappt = Appointment::where('status',3)->get();
        $alldoctor = Doctor::all();
        $allclinic = Clinic::all();
        'completeappt','alldoctor','allclinic'
        */
        return view('admin.appointment',compact('tab','data','Doctor','user','clinicsName','completeappt','alldoctor','allclinic'));
    }
    public function patient(){
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = DB::select('select * from users where user_type="patient" and id in (select user_id from appointments where clinic ='.$id.') ');
        $tab = 'patient';
        $appt = Appointment::where('clinic',$id)->get();
        return view('admin.patient',compact('tab','data','appt','clinicsName'));
    }
    public function referral(){
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = DB::select('select * from appointments where clinic = '.$id.' and status=1 or  refferedto = '.$id.'  ');
        $doctor = Doctor::all();
        $user = User::all();
        $clinic = Clinic::all();
        $refhistory = Ref_history::all();
        $appr_appointments = Appointment::where('status',1)->where('clinic',$id)->get();
        $referred = DB::select('select * from clinics where id in (select clinic from appointments where status=4 and refferedto ='.$id.' and ad_status= 0  ) ');
        $tab = 'referral';

        return view('admin.referral',compact('tab','data','user','doctor','clinic','referred','appr_appointments','clinicsName','refhistory'));
    }

    public function category(){
        $clinic_id = Auth::user()->clinic; 
        $cli = Clinic::where('id',$clinic_id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Category::where('clinic',$clinic_id)->get();
        $doc = Doctor::where('clinic',$clinic_id)->get();
        $tab = 'category';
        return view('admin.category',compact('tab','data','doc','clinicsName'));
    }

    public function doctors(){
        $clinic_id = Auth::user()->clinic; 
        $cli = Clinic::where('id',$clinic_id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Doctor::where('clinic',$clinic_id)->get();
        $category = Category::where('clinic',$clinic_id)->get();
       
        $tab = 'doctors';
        return view('admin.doctors',compact('tab','data','category','clinicsName'));
    }
    public function feedback(){
        $clinic_id = Auth::user()->clinic; 
        $user = User::all();
        $cli = Clinic::findorFail($clinic_id);   
        $clinicsName =  $cli->name;

        $alluser = DB::select('select * from users where id in (select user_id from feedback where clinic = '.$clinic_id.' )');
        $data = Feedback::where('clinic',$clinic_id)->orderBy("created_at", "desc")->get();


        $tab = 'feedback';
        return view('admin.feedback',compact('tab','data','user','clinicsName','alluser'));
    }

    public function adddoctor(){
        $tab= 'doctors';
        $clinic_id = Auth::user()->clinic; 
        $cli = Clinic::where('id',$clinic_id)->get();
        $clinicsName =  $cli[0]['name'];
        $category = Category::where('clinic',$clinic_id)->get();
        return view('admin.action.add_doctor',compact('tab','category','clinicsName'));
    }

    public function edit_doctor(Request $request){
        $data = Doctor::where('id',$request->id)->get();
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $tab = 'doctors';
        return view('admin.action.edit_doctors',compact('tab','data','clinicsName'));
        
    }
    public function approved(){

        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Appointment::where('clinic',$id)->where('status',1)->get();
        $Doctor = Doctor::where('clinic',$id)->get();
        $user = User::all();
        $tab = 'appointment';
       
          $completeappt = Appointment::where('status',3)->get();
        $alldoctor = Doctor::all();
        $allclinic = Clinic::all();
       
      
        return view('admin.approve_appointment',compact('tab','data','Doctor','user','clinicsName','completeappt','alldoctor','allclinic'));
      }

      public function completed(){
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Appointment::where('clinic',$id)->where('status',3)->get();
        $Doctor = Doctor::where('clinic',$id)->get();
        $user = User::all();
        $tab = 'appointment';
      
          $completeappt = Appointment::where('status',3)->get();
        $alldoctor = Doctor::all();
        $allclinic = Clinic::all();
       
      
        return view('admin.completed_appointment',compact('tab','data','Doctor','user','clinicsName', 'completeappt','alldoctor','allclinic'));
      }

      public function cancelled(){
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Appointment::where('clinic',$id)->where('status',5)->get();
        $Doctor = Doctor::where('clinic',$id)->get();
        $user = User::all();
        $tab = 'appointment';
    
          $completeappt = Appointment::where('status',3)->get();
        $alldoctor = Doctor::all();
        $allclinic = Clinic::all();
       
      
        return view('admin.cancelled_appointment',compact('tab','data','Doctor','user','clinicsName' ,'completeappt','alldoctor','allclinic'));
      }

      public function disapproved(){
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Appointment::where('clinic',$id)->where('status',2)->get();
        $Doctor = Doctor::where('clinic',$id)->get();
        $user = User::all();
        $tab = 'appointment';
       
          $completeappt = Appointment::where('status',3)->get();
        $alldoctor = Doctor::all();
        $allclinic = Clinic::all();
       
        
        return view('admin.disapproved_appointment',compact('tab','data','Doctor','user','clinicsName', 'completeappt','alldoctor','allclinic'));
      }

      public function refer(Request $request){
        $tab ='referral';
        $clinicid = Auth::user()->clinic;
        $id = $request->id;
        $cli = Clinic::where('id',$clinicid)->get();
        $clinicsName =  $cli[0]['name'];
        $userpatient = User::where('id',$request->patientId)->get();
        $remarks = $request->remarks;
        if($remarks == 'undefined'){
            $remarks = '';
        }else {
            $remarks = $remarks;
        }

        $appt_attachedfile = Appointment::findorFail($id)->attachedfile;
      
        $clinic = Clinic::all();
        $data = DB::select('select * from doctors where clinic != '.$clinicid.' ');
        $category = Category::all();
         return view('admin.action.refer',compact('tab','id','remarks','data','clinic','category','userpatient','clinicsName','appt_attachedfile'));
      }

      public function accept_referral(Request $request){
        $id = $request->id;
        $doctor = $request->ref;
        $patient = $request->patient;


        $data = Appointment::where('id',$id)->get();
        $clinicid = Auth::user()->clinic;
        $cli = Clinic::where('id',$clinicid)->get();
        $clinicsName =  $cli[0]['name'];
        $clinic= DB::select('select * from clinics where id in (select clinic from doctors where  id='.$doctor.' ) ');
        $category =DB::select('select * from categories where id in (select category from doctors where id = '.$doctor.' ) ');
        $doc = Doctor::where('id',$doctor)->get();

        $user = User::where('id',$patient)->get();

        foreach($clinic as $cl){
            $clinicname = $cl->name;
           
        }
       

       
        foreach($doc as $dc){
            $docname = $dc->firstname.' '.$dc->lastname;
        }
        $tab = 'referral';
        return view('admin.action.accept_referral',compact('tab','data','clinicid','clinicname','category','doc','docname','doctor','user','id','clinicsName'));
      }

      public function attachedfile(Request $request){
        $id = $request->input('apptid');
        if($request->file('imgfile')){
          $imageName = time().'.'.$request->file('imgfile')->getClientOriginalExtension();
          $request->file('imgfile')->move(public_path('attachments'), $imageName);

          Appointment::where('id',$id)->update([
            'attachedfile' => $imageName,
          ]);
         
          return redirect()->back();
  
        }
      }

      public function removeAttachment(Request $request){
        $id = $request->id;

        $appt_attachedfile = Appointment::findorFail($id);
        $image_path =   public_path('attachments/' . $appt_attachedfile->attachedfile);
        
        if(file_exists($image_path)){
          unlink($image_path);
        }

        Appointment::where('id',$id)->update([
          'attachedfile' => null,
        ]);
        return redirect()->back();
  
      }
}
