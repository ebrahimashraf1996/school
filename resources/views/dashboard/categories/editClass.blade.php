@extends('layouts.dashboard')
@section('title')
    سجلاتي - تعديل فصل
@stop

@section('style')
    <style>
        body {
            background: whitesmoke;
        }

        .row {
            margin-top: 20px;
        }

        .container {
        }

        .back-btn {
            margin-left: 25px;
            cursor: pointer;
        }

        .brand-logo {
            color: black !important;
        }

        .dropdown-content li {
            text-align: center;

        }

        .select-wrapper input.select-dropdown {
            text-align: center;
        }
    </style>

@stop

@section('content')


    <br><br>
    <small>

        <h6 style="text-align: center;color:blue"><i class="material-icons">file_copy</i>
            تعديل فصل -{{$class->name}}
        </h6>

    </small>



    <div class="container">
        {{--    class id here route('dashboard.categories.manageColumns')--}}
        <a href="{{route('dashboard.categories')}}"
           class="btn maroon left">
            رجوع
        </a>
        <div style="margin-top:20px;" class="row">
            <form class="col s12" method="POST" action="{{route('dashboard.categories.update', $class->id)}}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate" value="{{$class->name}}" required>
                        <label for="name"> اسم الفصل</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="short" name="subject" type="text" class="validate" value="{{$class->subject}}" required>
                        <label for="subject"> المادة الدراسية</label>
                    </div>
                </div>

                <input type="hidden" name="classId" value="{{$class->id}}"/>



                <button id="submit-btn" class="btn col s4 offset-s4 c green">تعديل</button>
            </form>
        </div>
    </div>

@stop
@section('script')
    <script>

    </script>

@stop


