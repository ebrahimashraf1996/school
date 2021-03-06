@extends('layouts.dashboard')
@section('title')
    الصفحة الرئيسية
@stop

@section('style')
    <style>

        .holder-container {
            background: white;
            padding: 25px;
            margin-top: 25px;
        }

        .holder-title {
            font-size: 20px;
            text-align: center;
            font-weight: bold;
            color: rgb(68, 66, 66);
            margin-bottom: 15px;
        }

        .video-container {
            height: 200px !important;
        }

        .gif-holder {
            display: flex;
            justify-content: center;
        }

        .intro-gif {
            border-radius: 120px;
            width: 250px;
            height: 250px;
            margin: 0 auto;
        }

        .hello-msg-holder {

            display: flex;
            justify-content: center;
            align-items: center;

        }

        .hello-msg {
            border-bottom: 2px solid rgb(211, 9, 60);
            padding-bottom: 5px;
            flex: 1;
        }

        .feature-holder {
            display: flex;
            flex-direction: row-reverse;
            flex-wrap: wrap;

        }

        .feature-img {
            height: 300px;
            width: 550px;
            margin: 5px;
        }

        .pic-font {
            font-size: 18px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex: 1;
        }


        @media only screen and (max-width: 600px) {
            .intro-gif {
                width: 200px;
                height: 200px;


            }

            .feature-img {
                height: 200px;
                width: 250px;
            }

            .pic-font {
                font-size: 16px;
                margin-top: 15px;
            }
        }
    </style>
@stop

@section('content')
    <div class="container">

        <div class="z-depth-2 holder-container">
            <!-- <div class="holder-title">فديو تعاريفي</div> -->
            <div class="gif-holder">
                <div class="">
                    <img class="intro-gif" src="https://i.gifer.com/1pIe.gif"/>
                </div>
            </div>

            <div style="margin-top:10px;text-align: center;font-size:19px"><b>مرحباً, </b> أستاذ {{auth() -> user() -> name}}</div>
            <div class="hello-msg-holder">
                <div style="flex:1"></div>
                <div class="hello-msg"></div>
                <div style="flex:1"></div>
            </div>
            <div style="margin-top:10px;text-align: center;font-size:19px;font-weight: bold">أهلاً بك في موقع سجلاتي
            </div>
        </div>

        <div style="margin-bottom:15px" class="z-depth-2 holder-container">
            <div class="holder-title">مميزات الموقع</div>
            <div>
                <div class="feature-holder" style="margin-top:20px">

                    <div class="pic-font">
                        يتيح موقع سجلاتي بناء سجل درجات خاص بفصولك بواجهة جذابة وسهلة التعامل
                    </div>

                    <img class="feature-img" src="{{asset('assets/front/images/1.jpg')}}"/>
                </div>

                <hr/>

                <div class="feature-holder" style="margin-top:20px">
                    <img class="feature-img" src="{{asset('assets/front/images/2.jpg')}}"/>

                    <div class="pic-font">
                        لوحة تحكم رائعة تستطيع من خلالها جلب أسماء طلابك وادارتها بكل سهولة
                    </div>
                </div>

                <hr/>

                <div class="feature-holder" style="margin-top:20px">

                    <div class="pic-font">
                        إدارة أعمدة السجلات من خلال إضافة العناوين وقيم الدرجات والمتوسط والمجموع واختصاراتها بنفسك دون
                        التقيد بعبارات معينة
                    </div>

                    <img class="feature-img" src="{{asset('assets/front/images/3.jpg')}}"/>
                </div>

                <hr/>

                <div class="feature-holder" style="margin-top:20px">
                    <img class="feature-img" src="{{asset('assets/front/images/4.jpg')}}"/>

                    <div class="pic-font">
                        باستطاعتك طباعة السجل او تصديره او ارساله عبر البريد الالكتروني الى الإدارة المدرسية
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
