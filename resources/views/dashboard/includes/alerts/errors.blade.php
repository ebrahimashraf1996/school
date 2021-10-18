@if(Session::has('error'))
    <br><br><br>
    <div class="notify_err" >
            <button type="text" class="notify_btn_err"
                    id="type-error">{{Session::get('error')}}
            </button>
    </div>
@endif
