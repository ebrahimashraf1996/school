<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('site.includes.header')

    @yield('style')
</head>

<body>

@include('site.includes.navbar')

@yield('content')

{{--@include('site.includes.footer')--}}

@yield('script')
</body>

</html>
