<div class="wrapper">
    @include('layouts.partials.header')
    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    @include('layouts.partials.sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.partials.flash_message')
            @include('layouts.partials.errors')
            @if (!empty($pageTitle))
                <h1>{{ $pageTitle }}</h1>
            @endif
            @yield('content-header')
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
    @include('layouts.partials.footer')
</div>
