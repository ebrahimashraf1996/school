<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        .notify_par {
            margin-right: 1.5rem !important;
            margin-left: 1.5rem !important;
            flex-wrap: wrap;
            box-sizing: border-box;
            word-wrap: break-word;
            font-family: 'Cairo', sans-serif;
            background-color: white;
        }
        .notify_btn {
            cursor: pointer;
            background-color: transparent;
            color: green;
            display: block;
            width: 100%;
            padding: 1rem 1.25rem;
            font-size: 1.25rem;
            line-height: 1.25;
            border-radius: 0.35rem;
            background-image: none;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            user-select: none;
            border: 1px solid green;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            -webkit-appearance: button;
            text-transform: none;
            overflow: visible;
        }
        .notify_par :hover {
            color: white;
            background: green;
        }
        .notify_err {
            margin-right: 1.5rem !important;
            margin-left: 1.5rem !important;
            flex-wrap: wrap;
            box-sizing: border-box;
            word-wrap: break-word;
            font-family: 'Cairo', sans-serif;
            background-color: white;
        }
        .notify_btn_err {
            cursor: pointer;
            background-color: transparent;
            color: #f11f1f;
            display: block;
            width: 100%;
            padding: 1rem 1.25rem;
            font-size: 1.25rem;
            line-height: 1.25;
            border-radius: 0.35rem;
            background-image: none;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            user-select: none;
            border: 1px solid #f11f1f;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            -webkit-appearance: button;
            text-transform: none;
            overflow: visible;
        }
        .notify_err :hover {
            color: white;
            background: #f11f1f;
        }
    </style>
    @include('dashboard.includes.header')

    @yield('style')
</head>

<body>

@include('dashboard.includes.navbar')

@yield('content')

{{--@include('dashboard.includes.footer')--}}

@yield('script')
</body>

</html>
