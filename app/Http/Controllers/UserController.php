<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function dashboard(){
        $tab = 'dashboard';
        $userid =  Auth::user()->id;
        $clinic = Clinic::all();
        $doctor = Doctor::all();
        $pending = Appointment::where('user_id',$userid)->where('status',0)->get();
        $approved = Appointment::where('user_id',$userid)->where('status',1)->get();

        $disapproved = Appointment::where('user_id',$userid)->where('status',2)->get();
        $completed = Appointment::where('user_id',$userid)->where('status',3)->get();

        $referred = Appointment::where('user_id',$userid)->where('status',4)->get();

        $cancelled = Appointment::where('user_id',$userid)->where('status',5)->get();

    


              if(session()->has('book')){
                $myappoint = session()->get('book');
             
                Appointment::create([
                    'user_id'=> Auth::user()->id,
                    'clinic'=> $myappoint['Clinic'],
                    'category'=> $myappoint['Category'],
                    'doctor' => $myappoint['Doctor'],
                    'dateofappointment'=> $myappoint['dateofappointment'],
                    'timeofappointment'=> $myappoint['timeofappointment'],
                    'refferedto'=>0,
                    'refferedto_doctor'=>0,
                    'remarks'=>'',
                    'treatment'=>'',
                    'status'=> 0,
                ]);
                return view('user.dashboard',compact('tab'))->with('Success','Booked Successfully!');

              }else {
                return view('user.dashboard',compact('tab','pending','approved','disapproved','completed','referred','cancelled','clinic','doctor'));
              }
           
       
    }

    public function book(){
        $clinic = DB::select('select * from clinics where id in (select clinic from doctors) ');
        $doctor = Doctor::all();
        $category = Category::all();
        $tab = 'book';
        return view('user.book',compact('tab','clinic','doctor','category'));
    }

    public function view_pending(){
        $id = Auth::user()->id;
        
        $data = Appointment::where('user_id',$id)->where('status',0)->get();
        $Doctor = Doctor::all();
        $user = User::all();
        $tab = 'view';
        return view('user.view',compact('tab','data','Doctor','user'));
    }

    public function cancel(){
        $id = Auth::user()->id;
        
        $data = Appointment::where('user_id',$id)->where('status',0)->get();
        $Doctor = Doctor::all();
        $user = User::all();
      
        $tab = 'cancel';
        return view('user.cancel',compact('tab','data','Doctor','user'));
    }
    
    public function view_cancel(){
        $id = Auth::user()->id;
        
        $data = Appointment::where('user_id',$id)->where('status',5)->get();
        $Doctor = Doctor::all();
        $user = User::all();
        $tab = 'view';
        return view('user.view_cancel',compact('tab','data','Doctor','user'));
    }

    public function view_approved(){
        $id = Auth::user()->id;
        
        $data = Appointment::where('user_id',$id)->where('status',1)->get();
        $Doctor = Doctor::all();
        $user = User::all();
        $tab = 'view';
        return view('user.view_approved',compact('tab','data','Doctor','user'));
    }

    public function view_completed(){
        $id = Auth::user()->id;
        
        $data = Appointment::where('user_id',$id)->where('status',3)->get();
        $Doctor = Doctor::all();
        $user = User::all();
        $tab = 'view';
        return view('user.view_completed',compact('tab','data','Doctor','user'));
    }
   
    public function view_disapproved(){
        $id = Auth::user()->id;
        
        $data = Appointment::where('user_id',$id)->where('status',2)->get();
        $Doctor = Doctor::all();
        $user = User::all();
        $tab = 'view';
        return view('user.view_disapproved',compact('tab','data','Doctor','user'));
    }
    
    public function booknow(Request $request){
        $request->validate([
            'Clinic' => 'required',
            'Category' =>'required',
            'Doctor' => 'required',
            
        ]);
      
        Appointment::create([
            'user_id'=> Auth::user()->id,
            'clinic'=> $request->input('Clinic'),
            'category'=> $request->input('Category'),
            'doctor' => $request->input('Doctor'),
            'dateofappointment'=> $request->input('dateofappointment'),
            'timeofappointment'=> $request->input('timeofappointment'),
            'refferedto'=>0,
            'refferedto_doctor'=>0,
            'remarks'=>'',
            'treatment'=>'',
            'status'=> 0,
        ]);
        return redirect()->route('user.book')->with('Success','Booked Successfully!'); 

    }

    public function feedback(){
        $id = Auth::user()->id;
        $clinics = DB::Select('select * from clinics where id in (select clinic from appointments where user_id ='.$id.') ');
        $data = Feedback::where('user_id',$id)->get();
        $cl  = Clinic::all();
        $tab = 'feedback';
        return view('user.sendfeedback',compact('tab','clinics','data','cl'));
    }
}