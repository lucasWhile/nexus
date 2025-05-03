@extends('basesLayout.base')
@section('title','projetos')

@section('container')


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Meus Projetos</h5>
                    <a href="{{ route('view.post') }}" class="btn btn-light btn-sm">+ Novo Projeto</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Resumo</th>
                                    <th>Status</th>
                                    <th>Imagem</th>
                                    <th>Data Início</th>
                                    <th>Data Fim</th>
                                    <th>URL</th>
                                    <th>Chamada</th>
                                    <th>Grupo de Pesquisa</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Desativar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projetos as $projeto)
                                    <tr>
                                        <td>{{ $projeto->id }}</td>
                                        <td>{{ $projeto->title }}</td>
                                        <td>{{ Str::limit($projeto->abstract, 50) }}</td>
                                        <td>
                                            @if($projeto->status == 1)
                                                Ativo
                                            @else
                                                Inativo
                                            @endif
                                        </td>
                                        <td>
                                            @if($projeto->image)
                                                <img src="{{ asset('storage/' . $projeto->image) }}" alt="Imagem" width="50">
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($projeto->start_date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($projeto->end_date)->format('d/m/Y') }}</td>
                                        <td>
                                            @if($projeto->project_url)
                                                <a href="{{ $projeto->project_url }}" target="_blank">Ver Projeto</a>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $projeto->call_number }}</td>
                                        <td>{{ $projeto->research_group }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                                ✏️ Editar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <form action="#" method="POST" onsubmit="return confirm('Deseja alterar o status deste projeto?');">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $projeto->id }}">
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    Ativar/Desativar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($projetos->isEmpty())
                            <div class="alert alert-warning text-center mt-3">
                                Nenhum projeto cadastrado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection