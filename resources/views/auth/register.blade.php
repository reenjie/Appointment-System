@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 login" style="margin-top: -20px">
          
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1>Register</h1>
                      
                            <label for="name" class="">{{ __('Name') }}</label>

                         
                                <input id="name" type="text" class="authbox @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           

                      
                            <label for="email" class="">{{ __('Email Address') }}</label>

                         
                                <input id="email" type="email" class="authbox  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                <label for="address" class="">{{ __('Address') }}</label>

                         
                             
                                <textarea name="address" class="authbox @error('address') is-invalid @enderror" id="" cols="4" rows="4" style="resize: none">{{ old('address') }}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                   
                            <label for="contactno" class="">{{ __('Contact No') }}</label>

                         
                            <input id="contactno" type="number" class="authbox @error('contactno') is-invalid @enderror" name="contactno" value="{{ old('contactno') }}" required autocomplete="contactno" autofocus>

                            @error('contactno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          
                          

                      
                            <label for="password" class="">{{ __('Password') }}</label>

                          
                                <input id="password" type="password" class="authbox  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           

                       
                            <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                           
                                <input id="password-confirm" type="password" class="authbox " name="password_confirmation" required autocomplete="new-password">

                                    <br>
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                    Already have an Account?
                                    </a>
                                    <br>
                                    <button type="submit" class="authbtn mt-5">
                                        {{ __('Register') }}
                                    </button>
                                    <br><br>

                            </div>
                      
                           
                    
                           
                        
                    </form>
              
        </div>
    </div>
</div>
@endsection
