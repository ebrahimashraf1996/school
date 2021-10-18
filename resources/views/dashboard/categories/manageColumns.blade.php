@extends('layouts.dashboard')
@section('title')
    سجلاتي - إدارة الأعمدة
@stop

@section('style')
    <style>

        .btn {
            margin: 5px;
        }

        th {
            text-align: center;
        }

        .row {
            margin: 10px;
        }

        td {
            text-align: center
        }

    </style>

@stop

@section('content')
    <div class="container">

        @include('dashboard.includes.alerts.success')
        @include('dashboard.includes.alerts.errors')

        <div class="row" style="display:flex">

            {{-- class id here route('dashboard.categories.addColumns', $class->id)--}}
            <a href="{{route('dashboard.categories.addColumn', $class->id)}}" class="btn green col waves-effect btn">
                <i class="material-icons">add</i>
                <span style="position: relative;bottom: 5px">إضافة عمود</span>
            </a>
        </div>

        <div class="row">
            <a href="{{route('dashboard.categories.show', $class->id)}}"><h5>{{$class->name}} - {{$class->subject}}</h5></a>
        </div>
        <table style="direction:ltr" id="user-table" class="display right-align">
            <thead>
            <tr>
                <th>الخيارات</th>
                <th>الوصف</th>
                <th>الدرجة</th>
                <th>الاختصار</th>
                <th>النوع</th>
                <th>الاسم</th>
            </tr>
            </thead>
            <tbody>

            @if(isset($columns) && $columns->count() > 0)
                @foreach($columns as $column)
                    <tr>
                        <td>
                            {{--   column id here--}}
                            <a href="#{{$column->id}}" class="btn red modal-trigger">حذف</a>

                            {{-- here we send class id and column id --}}
                            <a href="{{route('dashboard.categories.editColumn', ['classId' => $column->category_id , 'columnId' => $column->id])}}" class="btn green">تعديل</a>

                            {{--   column id here--}}
                            <div id="{{$column->id}}" style="direction:rtl" class="modal">
                                <div class="modal-content">
                                    <h4>حذف العمود</h4>

                                    <p>هل أنت متاكد انك تريد حذف هذا العمود</p>


                                    <div class="row">
                                        {{--  here form delete with column id --}}
                                        <a href="{{route('dashboard.categories.destroyColumn', ['classId' => $column->category_id , 'columnId' => $column->id])}}" class="btn red">تأكيد</a>

                                        <a href="#" class="btn green modal-action modal-close">الغاء</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{$column->description}}</td>
                        <td>{{$column->column_degree}}</td>
                        <td>{{$column->slug}}</td>
                        <td>{{$column->getType()}}</td>
                        <td>{{$column->name}}</td>


                    <td><h6></h6></td>
                </tr>
                @endforeach

            @endif
            </tbody>
        </table>

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
