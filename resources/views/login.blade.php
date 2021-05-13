@extends('layout-login')

@section('title', 'Login')
@section('addFooter')
    <script src="{{ asset('js/admin/js/function.js') }}"></script>
    <script src="{{ asset('js/admin/js/login.js') }}"></script>
@endsection
@section('content')
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <form method="POST" id="form-login">
                    @csrf
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="feather icon-unlock auth-icon"></i>
                        </div>



                        <h3 class="mb-4"><b>{{$nameApp->value }}</b></h3>
                        <div class="input-group mb-3">
                            <input type="email" name="userName" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" name="passName"  class="form-control" placeholder="password" required>
                        </div>
                        @if (session('errorLogin'))
                            {{ _html( array('e'=>'div',
                                            'atts'=>array("class"=>"alert alert-danger"),
                                            'text'=>"<i class='fa fa-info'></i> ".session('errorLogin') )) }}
                        @endif
                        <!--
                            <div class="form-group text-left">
                                <div class="checkbox checkbox-fill d-inline">
                                    <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
                                    <label for="checkbox-fill-a1" class="cr"> Save Details</label>
                                </div>
                            </div>
                        !-->
                        <button class="btn btn-primary shadow-2 mb-4">Acceder</button>
                        <!--
                        <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html">Reset</a></p>
                        <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html">Signup</a></p>
                        !-->
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection()
