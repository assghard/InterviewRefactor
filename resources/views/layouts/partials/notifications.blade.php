@if (Session::has('success'))
    <div class="alert alert-success my-2">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger my-2">
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning my-2">
        {{ Session::get('warning') }}
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info my-2">
        {{ Session::get('info') }}
    </div>
@endif
