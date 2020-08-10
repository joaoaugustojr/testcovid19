@extends('layouts.master')

@section('content')
<div class="wrapper">

    <section class="section-dash">

        @include('includes.menu')

        <div class="content mt-3">
            @yield('content_page')
        </div>

    </section>

</div>
@endsection