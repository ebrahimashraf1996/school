@extends('layouts.dashboard')
@section('title')
    سجلاتي - الفصل : {{$class->name}}
@stop

@section('style')
    <style>
        .row {
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .control-btn {
            margin: 5px;
        }

        th {
            text-align: center;
            padding: 0;
        }

        td {
            text-align: center;
        }

        td .btn {
            margin: 2px;
        }

        .student-input {
            width: 50px !important;
            border-bottom: none !important;
            text-align: center;
        }

        .student-input:focus {
            border-bottom: lightblue solid 1px;
        }

        .input-student-name {
            text-align: center;
            width: 200px !important;
            direction: rtl;
            border-bottom: none !important;
        }
    </style>
    <script>
        // function getInput(student, col) {
        //     if (student.booklet[col].type == 'number') {
        //         return student.booklet[col].value
        //     }
        //
        //     if (student.booklet[col].type == 'avg') {
        //         if (!student.booklet[col]) {
        //             return col
        //         }
        //         let total = 0
        //         for (let i = 0; i < student.booklet[col].inputColumns.length; i++) {
        //
        //             total += parseFloat(getInput(student, student.booklet[col].inputColumns[i]))
        //         }
        //         return total / student.booklet[col].inputColumns.length
        //     } else if (student.booklet[col].type == 'total') {
        //         let total = 0
        //         if (!student.booklet[col]) {
        //             return col
        //         }
        //         for (let i = 0; i < student.booklet[col].inputColumns.length; i++) {
        //             total += parseFloat(getInput(student, student.booklet[col].inputColumns[i]))
        //         }
        //         return Math.round(total)
        //     }
        // }
    </script>
@stop

@section('content')

    <div class="container" style="margin-top: 50px">

        @include('dashboard.includes.alerts.success')
        @include('dashboard.includes.alerts.errors')

        <div class="row">
            <a href="{{route('class.print', $class->id)}}" class="btn teal col l2 s5 offset-3 control-btn" style="width: auto"> معاينة السجل
                وطباعته</a>

            {{--            class id here route('dashboard.categories.addStudents', $class->id)--}}
            <a href="{{route('dashboard.categories.manageColumns', $class->id)}}"
               class="btn indigo col l2 s5 control-btn">إدارة الأعمدة</a>

            {{--            class id here route('dashboard.categories.addStudents', $class->id)--}}
            <a href="{{route('dashboard.categories.addStudents', $class->id)}}" class="btn green col l2 s5 control-btn">إضافة
                طلاب</a>


            <h5 style="text-align: right ; color:blue">
                {{$class->name}} - {{$class->subject}}
            </h5>
        </div>

        <form method="POST" action="{{route('dashboard.categories.updateStudentDetails', $class->id)}}"
              style="margin-top: 50px">
            @csrf
            <button type="submit" class="btn green col l2 s5 control-btn left" style="margin-bottom: 30px; width: 17%">
                حفظ التغيرات
            </button>

            <div class="row">
                <table style="direction:rtl;border-top: 1px solid rgba(0,0,0,0.12);" id="user-table"
                       class="display right-align">
                    <thead>
                    <tr>

                        <th style="padding:10px 0;width: 0"><a style="margin: 0;color:white"
                                                               href="{{route('dashboard.categories')}}"
                                                               class="btn maroon">رجوع</a></th>
                        <th>الاسم</th>


                        @if(isset($columns) && $columns->count() > 0)
                            @foreach($columns as $column)
                                <th
                                    @if($column->type == 3) style="background:#a2a2a2;"
                                    @elseif($column->type == 2)style="background:#d9d9d9;"
                                    @endif
                                >{{$column->name}}
                                    <br>
                                    ({{$column->column_degree}})
                                </th>
                            @endforeach
                        @endif

                        <th>الخيارات</th>

                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($students) && $students->count() > 0)
                        @foreach($students as $student)
                            <tr>
                                <!-- <form action="/editstudent/" method="POST"> -->
                                <td>
                                </td>
                                <td style="width: 200px"><input class="input-student-name" type="text"
                                                                name="name_{{$student->id}}"
                                                                value="{{$student->name}}"
                                                                required/></td>

                                @foreach($student->columns as $item)
                                    @if($item->type == 1)
                                        <td><input class="student-input
                                            {{$item->pivot->student_id}}_{{$item->pivot->column_id}}_child_of_{{$item->parent_id_sum}}
                                            {{$item->pivot->student_id}}_{{$item->pivot->column_id}}_child_of_{{$item->parent_id_avg}}" type="text"
                                                   name="student_degree_{{$item->pivot->student_id}}_{{$item->pivot->column_id}}_child_of_{{$item->parent_id_sum}}_{{$item->parent_id_avg}}"
                                                   value="{{$item->pivot->student_degree}}"
                                                   required/>
{{--                                            {{$item->pivot->student_id}}_{{$item->pivot->column_id}}_child_of_{{$item->parent_id_sum}}--}}
{{--                                            _{{$item->parent_id_avg}}--}}
                                        </td>
{{--                                        29_child_of_41_42--}}
                                        {{--                                        <input type="text" name="student_degree_70_37_child_of_41_42">--}}
                                    @elseif($item->type == 3 )
                                        <td style="background:#a2a2a2;">{{$item->pivot->student_degree}}
                                        </td>
                                    @elseif($item->type == 2 )
                                        <td style="background: #d9d9d9;">{{$item->pivot->student_degree / getCountOfAvgChildren($item->id)}}
                                        </td>
                                    @endif
                                @endforeach

                                <td>
                                    {{--                                student id--}}
                                    <a href="#{{$student->id}}" class="btn red modal-trigger"><i
                                            class="material-icons">delete</i></a>
                                    {{--                                student id--}}
                                    <div id="{{$student->id}}" style="direction:rtl" class="modal">
                                        <div class="modal-content">
                                            <h4>حذف الطالب</h4>

                                            <p>هل أنت متاكد انك تريد حذف هذا الطالب</p>


                                            <div class="row">
                                                {{--  here form delete with column id --}}
                                                <a href="{{route('dashboard.categories.destroyStudent', ['classId' => $column->category_id , 'studentId' => $student->id])}}" class="btn red">تأكيد</a>

                                                <a href="#" class="btn green modal-action modal-close">الغاء</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>


                                <td><h6></h6></td>
                                <!-- </form> -->
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </form>

    </div>

@stop
@section('script')

    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


    <script>

        $(document).ready(function () {
            $('#user-table').DataTable({
                searching: true,
                ordering: true
            });
        });

        $(document).ready(function () {
            $('.modal').modal({});
        });
    </script>
@stop
