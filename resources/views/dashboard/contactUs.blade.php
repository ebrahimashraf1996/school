@extends('layouts.dashboard')
@section('title')
    اتصل بنا
@stop

@section('style')
    <style>

        .holder-container {
            background: white;
            padding: 25px;
            margin-top: 25px;
        }

        .con-text {
            text-align: center;
        }

        .con-text i {
            font-size: 18rem;
            margin-right: 12rem;
            margin-top: 2rem;
        }

        .form-container {
            background-color: #fff;
            padding-left: 35px;
            padding-right: 35px;
            padding-top: 35px;
            padding-bottom: 50px;
            width: 70rem;
            float: left;
            position: absolute;
            margin-top: 22px;
            margin-left: -260px;
            -webkit-border-radius: 7px;
            box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
            text-align: center;
            display: flex;
        }

        .form-container .send-mail {
            margin-right: 6rem;
            margin-top: 6rem;
        }

        .send-mail .inp {
            border: 1px solid #26a69a;
            border-radius: 1rem;
            padding-right: 5px;
            background-color: #fff;
            width: 22rem;
        }

        .btn-send {
            padding: 0.5rem;
            margin-top: 0.5rem;
            border-radius: 2rem;
            border: none;
            background-color: #4CAF50;
            color: #fff;
            width: 10rem;
            height: 3rem;
            font-size: 1.2rem;
            font-weight: bolder;
        }

        .btn-send:hover {
            background-color: #59c95c;
        }

        .call-text {
            background-color: #4CAF50;
            width: 70rem;
            padding: 0.3rem;
            margin-top: 0.8rem;
            border-radius: 1rem;
            text-align: center;
        }

        .suc {
            background-color: rgba(46, 239, 127, 0.6);
            padding: 0.1rem;
            margin-top: 0.5rem;
            border-radius: 1rem;
        }

        .err {
            background-color: rgba(240, 3, 3, 0.6);
            padding: 0.1rem;
            margin-top: 0.5rem;
            border-radius: 1rem;
        }

        ::placeholder {
            color: #000;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="call-text"><h3 style="font-weight: bolder; margin-bottom: 1.5rem;color:white">تواصل معنا</h3>
        </div>
        @include('dashboard.includes.alerts.success')
        @include('dashboard.includes.alerts.errors')
        <div class="form-container">
            <form class="col-md-6" style="margin: 10px">
                <div style="text-align: center;">
                    يمكنك التواصل معنا .. ونسعد بآرائكم
                </div>
                <br>
                <br>
                <div style="text-align: center;">
                    مؤكدين حرصنا التام في الرد على استفساراتكم
                </div>
                <br>
                <hr>
                <br>

                <h6>
                    ا.جمال السناني
                    <br>
                    <br>
                    Email: jamalsinani@gmail.com
                    <br>
                    <br>
                    Tel: 968-99636239
                </h6>

                <br>
                <img src="{{asset('assets/front/images/556666619949e-447a-4ba2-8384-0a54cb4f0cf7.png')}}"
                     style="width: 25rem;margin-center: 7rem;margin-top: 4rem;">
            </form>
            <form class="col-md-6" style="margin: 10px 100px 10px 10px; text-align: center"
                  action="{{route('contact.post')}}" method="POST"
                  data-wow-offset="100">
                <h4>راسلنا مباشرة</h4>
                @csrf

                <div class="row">
                    <label for="textarea1" style="">اجعل رسالتك بناءة</label>

                    <textarea name="message" id="textarea1" class="materialize-textarea"
                              style="margin-top: 15px;height: 200px; width: 400px; border: black 1px solid "></textarea>
                </div>
                <button class="btn blue">إرسال</button>

            </form>
        </div>

    </div>

@stop

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@stop




