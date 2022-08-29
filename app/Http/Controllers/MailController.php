<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MailController extends Controller
{

    private $email;
    private $name;
    private $client_id;
    private $client_secret;
    private $token;
    private $provider;

    /**
     * Default Constructor
     */
    public function __construct()
    {
       
     
        $this->client_id        = env('GOOGLE_API_CLIENT_ID');
        $this->client_secret    = env('GOOGLE_API_CLIENT_SECRET');
        $this->provider         = new Google(
            [
                'clientId'      => $this->client_id,
                'clientSecret'  => $this->client_secret
            ]
        );

    }

    public function sendcredentials(Request $request){
        $receiver = $request->email;
        $name = $request->name;
        $this->token = session()->get('token');
        $mail = new PHPMailer(true);

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => $this->token,
                       'userName'          => session()->get('email')
                   ]
               )
           );

           $mail->setFrom(session()->get('email'),session()->get('e_name'));
           $mail->addAddress($receiver, $name);
           $mail->Subject = 'Login Credentials to Medical Clinic WebApp';
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '<!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title></title>
           </head>
           
           <body style="background-color: aquamarine;text-align:center">
           <p><br><br><br></p>
               <h2><a target="_blank" href="#">Medical Clinic</a></h2>
           
               <h3 style="color:rgb(14, 87, 136)">Welcome new Administrator!
           
           
                   </h3>
                   <h4>Here are your Login Credentials,</h4>
           
           
           
           
                   <h4>Email: <span style="font-weight:bold">'.$receiver.'</span>
                       <br>
                       Password: <span style="font-weight:bold">'.$receiver.'</span>
           
                   </h4>
           
                   <br>
                   <h5>
                       Do not share this to anyone.
                       <br>
           
                       All rights Reserved &middot; 2022
           
                   </h5>
                   <p><br><br><br></p>
           
           </body>
           
           </html>
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
            return redirect()->route('superadmin.admin')->with('Success','New Admin was Added Successfully!'); 
           } else {
               return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
           return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }  

    }





    public function sendCredentials_patient(Request $request){
        $receiver = $request->email;
        $name = $request->name;
        $this->token = session()->get('token');
        $mail = new PHPMailer(true);

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => $this->token,
                       'userName'          => session()->get('email')
                   ]
               )
           );

           $mail->setFrom(session()->get('email'),session()->get('e_name'));
           $mail->addAddress($receiver, $name);
           $mail->Subject = 'Login Credentials to Medical Clinic WebApp';
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '<!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title></title>
           </head>
           
           <body style="background-color: aquamarine;text-align:center">
           <p><br><br><br></p>
               <h2><a target="_blank" href="#">Medical Clinic</a></h2>
           
               <h3 style="color:rgb(14, 87, 136)">Welcome '.$name.'!
           
           
                   </h3>
                   <h4>You are registered to our Websites and Here are your Login Credentials,</h4>
           
           
           
           
                   <h4>Email: <span style="font-weight:bold">'.$receiver.'</span>
                       <br>
                       Password: <span style="font-weight:bold">'.$receiver.'</span>
           
                   </h4>
           
                   <br>
                   <h5>
                       Do not share this to anyone.
                       <br>
           
                       All rights Reserved &middot; 2022
           
                   </h5>
                   <p><br><br><br></p>
           
           </body>
           
           </html>
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
            return redirect()->route('superadmin.patients')->with('Success','New Patient was Added Successfully!'); 
           } else {
               return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
           return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }  

    }




    

    public function notify_patient(Request $request){
        $receiver = $request->email;
        $name = $request->name;
        $this->token = session()->get('token');
        $mail = new PHPMailer(true);

        
        if($request->tp == 'approved'){
            $subj = 'APPROVED APPOINTMENT BOOKING';
            $typo = '<span style="color:green">APPROVED</span>';
            $stat = 'approved!';
            $guided = 'Please Be at the '.$request->cname.' at the Dates and Time Stated Above.
            <br>
            Location : '.$request->loc.'';
            $prop = '';
        }else if ($request->tp == 'disapproved'){
            $subj = 'DISAPPROVED APPOINTMENT BOOKING';
            $typo = '<span style="color:red">DISAPPROVED</span>';
            $stat = 'disapproved! you can resend your appointment after 24 hours';
            $guided = 'Remarks: <br>'.$request->remarks;
            $prop = '';
        }else if ($request->tp == 'completed'){
            $subj = 'APPOINTMENT BOOKING COMPLETED';
            $typo = '<span style="color:blue">ACCOMPLISHED</span>';
            $stat = 'Completed! We do appreciate if youll send us some feedbacks <br>';
            $guided = 'Remarks: <br>'.$request->remarks.'<br> Treatment : <br>'.$request->treatment;
            $prop = '';
        }else if ($request->tp == 'refered'){
            $subj = 'APPOINTMENT BOOKING REFERRED';
            $prop = '';
            $typo = '<span style="color:red">REFERRED</span>';
            $stat = 'referred! For more info. Please Login to your account to check the Details of your referrals. <br>';
            $guided = ' Referred TO : '.$request->cname.'<br> Location : '.$request->loc .'<br> Remarks: '.$request->remarks;
        }else if ($request->tp == 'rebook'){
            $subj = 'APPOINTMENT BOOKING REBOOK';
            $typo = '<span style="color:green">APPROVED AND REBOOK SUCCESSFULLY</span>';
            $prop = 'new';
            $stat = 'rebook and set!';
            $guided = 'Please Be at the '.$request->cname.' at the Dates and Time Stated Above.
            <br>
            Location : '.$request->loc.'';
        }

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => $this->token,
                       'userName'          => session()->get('email')
                   ]
               )
           );

           $mail->setFrom(session()->get('email'),session()->get('e_name'));
           $mail->addAddress($receiver, $name);
           $mail->Subject = $subj;
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '<!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title></title>
           </head>
           
           <body style="background-color: aquamarine; ">
           <p><br><br><br></p>
           <div style="padding:20px">
               <h2><a target="_blank" href="#">Medical Clinic</a></h2>
           
               <h3 style="color:rgb(14, 87, 136)">BOOKING '.$typo.'
           
           
                   </h3>
                   <h4>Hi '.$name.' Your '.$prop.' appointment Booking <br><br> Dated at : '.date('F j,Y',strtotime($request->doa)).'<br>
                   
                   And Time : '.date('h:i a',strtotime($request->toa)).'<br> <br>
                   Has Been '.$stat.' <br> '.$guided.'
                   </h4>
           
           
           
           
                   
           
                   <br>
                   <h5>
                      Glory be to God.
                       <br>
           
                       All rights Reserved &middot; 2022
           
                   </h5>
                   </div>
                   <p><br><br><br></p>
           
           </body>
           
           </html>
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
            if($request->tp == 'approved'){
            return redirect()->back()->with('Success','Patient Booking Approved Successfully!'); 

            }else if($request->tp == 'disapproved') {
                return redirect()->back()->with('Success','Patient Booking Disapproved Successfully!'); 
            }else if($request->tp == 'completed'){
                return redirect()->back()->with('Success','Patient Booking Marked Done Successfully!'); 
            }else if($request->tp == 'refered'){
                return redirect()->route('admin.referral')->with('Success','Patient  was referred Successfully!'); 
            }
            else if($request->tp == 'rebook'){
                return redirect()->route('admin.referral')->with('Success','Referral Accepted and Appointment was set Successfully!'); 
            }
           } else {
               return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
           return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }  
    }

    public function resetlink(Request $request){
        $receiver= $request->input('email'); 
        $name = 'Medical_clinic Client';
        $user = User::where('email',$receiver)->get();

       $url =  'http://'.request()->getHttpHost().'/ResetPassword?token='.$user[0]['id'].'&code='.$user[0]['password'];

        

       $this->token = session()->get('token');
        $mail = new PHPMailer(true);

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => $this->token,
                       'userName'          => session()->get('email')
                   ]
               )
           );

           $mail->setFrom(session()->get('email'),session()->get('e_name'));
           $mail->addAddress($receiver, $name);
           $mail->Subject = 'RESET LINK';
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '<!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title></title>
           </head>
           
           <body style="background-color: aquamarine;text-align:center">
           <p><br><br><br></p>
               <h2><a target="_blank" href="#">Medical Clinic</a></h2>
           
               <h3 style="color:rgb(14, 87, 136)">Hi!
           
            
                   </h3>
                   <h4>It seems like you forgot your password. <a href="'.$url.'">Click Here</a> To reset your password .</h4>
           
                 
                   <br>
                   <h5>
                   If this wasnt you. Please Login and Change your password.
                   <br>
                       Do not share this to anyone.
                       <br>
           
                       All rights Reserved &middot; 2022
           
                   </h5>
                   <p><br><br><br></p>
           
           </body>
           
           </html>
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
            return redirect()->back()->with('Success','We have Emailed your Reset Link Please Check your Email.'); 
           } else {
               return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
           return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }  
   
    }

    public function resetpassword(Request $request){
      
        $request->validate([
            'password'=>['confirmed'],
        ]);

        $id = $request->input('id');
        $password = Hash::make($request->input('password'));

        User::where('id',$id)->update([
            'password' => $password,
        ]);
        
        
        $time = date('h:i a  F j,Y');
       
        $user = User::where('id',$id)->get();

        $receiver= $user[0]['email']; 
        $name = $user[0]['name'];


       $this->token = session()->get('token');
        $mail = new PHPMailer(true);

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => $this->token,
                       'userName'          => session()->get('email')
                   ]
               )
           );

           $mail->setFrom(session()->get('email'),session()->get('e_name'));
           $mail->addAddress($receiver, $name);
           $mail->Subject = 'RESET SUCCESSFULLY';
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '<!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title></title>
           </head>
           
           <body style="background-color: aquamarine;text-align:center">
           <p><br><br><br></p>
               <h2><a target="_blank" href="#">Medical Clinic</a></h2>
           
               <h3 style="color:rgb(14, 87, 136)">Hi '.$name.'!
           
            
                   </h3>
                   <h4>Your Password has changed Successfully! <br> DateTime: '.$time.'</h4>


                   <br>
                   <h5>
                  
                   
                       <br>
           
                       All rights Reserved &middot; 2022
           
                   </h5>
                   <p><br><br><br></p>
           
           </body>
           
           </html>
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
            return redirect('/')->with('Success','We have Emailed your Reset Link Please Check your Email.'); 
           } else {
               return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
           return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }   
    }
}