@extends('admin.layouts.master')

@section('container')
<div class="app flex-row align-items-center casba-textbox-tooltip login-app">
  <div class="container">
    <div class="login-container">
      <div class="row justify-content-center">
        <div class="row">
          <div class="col-md-12">
            <!----><div class="card login-app--card">
              <div class="card-body">
                  <div class="brand-logo text-center">
                      <img alt="logo-brand" src="{{ asset('images/radio_icon.png') }}" style="width:100px;border-radius: 25px;">
                  </div>

                   
                <form class="ng-untouched ng-pristine ng-invalid" class="login" role="form" method="POST" action="{{ route('admin.login-submit') }}">
                        {{ csrf_field() }}
                
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="login-app__label" for="username" style="padding-left:5px;">
                          {{-- <i class="fa fa-user" aria-hidden="true"></i> --}}
                          <span>Email</span>
                        </label>
                        <div class="input-group">
                          <input name="email" class="form-control ng-untouched ng-pristine ng-invalid"  type="text" style="border-radius:15px;" placeholder="admin@admin.com">
                            @if ($errors->has('email'))
                                <div class="form-validation validation-icons">
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                                </div>
                            @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="login-app__label" for="password" style="padding-left:5px;">
                          {{-- <i class="fa fa-unlock" aria-hidden="true"></i> --}}
                          <span >Password</span>
                        </label>
                        <div class="input-group">
                          <input class="form-control ng-untouched ng-pristine ng-invalid" name="password"  type="password" style="border-radius:15px;" placeholder="123456">
                          
                            @if ($errors->has('password'))
                                <div class="form-validation validation-icons">
                                <span class="help-block">
                                    {{ $errors->first('password') }}
                                </span>
                                </div>
                            @endif
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button class="btn sign-in" type="submit">Login</button>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <!---->
                    </div>
                  </div>
                </form>
              </div>
            </div>




            <div class="copyright text-center">
              <a >© 2020 W3Coders. All Rights Reserved</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
