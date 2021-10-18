@extends('layouts.dashboard')
@section('title')
    سجلاتي - تعديل عمود
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
            تعديل عمود -{{$column->name}}
        </h6>

    </small>



    <div class="container">
        {{--    class id here route('dashboard.categories.manageColumns')--}}
        <a href="{{route('dashboard.categories.manageColumns', $column->category_id)}}"
           class="btn maroon left">
            رجوع
        </a>
        <div style="margin-top:20px;" class="row">
            <form class="col s12" method="POST" action="{{route('dashboard.categories.updateColumn',['classId' => $column->category_id , 'columnId' => $column->id])}}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate" value="{{$column->name}}" required>
                        <label for="name"> الاسم</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="short" name="slug" type="text" class="validate" value="{{$column->slug}}" required>
                        <label for="short"> الاختصار</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="value" name="column_degree" type="text" class="validate" value="{{$column->column_degree}}">
                        <label for="value"> الدرجة</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="desc" name="description" type="text" class="validate" required value="{{$column->description}}">
                        <label for="desc">الوصف</label>
                    </div>
                </div>

                <input type="hidden" name="classId" value="{{$column->category_id}}"/>



                <button id="submit-btn" class="btn col s4 offset-s4 c green">تعديل</button>
            </form>
        </div>
    </div>

@stop
@section('script')
    <script>


        $('#type-select').on('change', (e) => {

            if ($('#type-select').val() === '2' || $('#type-select').val() === '3') {
                $('#input-columns').css('display', 'block')
            } else {
                $('#input-columns').css('display', 'none')
            }


        })

        //
        // $('input:radio[name="type"]').change(
        //     function () {
        //         if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
        //             $('#input-columns').removeClass('hidden');
        //
        //         } else if (this.checked && this.value == '3') {
        //             $('#input-columns').removeClass('hidden');
        //
        //         } else {
        //             $('#input-columns').addClass('hidden');
        //         }
        //     });


        $('input:checkbox').change(function ()
        {
            let total = 0;
            $('input:checkbox:checked').each(function(){ // iterate through each checked element.
                total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
            });
            $("#equal").val(total);

        });




        {{--$('#addcolumnform').submit((e) => {--}}
        {{--    e.preventDefault();--}}
        {{--    $('#submit-btn').attr('disabled', 'disabled')--}}


        {{--    let name = $('input[name="name"]').val();--}}
        {{--    let slug = $('input[name="slug"]').val();--}}
        {{--    let description = $('input[name="description"]').val();--}}
        {{--    let column_degree = $('input[name="column_degree"]').val();--}}
        {{--    let type = $('#type-select').val()--}}
        {{--    let classId = $('input[name="classId"]').val();--}}



        {{--    let req = $.post("{{route('dashboard.categories.storeColumns',$class->id)}}", {name, slug, description, type, classId, column_degree})--}}

        {{--    req.done((res) => {--}}
        {{--        if (res === 'done') {--}}
        {{--            window.location.href = '/classes/' + classId + '/manageColumns'--}}
        {{--        } else if (res === 'error') {--}}
        {{--            M.toast({html: 'العمود موجود مسبقاً الرجاء إضافة إسم أخر'})--}}
        {{--        } else if (res === 'limit') {--}}
        {{--            M.toast({html: 'عدد الأعمدة 15 لا يمكننك إضافة المزيد من الأعمدة'})--}}
        {{--        }--}}

        {{--        $('#submit-btn').removeAttr('disabled')--}}
        {{--    })--}}
        {{--})--}}


    </script>

@stop


