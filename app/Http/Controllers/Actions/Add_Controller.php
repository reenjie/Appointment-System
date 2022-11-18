<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Add_Controller extends Controller
{
    public function add_category(Request $request){
       Category::create([
        'name' => $request->input('category'),
        'clinic' => $request->input('clinic'),
       ]);
       return redirect()->back()->with('Success','Category was Added Successfully!');

    }

    public function add_clinic(Request $request){
        $request->validate([
            'name' => 'required|unique:clinics',
            'street' => 'required',
            'barangay' => 'required',
            'city' => 'required',
        ]);

        Clinic::create([
            'name' => $request->input('name'),
            'street' => $request -> input('street'),
            'barangay' => $request -> input('barangay'),
            'city' => $request -> input('city'),
        ]);

        return redirect()->route('superadmin.clinics')->with('Success','Clinic was Added Successfully!');
    }

    public function add_doctor(Request $request){
        $request->validate([
            'Firstname'=> 'required',
            'Lastname' => 'required',
            'Email' => 'required|unique:doctors',
            'Contact' => 'required',
            'License' => 'required',
            'Street' =>'required',
            'Barangay' =>'required',
            'City' => 'required',
            'Clinic' => 'required',

           
            
        ]);

        Doctor::create([
            'firstname' => $request->input('Firstname'),
            'lastname'=>$request->input('Lastname'),
            'email'=>$request->input('Email'),
            'contact'=>$request->input('Contact'),
            'license'=>$request->input('License'),
            'street' =>$request->input('Street'),
            'barangay'=>$request->input('Barangay'),
            'city'=>$request->input('City'),
            'clinic'=>$request->input('Clinic'),
            'category'=>$request->input('Category'),
            'isavailable'=>0,
            
        ]);

        if(Auth::user()->user_type == 'superadmin'){
            return redirect()->route('superadmin.doctors')->with('Success','New Doctor was Added Successfully!');
        }else {
            return redirect()->route('admin.doctors')->with('Success','New Doctor was Added Successfully!');
        }

     
    }

    public function add_admin(Request $request){
     
        $request->validate([
            'Designation'=>'required',
            'Email' => 'required|unique:users',
            'Contact'=>'required',
            'Name' =>'required',
            'Address'=>'required',
            'Clinic'=>'required',
        ]);

       
        $default_password = Hash::make('admin_1234');
       User::create([
            'email'=>$request->input('Email'),
            'contactno'=>$request->input('Contact'),
            'name'=>$request->input('Name'),
            'user_type'=>'admin',
            'password'=>$default_password,
            'address'=>$request->input('Address'),
            'clinic'=>$request->input('Clinic'),
            'fl'=>0,
            'otp'=>0,
            'designation'=>$request->input('Designation'),
        ]);

        
        return redirect()->route('mail.sendCredentials',['email'=>$request->input('Email'),'name'=>$request->input('Name'),'password'=>'admin_1234']);



    }

    public function add_patient(Request $request){
        $request->validate([
            'Email' => 'required|unique:users',
            'Contact'=>'required',
            'Name' =>'required',
            'Address'=>'required',
          
        ]);


        $default_password = Hash::make($request->input('Email'));
        User::create([
             'email'=>$request->input('Email'),
             'contactno'=>$request->input('Contact'),
             'name'=>$request->input('Name'),
             'user_type'=>'patient',
             'password'=>$default_password,
             'address'=>$request->input('Address'),
             'clinic'=>0,
             'fl'=>0,
             'otp'=>0,
             'designation'=>null,
         ]);
 
         
         return redirect()->route('mail.sendCredentials_patient',['email'=>$request->input('Email'),'name'=>$request->input('Name')]);


        
 
 



    }

    public function sendfeedback(Request $request){
      $userid = Auth::user()->id;
      $clinic = $request->input('selected');
      $message = $request->input('message');
      $from = $request->input('from');

      if($from == 'from_user'){

        Feedback::create([
            'user_id'=>$userid,
            'message'=>$message,
            'clinic'=>$clinic,
            'from_user'=>1,
            'from_clinic'=>0,
          ]);
          
         $alluser = User::where('clinic',$clinic)->get();

         $username  = User::findorFail($userid)->name;

        foreach ($alluser as $key => $value) {
            $all[]=$value->email;
        }
        return redirect()->route('mail.NotifyAdmin_ReceivedFeedback',['message'=>$message,'alluser'=>$all,'Username'=>$username]);

      }else {
        $userid = $request->input('userid');
        $clinic = Auth::user()->clinic;

        Feedback::create([
            'user_id'=>$userid,
            'message'=>$message,
            'clinic'=>$clinic,
            'from_user'=>0,
            'from_clinic'=>1,
          ]);

          return redirect()->back(); 

      }
        
  
  
    }

}
