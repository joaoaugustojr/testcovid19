@php
    $menu_list = config('testcovid19.menu');
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('dashboard.index') }}">COVID-19</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">

            @foreach ($menu_list as $menu)
                @php
                    $url = route($menu['route']);
                    $active = url()->current() == route($menu['route']) ? 'active' : '';
                    $text = $menu['text'];
                @endphp
                <li class="nav-item">
                    <a class="nav-link {{ $active }}" href="{{ $url }}">{{ $text }}</a>
                </li>
            @endforeach
            
        </ul>
    </div>
</nav>