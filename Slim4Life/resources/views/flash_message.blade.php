@if (Session::has('success'))
    <div class="alert alert-success alert-block text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
    @php (Session::forget('success'))
@endif

@if (Session::has('error'))
    <div class="alert alert-danger text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ Session::get('error') }}</strong>
    </div>
    @php (Session::forget('error'))
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-block text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ Session::get('warning') }}</strong>
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-block text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('info') }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </div>
@endif