<!DOCTYPE html dir="rtl">
<html dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>سجلاتي - الفصول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <% include ./partials/header.ejs %>

    <style>
        .row {
            margin-top: 15px;
            display: flex;
            flex-flow: row-reverse wrap;
            padding:5px;
            align-content: flex-end;
            justify-content: flex-end;
        }

        .class-card{
            padding:25px!important;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin:5px;
            flex-basis: 32%;

        }

        .class-icon{
            width:80px;
            height: 80px;
            padding:10px;
            border-radius: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            color:white;
        }

        @media only screen and (max-width:992px){
            .class-card{
                flex-basis: 47%;
            }
        }

        @media only screen and (max-width:600px){
            .class-card{
                flex-basis: 100%;
            }
        }
    </style>
</head>

<body>
    <%include ./partials/navbar.ejs %>

    <div class="container">

        <div class="row">
            <h5 style="text-align: center ; color:green" >مرحباً أستاذ,

            </h5>

        </div>
        <div class="row">
            <a href="#modal" class="btn green col waves-effect waves-light btn modal-trigger"><i class="material-icons">add</i><span
                    style="position: relative;bottom: 5px">إضافة فصل</span></a>
            <div id="modal" style="direction:rtl" class="modal">
                <div class="modal-content">
                    <h4 style="text-align: center">إضافة فصل</h4>
                    <form action="/addclass" method="post">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" name="name" autocomplete="off" type="text" class="validate" required>
                                <label for="name">اسم الفصل</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="subject" name="subject" autocomplete="off" type="text" class="validate"
                                    required>
                                <label for="subject">المادة الدراسية</label>
                            </div>
                        </div>


                        <div class="row">
                            <button style="align: center" class="btn green">إضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <% classes.forEach((item)=>{ %>
            <div class=" white z-depth-1 class-card">
                <div class="class-icon blue">
                    <i style="font-size:45px" class="material-icons">menu_book</i>
                </div>
                <div style="margin-top:15px;">
                    <b>الفصل:</b>
                    <%=item.name %>
                </div>

                <div style="margin-top:15px;">
                    <b>المادة:</b>
                    <%= item.subject %>
                </div>

                <div id="<%= item.id %>" style="direction:rtl;text-align: center" class="modal">
                        <div class="modal-content">
                            <h4>حذف الفصل</h4>

                            <p>هل أنت متاكد انك تريد حذف هذا الفصل؟</p>


                            <div style="display:flex;justify-content:center">
                                <a href="/deleteclass/<%= item.id %>" style="margin:5px" class="btn red">تأكيد</a>
                                <a href="#classModal" style="margin:5px" class="btn green modal-action modal-close">الغـاء</a>
                            </div>
                        </div>
                    </div>

                <div class="row">

                    <a href="#<%= item.id %>" style="margin:0 5px;margin-top:10px;" class="btn red modal-trigger">حدف</a>
                    <a href="/class/<%=item.id %>" style="margin:0 5px;margin-top:10px;" class="btn blue">عرض</a>
                </div>
            </div>

            <% }) %>




        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('.modal').modal();
    });
</script>

<% if(updated.length > 0) { %>

<script>

    M.toast({ html: 'تم التحديث' })

</script>

<% } %>

</html>
