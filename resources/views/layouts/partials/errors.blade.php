@if ($errors->any())
<div data-notify="container" class="col-md-12 mr-auto ml-auto alert alert-danger alert-with-icon animated fadeInDown" role="alert">
    @foreach ($errors->all() as $error)
        <span class="oi oi-warning"></span>
        {{ $error }}
        <br/>
    @endforeach
</div>
@endif
