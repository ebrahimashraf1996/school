@extends('layouts.dashboard')
@section('title')
    سجلاتي - تعديل بيانات المعلم
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
            margin-top: 0;
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
            تعديل بيانات المعلم -{{auth()->user()->name}}
        </h6>

    </small>


    <div class="container">

        <form id="addcolumnform" method="POST" enctype="multipart/form-data" action="{{route('info.update', $user->id)}}">
            @csrf
            <input type="text" name="id" value="{{$user->id}}" hidden>
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" value="{{$user->name}}" class="validate"
                           required>
                    <label for="name"> الاسم</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="school" name="school" type="text" value="{{$user->school}}" class="validate"
                           required>
                    <label for="school"> المدرسة</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="email" value="{{$user->email}}" class="validate"
                           required>
                    <label for="email"> البريد الالكتروني</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" name="password" type="password" value="" class="validate">
                    <label for="email"> ادخل كلمة السر الجديدة (اختياري)</label>
                </div>
            </div>
            <div class="row">
                <label for="image"> الصورة الشخصية</label>
                <div class="input-field col s12">
                    <input type="file" class="form-control mt-3" name="photo" placeholder="photo" >
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <select id="" name="year">
                        <?php
                        $currentYear = date('Y');
                        foreach (range(2030, $currentYear) as $value) {
                            $pastYear = $value - 1;
                            ?>
                            <option value="{{$value}}_{{$pastYear}}" {{$user->year == $value.'_'.$pastYear ? 'selected' : ''}}>{{$value}}-{{$pastYear}}</option >
                        <?php
                            }
                        ?>
                    </select>
                    <label>السنة الدراسية</label>
                </div>

            </div>

            <div class="row">
                <div class="input-field col s12">
                    <select id="type-select" name="term">


                        <option value="1" {{$user->term == 1 ? 'selected' : ''}}>الفصل الأول</option>
                        <option value="2" {{$user->term == 2 ? 'selected' : ''}}>الفصل الثاني</option>

                    </select>
                    <label>الفصل الدراسي</label>
                </div>

            </div>

            <div class="row">
                <button class="btn col s4 offset-s4 c blue">حفظ</button>
            </div>
        </form>

    </div>

@stop
@section('script')
    <script>

    </script>

@stop


