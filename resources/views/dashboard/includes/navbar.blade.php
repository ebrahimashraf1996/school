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

    .logout {
        color: red;
    }

</style>


<nav class="white">
    <div class="nav-wrapper container">
        <a href="/" class="brand-logo left" style="position: relative;">
            <div class="nav-icon green left" style="margin-right: 15px">
                <i class="material-icons white-text book-icon">book</i>
            </div>
            <span class="logo-text">سجلاتي</span>
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a style="text-align:right" href="{{route('teacher.home')}}">الرئيسية</a></li>
            <li><a href="{{route('contact.view')}}">اتصل بنا</a></li>
            <li><a href="{{route('info.edit', auth()->user()->id)}}">بياناتي</a></li>
            <li><a href="{{route('dashboard.categories')}}">الفصول</a></li>
            @if(auth()->user()->is_admin == 1)
            <li><a href="{{route('messages.view')}}">رسائل الموقع</a></li>
            @endif
            <li>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="btn btn-danger"
                            style="color: red; background: none;
                             border: none;box-shadow: none; font-family: Cairo;
                              font-size: 1rem;margin-top: -7px">
                        تسجيل الخروج
                    </button>
                </form>
            </li>
            <li>
                <img class="mx-auto d-block rounded-circle border border-dark m-2" src='{{\App\User::find(auth()->user()->id)->photo}}' style="height: 2.5rem;width: 2.5rem;border-radius: 2rem;margin-top: 0.9rem;">
            </li>
        </ul>

        <a href="#" data-target="sidebar" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
    </div>
</nav>

<ul class="sidenav" style="direction:ltr;" id="sidebar">

    <li><a style="text-align:right" href="{{route('teacher.home')}}">الرئيسية</a></li>
    <li><a style="text-align:right" href="/classes">الفصول</a></li>
    <li><a style="text-align:right" href="/editteacher">بياناتي</a></li>
    <li><a style="text-align:right" href="{{route('logout')}}">تسجيل الخروج</a></li>


</ul>

<script>
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });
</script>
