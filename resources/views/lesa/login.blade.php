<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>سجلاتي - تسجيل الدخول</title>


    <style>

        .alert-message{
            padding:12px;
            background:rgba(218, 125, 125,0.5);
            margin: 0 10px;
            color:rgb(216, 71, 71);
            font-size:17px;
            text-align:center;
        }

        .success-message{
            padding:12px;
            background:rgba(159, 218, 125, 0.5);
            margin: 0 10px;
            color:rgb(93, 216, 71);
            font-size:17px;
            text-align:center;
        }

        .login-container{
            margin-top:10%!important;
            padding:25px;
        }

    </style>

    <% include ./partials/header.ejs %>
</head>

<body>


    <div class="container z-depth-2 login-container">
        <form class="col s12" action="/login" method="POST">

            <h4 class="center-align">تسجيل الدخول</h4>

            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="username" autocomplete="off" type="text" class="validate" required>
                    <label for="email">اسم المستخدم</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password" autocomplete="off" name="password" type="password" class="validate" required>
                    <label for="password">كلمة السر</label>
                </div>
            </div>

            <div class="right-align" class="row">
                <a href="/signup">تسجيل حساب جديد</a>
            </div>


                <div class="row">
                        <div class="s12 alert-message">
                        </div>
                    </div>



                <div class="row">
                        <div class="s12 success-message">
                        </div>
                    </div>


            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" style="width:100%" class="btn btn-block indigo"> تسجيل دخول </button>
                </div>
            </div>

        </form>
    </div>
</body>

</html>
