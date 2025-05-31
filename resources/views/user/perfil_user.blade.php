@extends('basesLayout.base')
@section('title', 'Meu Perfil')

@section('container')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>{{ $user->name }}</h5>
         
                </div>
                <div class="card-body px-4">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Nome</dt>
                        <dd class="col-sm-8">{{ $user->name }}</dd>

                        <dt class="col-sm-4">E-mail</dt>
                        <dd class="col-sm-8">{{ $user->email }}</dd>

                    
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            @if($user->status)
                                <span class="badge bg-success px-3 py-1">Ativo</span>
                            @else
                                <span class="badge bg-danger px-3 py-1">Inativo</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    @if($user->posts->count())
    <div class="row justify-content-center mt-3">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-folder2-open me-2"></i> Projetos:</h5>
                </div>
                <div class="card-body px-4">
                    <ul class="list-group list-group-flush">
                        @foreach($user->posts as $projeto)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $projeto->title }}</h6>
                                        <small class="text-muted">
                                            {{ ucfirst($projeto->status) }} — 
                                            {{ \Carbon\Carbon::parse($projeto->start_date)->format('d/m/Y') }}
                                            até
                                            {{ \Carbon\Carbon::parse($projeto->end_date)->format('d/m/Y') }}
                                        </small>
                                    </div>
                                    <a href="{{ route('unique.projects',$projeto->id) }}" class="btn btn-sm btn-outline-primary">Visualizar Projeto</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
