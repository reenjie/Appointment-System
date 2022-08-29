<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $usertype = Auth::user()->user_type;
        switch ($usertype) {
          case 'superadmin':
            return redirect()->route("superadmin.dashboard");
            break;

            case 'admin':
              return redirect()->route("admin.dashboard");
              break;

              case 'patient' :
                return redirect()->route('user.dashboard');
              break;
       
        }
  
      
    }

    


}
