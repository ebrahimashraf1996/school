@extends('layouts.dashboard')
@section('title')
    سجلاتي - الفصول
@stop

@section('style')
    <style>
        .row {
            margin-top: 15px;
            display: flex;
            flex-flow: row-reverse wrap;
            padding: 5px;
            align-content: flex-end;
            justify-content: flex-end;
        }

        .class-card {
            padding: 25px 0 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 5px;
            flex-basis: 32%;

        }

        .class-icon {
            width: 80px;
            height: 80px;
            padding: 10px;
            border-radius: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        @media only screen and (max-width: 992px) {
            .class-card {
                flex-basis: 47%;
            }
        }

        @media only screen and (max-width: 600px) {
            .class-card {
                flex-basis: 100%;
            }
        }
    </style>
@stop

@section('content')
    <div class="container">

        @include('dashboard.includes.alerts.success')
        @include('dashboard.includes.alerts.errors')

        <h5 style="text-align: center ; color:green; margin-top: 40px">
            مرحباً أستاذ, {{auth() -> user() -> name}}
        </h5>

        <a href="#modal" class="btn green  waves-effect waves-light btn modal-trigger"><i
                class="material-icons">add</i><span
                style="position: relative;bottom: 5px">إضافة فصل</span></a>


        <div class="row">

            <div id="modal" style="direction:rtl" class="modal">
                <div class="modal-content">
                    <h4 style="text-align: center">إضافة فصل</h4>
                    <form action="{{route('dashboard.categories.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" name="name" autocomplete="off" type="text" class="validate" required>
                                <label for="name">اسم الفصل</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="subject" name="subject" autocomplete="off" type="text" class="validate"
                                       required>
                                <label for="subject">المادة الدراسية</label>
                            </div>
                        </div>


                        <div class="row">
                            <button type="submit" style="align: center" class="btn green">إضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(isset($classes) && $classes->count() > 0)

            <div class="row" dir="rtl">
                @foreach($classes as $class)
                    <div class=" white z-depth-1 class-card">
                        <div class="class-icon blue">
                            <i style="font-size:45px" class="material-icons">menu_book</i>
                        </div>
                        <div style="margin-top:15px;">
                            <b>الفصل:</b>
                            {{$class->name}}
                        </div>

                        <div style="margin-top:15px;">
                            <b>المادة:</b>
                            {{$class->subject}}

                        </div>

                        {{--class id--}}
                        <div id="{{$class->id}}" style="direction:rtl;text-align: center" class="modal">
                            <div class="modal-content">
                                <h4>حذف الفصل</h4>

                                <p>هل أنت متاكد انك تريد حذف هذا الفصل؟</p>


                                <div style="display:flex;justify-content:center">
                                    {{--                            change this anchor to a delete form--}}
                                    {{--class id--}}<a href="{{route('dashboard.categories.delete', $class->id)}}" style="margin:5px"
                                                       class="btn red">تأكيد</a>
                                    <a href="#classModal" style="margin:5px"
                                       class="btn green modal-action modal-close">الغـاء</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">


                            {{-- Delete  class id--}}<a href="#{{$class->id}}"
                                                        style="margin:0 2px;margin-top:10px; font-size: 15px"
                                                        class="btn red modal-trigger">حذف</a>


                            {{-- Copy  class id--}} <a href="{{route('dashboard.categories.repeat', $class->id)}}"
                                                       style="margin:0 2px;margin-top:10px; font-size: 15px; background: #12bc1f;"
                                                       class="btn">تكرار</a>

                            {{--  Edit  class id--}} <a href="{{route('dashboard.categories.edit', $class->id)}}"
                                                        style="margin:0 2px;margin-top:10px; font-size: 15px; background: #bc71a3;"
                                                        class="btn">تعديل</a>


                            {{--  Show  class id--}} <a href="{{route('dashboard.categories.show', $class->id)}}"
                                                        style="margin:0 2px;margin-top:10px; font-size: 15px;"
                                                        class="btn blue">عرض</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@stop
@section('script')
    <script>
        $(document).ready(function () {
            $('.modal').modal();
        });
    </script>

@stop
