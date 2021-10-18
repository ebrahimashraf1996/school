@extends('layouts.site')
@section('title')
    سجلاتي - تسجيل الدخول
@stop

@section('style')
    <style>

        .alert-message {
            padding: 12px;
            background: rgba(218, 125, 125, 0.5);
            margin: 0 10px;
            color: rgb(216, 71, 71);
            font-size: 17px;
            text-align: center;
        }

        .success-message {
            padding: 12px;
            background: rgba(159, 218, 125, 0.5);
            margin: 0 10px;
            color: rgb(93, 216, 71);
            font-size: 17px;
            text-align: center;
        }

        .login-container {
            margin-top: 10% !important;
            padding: 25px;
        }

    </style>

@stop

@section('content')
    <div class="container z-depth-2 login-container">
        <form class="col s12" action="{{ route('login') }}" method="POST">
            @csrf

            <h4 class="center-align">تسجيل الدخول</h4>

            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email"  autocomplete="off" type="email" class="validate"
                           {{ old('email') }} required>
                    <label for="email">البريد الإلكتروني</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password" autocomplete="off" name="password" type="password" class="validate" required>
                    <label for="password">كلمة السر</label>
                </div>
            </div>


            <div class="right-align row">
                <a href="{{route('register')}}">تسجيل حساب جديد</a>
            </div>


            @include('site.includes.alerts.success')
            @include('site.includes.alerts.errors')


            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" style="width:100%" class="btn btn-block indigo"> تسجيل دخول</button>
                </div>
            </div>

        </form>
    </div>

@stop
