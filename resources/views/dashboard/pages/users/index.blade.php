@extends('layouts.dashboard')

@section('content_page')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Usuários</li>
            </ol>
        </nav>

        <user-component></user-component>

    </div>
@endsection