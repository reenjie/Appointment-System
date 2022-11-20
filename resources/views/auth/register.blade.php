@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 " >
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1 style="color:rgb(132, 130, 245)">Register</h1>
                        
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="">{{ __('Name') }}</label>

                         
                                <input id="name" autofocus type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contactno" class="">{{ __('Contact No') }}</label>

                         
                                <input id="contactno" type="number" class="form-control @error('contactno') is-invalid @enderror" name="contactno" value="{{ old('contactno') }}" required autocomplete="contactno" autofocus>
    
                                @error('contactno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="email" class="">{{ __('Email Address') }}</label>

                         
                                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="address" class="">{{ __('Address') }}</label>

                         
                             
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="4" rows="4" style="resize: none">{{ old('address') }}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                
                            <label for="password" class="">{{ __('Password') }}</label>

                          
                            <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                       
                            </div>
                            <div class="col-md-6">
                                
                            <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                           
                            <input id="password-confirm" type="password" class="form-control " name="password_confirmation" required autocomplete="new-password">

                            </div>
                        </div>
                           
                           

                      
                         

                              

                                   
                           
                          
                          

                      

                       
                                    <br>
                                    <a class="btn btn-light text-primary btn-sm" href="../">
                                    Already have an Account?
                                    </a>
                                   
                                    <button type="submit" class="btn btn-primary mt-5" style="float: right">
                                        {{ __('Register') }}
                                    </button>
                                    <br><br>

                            </div>
                            
                            <div class="col-md-6">
                                <img src="{{asset('img/reg.svg')}}" alt="" width="100%">
                            </div>
                           
                    
                           
                        
                    </form>
              
        </div>
    </div>
</div>
@endsection
