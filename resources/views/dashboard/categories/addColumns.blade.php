@extends('layouts.dashboard')
@section('title')
    سجلاتي - إضافة عمود
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
            إضافة عمود
        </h6>

    </small>



    <div class="container">
        {{--    class id here route('dashboard.categories.manageColumns')--}}
        <a href="{{route('dashboard.categories.manageColumns', $class->id)}}"
           class="btn maroon left">
            رجوع
        </a>
        <div style="margin-top:20px;" class="row">
            <form class="col s12" method="POST" action="{{route('dashboard.categories.storeColumns',$class->id)}}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate" required>
                        <label for="name"> الاسم</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="short" name="slug" type="text" class="validate" required>
                        <label for="short"> الاختصار</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="value" name="column_degree" type="text" class="validate">
                        <label for="value"> الدرجة</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="desc" name="description" type="text" class="validate" required>
                        <label for="desc">الوصف</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <select id="type-select" name="type">
                            <option value="1">حقل رقم</option>

                            @if($numColumns->count() < 2){

                            <option value="2" disabled>متوسط</option>
                            <option value="3" disabled>مجموع</option>

                            @else

                                <option value="2">متوسط</option>
                                <option value="3">مجموع</option>
                            @endif


                        </select>
                        <label>النوع</label>
                    </div>

                </div>

                <input type="hidden" name="classId" value="{{$class->id}}"/>
                <input type="text" name="equal" value="" id="equal" hidden>


                <div style="display:none" id="input-columns-2" class="row">
                    @if(isset($numColumns) && $numColumns->where('parent_id_avg', null)->count() > 1)

                        <h6>اختار أعمدة الادخال</h6>


                        <!--               foreach columns name -->
                        @foreach($numColumns as $column)
                            <p>
                                @if($column->parent_id_avg == null)
                                    {{--                            <label><input class="filled-in" name="input-columns" type="checkbox" /><span>{{$column->column_degree}}</span></label>--}}
                                    <label><input class="col_class filled-in" name="child_id[{{$column->id}}]"
                                                  type="checkbox"
                                                  value="{{$column->column_degree}}"/><span>{{$column->name}}</span></label>
                                @endif
                            </p>
                        @endforeach
                    @else
                        <h6>لا يوجد اعمدة</h6>
                    @endif

                </div>


                <div style="display:none" id="input-columns-3" class="row">
                    @if(isset($numColumns) && $numColumns->where('parent_id_sum', null)->count() > 1)

                        <h6>اختار أعمدة الادخال</h6>


                        <!--               foreach columns name -->
                        @foreach($numColumns as $column)
                            <p>
                                @if($column->parent_id_sum == null)

                                    {{--                            <label><input class="filled-in" name="input-columns" type="checkbox" /><span>{{$column->column_degree}}</span></label>--}}
                                    <label><input class="col_class filled-in" name="child_id[{{$column->id}}]"
                                                  type="checkbox"
                                                  value="{{$column->column_degree}}"/><span>{{$column->name}}</span></label>
                                @endif
                            </p>
                        @endforeach
                    @else
                        <h6>لا يوجد اعمدة</h6>
                    @endif

                </div>
                <button id="submit-btn" class="btn col s4 offset-s4 c green">إضافة</button>
            </form>
        </div>
    </div>

@stop
@section('script')
    <script>


        $('#type-select').on('change', (e) => {

            if ($('#type-select').val() === '2') {
                $('#input-columns-2').css('display', 'block')
            } else {
                $('#input-columns-2').css('display', 'none')
            }
            if ($('#type-select').val() === '3') {
                $('#input-columns-3').css('display', 'block')
            } else {
                $('#input-columns-3').css('display', 'none')
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


        $('input:checkbox').change(function () {
            let total = 0;
            $('input:checkbox:checked').each(function () { // iterate through each checked element.
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


