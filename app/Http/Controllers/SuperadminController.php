<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;

use Illuminate\Support\Facades\DB;
class SuperadminController extends Controller
{
    //
    public function dashboard(){
       $Doctor= Doctor::all();
       $Appointment = Appointment::all();
       $Patients = User::where('user_type','patient')->get();
       $Clinic = Clinic::all();
        $tab = 'dashboard';
        return view('superadmin.dashboard',compact('tab','Doctor','Appointment','Patients','Clinic'));
    }

    public function clinics(){
        $data = Clinic::all();
        $doctor = Doctor::all();
        $category = Category::all();

        $tab = 'clinics'; 
       return view('superadmin.clinics',compact('tab','data','doctor','category'));
    }

    public function category(){
        $clinics = Clinic::all();
        $doc = Doctor::all();
        $tab = 'category';
        return view('superadmin.category',compact('tab','clinics','doc'));
    }

    public function doctors(){
        $data = Doctor::all();
        $category = Category::all();
        $clinic = Clinic::all();
      
        $tab = 'doctors';
        return view('superadmin.doctors',compact('tab','data','category','clinic'));
    }

    public function admin(){
        $data = User::where('user_type','admin')->get();
        $clinic = Clinic::all();
        $tab = 'admin';
        return view('superadmin.admin',compact('tab','data','clinic'));
    }

    public function patients(){
        $data = User::where('user_type','patient')->get();
        $appt = Appointment::all();
        $tab = 'patients';
        return view('superadmin.patients',compact('tab','data','appt'));
    }

    public function add_clinic(){

        $tab = 'clinics';
        return view('superadmin.action.add_clinic',compact('tab'));

    }

    public function edit_clinic(Request $request){
       $data = Clinic::where('id', $request->id)->get();
       $tab = 'clinics';
       return view('superadmin.action.edit_clinic',compact('tab','data'));

    }
    public function sort_clinics(Request $request){
        $clinic_id = $request->id;
        $clinics = Clinic::all();
        $doc = Doctor::all();
        $name = Clinic::select('name')->where('id',$clinic_id)->get();
        $data = Category::where('clinic',$clinic_id)->get();
        $tab = 'category';
       $clinic_name = $name[0]["name"];
       return view('superadmin.category',compact('tab','clinics','data','clinic_id','clinic_name','doc'));

    }

    public function add_doctor(){

        $clinics = Clinic::all();
        $tab = 'doctors';
        return view('superadmin.action.add_doctors',compact('tab','clinics'));
        
    }

    public function getcategory(Request $request){
        $id =  $request->getcategory;
        $data = Category::where('clinic',$id)->get();
            echo "<select  name='Category' class='form-select' >";
        foreach ($data as $key => $value) {
            echo "<option value=".$value->id.">".$value->name."</>";
         
        }
            echo "</select>";

    }

    public function edit_doctor(Request $request){
        $data = Doctor::where('id',$request->id)->get();
      
        $tab = 'doctors';
        return view('superadmin.action.edit_doctors',compact('tab','data'));
        
    }

    public function add_admin(){
        $clinics = Clinic::all();
        $tab = 'admin';
        return view('superadmin.action.add_admin',compact('tab','clinics'));
    }

    public function edit_admin(Request $request){
     
        $data = User::where('id',$request->id)->get();
        $clinics = Clinic::all();
        $tab = 'admin';
        return view('superadmin.action.edit_admin',compact('tab','clinics','data'));
    }
    public function add_patient(){
        $tab = 'patients';
        return view('superadmin.action.add_patients',compact('tab'));
    }

    public function edit_patient(Request $request){
        $data = User::where('id',$request->id)->get();
        $tab = 'admin';
        return view('superadmin.action.edit_patients',compact('tab','data'));
    }
}
