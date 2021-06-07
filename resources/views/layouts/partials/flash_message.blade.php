@if(session('success') || session('error'))
<div class="content">
    @if(session('success'))
        <div class="col-md-12 mr-auto ml-auto alert alert-success alert-with-icon animated fadeInDown" role="alert" style="transition: all 0.5s ease-in-out 0s;">
            <span class="oi oi-check"></span>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div data-notify="container" class="col-md-12 mr-auto ml-auto alert alert-danger alert-with-icon animated fadeInDown" role="alert">
            <span class="oi oi-warning"></span>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('error') }}
        </div>
    @endif
</div>
@endif