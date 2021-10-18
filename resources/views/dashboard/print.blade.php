@extends('layouts.dashboard')
@section('title')
    سجلاتي :
    {{$class->name}} -
    {{$class->subject}}

@stop

@section('style')
    <link href="https://fonts.googleapis.com/css?family=Lateef&display=swap" rel="stylesheet">

    <style>


        th {
            text-align: center !important;
            border-right: 1px solid rgb(190, 190, 190) !important;
            border-left: 1px solid rgb(190, 190, 190) !important;
            border-top: 1px solid rgb(190, 190, 190) !important;
        }

        td {
            height: 35px; !important;
            text-align: center !important;
            border-right: 1px solid rgb(190, 190, 190) !important;
            border-left: 1px solid rgb(190, 190, 190) !important;
        }

        h6 {
            margin-top: 20px !important;
        }

        td {
            padding: 0 !important;
        }


        .m-result-row {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .s-result-row {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-end;
        }

        @media print {
            .noprint {
                display: none;

            }

            .noprint .btn {
                margin: 0 !important
            }

            h6 {
                margin-top: 15px !important;
            }
        }

    </style>
@stop

@section('content')
    <div class="container">

        <div class="row noprint">
            <a style="margin-top:15px;margin-right: 10px;" href="{{route('dashboard.categories.show', $class->id)}}"
               class="btn maroon">رجوع</a>
            <button style="margin-top:15px;" id="print-btn" class="btn blue">تصدير كـ pdf</button>



        </div>

        <div id="print-table">
            <div class="m-result-row">
                <h6>سجل درجات التقويم المستمر</h6>

                <h6>العام الدراسي: {{$user->year}}</h6>
            </div>

            <div class="row">

                <div class="s-result-row col s6">
                    <h6>
                        الفصل الدراسي :
                        {{$user->getTerm()}}                    </h6>

                    <h6>
                        إسم المعلم :
                        {{$user->name}}
                    </h6>
                </div>

                <div class="col s6">
                    <h6>
                        إسم الفصل :
                        {{$class->name}}
                    </h6>

                    <h6>
                        إسم المادة :
                        {{$class->subject}}
                    </h6>
                </div>


            </div>

            <div class="row">
                <table style="direction:rtl;border-top: 1px solid rgba(0,0,0,0.12);" id="user-table"
                       class="display right-align">
                    <thead>
                    <tr>

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


                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($students) && $students->count() > 0)
                        @foreach($students as $student)
                            <tr>

                                <td style="width: 200px">{{$student->name}}</td>

                                @foreach($student->columns as $item)
                                    @if($item->type == 1)
                                        <td>{{$item->pivot->student_degree}}
                                        </td>
                                    @elseif($item->type == 3 )
                                        <td style="background:#a2a2a2;">{{$item->pivot->student_degree}}
                                        </td>
                                    @elseif($item->type == 2 )
                                        <td style="background: #d9d9d9;">{{$item->pivot->student_degree / getCountOfAvgChildren($item->id)}}
                                        </td>
                                @endif
                            @endforeach



                            <!-- </form> -->
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>

            </div>

            <div class="left-align">
                المدرسة: {{$user->school}}
            </div>
        </div>


    </div>

@stop

@section('script')
    <script>

        $(document).ready(function () {
            $('.modal').modal();
        });

        $('#print-btn').click((e) => {
            let printContents = document.getElementById('print-table').innerHTML;
            let originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        })
    </script>
@stop
