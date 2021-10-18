@extends('layouts.dashboard')
@section('title')
    سجلاتي - إدارة الرسائل
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




        <table style="direction:rtl" id="user-table" class="display right-align">
            <thead>
            <tr>
                <th>اسم الراسل</th>
                <th>البريد الالكتروني</th>
                <th>الرسالة</th>
                <th>الخيارات</th>
            </tr>
            </thead>
            <tbody>

            @if(isset($messages) && $messages->count() > 0)
                @foreach($messages as $message)
                    <tr>
                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->message}}</td>
                        <td>
                            {{--   column id here--}}
                            <a href="#{{$message->id}}" class="btn red modal-trigger">حذف</a>

                            {{--   column id here--}}
                            <div id="{{$message->id}}" style="direction:rtl" class="modal">
                                <div class="modal-content">
                                    <h4>حذف الرسالة</h4>

                                    <p>هل أنت متاكد انك تريد حذف هذا الرسالة ؟</p>


                                    <div class="row">
                                        {{--  here form delete with column id --}}
                                        <a href="{{route('messages.delete', $message->id)}}" class="btn red">تأكيد</a>

                                        <a href="#" class="btn green modal-action modal-close">الغاء</a>
                                    </div>
                                </div>
                            </div>
                        </td>



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
