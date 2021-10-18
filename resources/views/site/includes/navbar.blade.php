<style>
    .nav-wrapper a {
        color: black;
    }

    .nav-wrapper .btn {
        color: white;
    }

    .nav-icon {
        padding: 5px;
        width: 40px;
        height: 40px;
        border-radius: 40px;
        display: inline-block;
        position: relative;
        top: 10px;

    }

    .book-icon {
        position: relative;
        bottom: 14px;
        left: 3px;
    }

</style>


<nav class="white">
    <div class="nav-wrapper container">
        <a href="{{route('front.home')}}" class="brand-logo left" style="position: relative;">
            <div class="nav-icon green left" style="margin-right: 15px">
                <i class="material-icons white-text book-icon">book</i>
            </div>
            <span class="logo-text">سجلاتي</span>
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">


            <li><a href="{{route('login')}}" class="btn green">تسجيل الدخول</a></li>
            <li><a href="{{ route('register') }}" class="btn light-blue"> تسجيل جديد</a></li>
            <li><a href="{{route('contact')}}" class="btn orange">اتصل بنا</a></li>

        </ul>

        <a href="#" data-target="sidebar" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
    </div>
</nav>

<ul class="sidenav" style="direction:ltr;" id="sidebar">
    <li><a style="text-align:right" href="{{route('login')}}">تسجيل الدخول</a></li>
    <li><a style="text-align:right" href="{{route('register')}}">تسجيل جديد</a></li>
    <li><a style="text-align:right" href="{{route('contact')}}">اتصل بنا</a></li>
</ul>

<script>
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });
</script>
