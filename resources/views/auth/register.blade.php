@extends('layouts.site')
@section('title')
    سجلاتي - تسجيل جديد
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

            .login-container {
                margin-top: 10% !important;
                padding: 25px;
            }

        </style>
    @stop

@section('content')
    <div class="container z-depth-2 login-container">


        @include('site.includes.alerts.success')
        @include('site.includes.alerts.errors')

        <form class="col s12" action="{{ route('register') }}" method="POST">
            @csrf
            <h4 class="center-align">تسجيل حساب جديد</h4>

            <div class="row">
                <div class="input-field col s12">
                    <input style="direction:rtl;" id="username" name="name" type="text" class="validate"
                           value="{{ old('name') }}" required>
                    <label for="username"> الإسم</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="email" class="validate" value="{{ old('email') }}">
                    <label for="email">البريد الالكتروني</label>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s12">
                    <input id="password" name="password" type="password" class="validate" required>
                    <label for="password">كلمة السر</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password-confirm" name="password_confirmation" autocomplete="new-password" type="password" class="validate" required>
                    <label for="password">تأكيد كلمة السر</label>
                </div>
            </div>



            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" style="width:100%" class="btn btn-block green"> تسجيل </button>
                </div>
                <div class="right-align row" >
                    <a href="{{route('login')}}">لديك حساب سابقا</a>
                </div>
            </div>

        </form>
    </div>

    @stop


