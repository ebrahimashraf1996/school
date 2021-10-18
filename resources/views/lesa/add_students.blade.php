<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>سجلاتي - إضافة طلاب</title>
</head>
@include('site.includes.header')
<body>

@include('site.includes.navbar')
<small>
    <h6 style="text-align: center;color:blue"><i class="material-icons">file_copy</i>
        بإمكانك لصق مجموعة من الطلاب مرة واحدة

    </h6>
</small>

<br>
<br>
<div class="container">
    <div style="margin-top:20px;" class="row">
        <form class="col s12" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="students" id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">إضافة طلاب</label>
                </div>
            </div>
            <button class="btn green">إضافة</button>
        </form>
    </div>
</div>

</body>
</html>
