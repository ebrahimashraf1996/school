@extends('layouts.dashboard')
@section('title')
    سجلاتي - إضافة طلاب
@stop

@section('style')

@stop

@section('content')


    <br><br>
    <small>

        <h6 style="text-align: center;color:blue"><i class="material-icons">file_copy</i>
            بإمكانك لصق مجموعة من الطلاب مرة واحدة

        </h6>

    </small>


    <div class="container">
        {{--    class id here route('dashboard.categories.show')--}}
        <a href="{{route('dashboard.categories.show', $class->id)}}"
           class="btn maroon left">
            رجوع
        </a>
        <div style="margin-top:20px;" class="row">
            <form class="col s12" method="POST" action="{{route('dashboard.categories.storeStudents', $class->id)}}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="category_id" value="{{$class->id}}" hidden>
                        <textarea name="name" id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">إضافة طلاب</label>
                    </div>
                </div>
                <button class="btn green">إضافة</button>
            </form>
        </div>
    </div>

@stop
@section('script')

@stop


