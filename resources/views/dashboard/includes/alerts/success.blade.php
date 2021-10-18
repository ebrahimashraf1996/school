@if(Session::has('success'))
    <br><br><br>
    <div class="notify_par">
            <button type="text" class="notify_btn"
                    id="type-error">{{Session::get('success')}}
            </button>
    </div>
@endif
