@extends('layouts.dashboard')

@section('content_page')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Formulário de Consulta</li>
            </ol>
        </nav>

        <form-component></form-component>

        {{-- <div class="button-group">
            <a class="btn btn-success mb-3" href="#"><i class="icon fas fa-plus"></i> Preencher Novo Formulário </a>
        </div>
        
        <div id="accordion">

            <div class="card">

                <div class="card-header p-3" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h6 class="mb-0">
                        <i class="icon fas fa-th-list"></i>
                        Formulários Preenchidos
                    </h6>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection