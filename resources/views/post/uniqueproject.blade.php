@extends('basesLayout.base')
@section('title','{{ $project->title }}')

@section('container')

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">{{ $project->title }}</h5>
        </div>
        <div class="card-body">

            <div class="mb-3">
                <img src="{{ asset('storage/' . $project->image) }}" alt="Imagem do Projeto" class="img-fluid rounded" style="max-height: 400px;">
            </div>

            <div class="mb-3">
                <strong>Resumo:</strong>
                <p>{{ $project->abstract }}</p>
            </div>

            <div class="mb-3">
                <strong>Status:</strong>
                <p>{{ ucfirst($project->status) }}</p>
            </div>

            <div class="mb-3">
                <strong>Data de Início:</strong>
                <p>{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}</p>
            </div>

            <div class="mb-3">
                <strong>Data de Término:</strong>
                <p>{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</p>
            </div>

            @if($project->project_url)
                <div class="mb-3">
                    <strong>URL do Projeto:</strong>
                    <p><a href="{{ $project->project_url }}" target="_blank">{{ $project->project_url }}</a></p>
                </div>
            @endif

            @if($project->call_number)
                <div class="mb-3">
                    <strong>Número de Edital:</strong>
                    <p>{{ $project->call_number }}</p>
                </div>
            @endif

            @if($project->research_group)
                <div class="mb-3">
                    <strong>Grupo de Pesquisa:</strong>
                    <p>{{ $project->research_group }}</p>
                </div>
            @endif

               <div class="mb-3">
                <strong>Usuários Associados ao Projeto:</strong>
                <ul>
                    @foreach($project->users as $user)
                        <li>{{ $user->name }} ({{ $user->level ?? 'Sem Cargo' }})</li>
                    @endforeach
                </ul>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

@endsection
