@extends('basesLayout.base')
@section('title','Listar Usuários')
@section('container')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Usuários Cadastrados</h5>
                    <a href="{{ route('view.user.add.create') }}" class="btn btn-light btn-sm">+ Novo Usuário</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Nível</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-center">Editar</th>
                                    <th scope="col" class="text-center">Apagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ ucfirst($user->level) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                                ✏️ Editar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <form action="#" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    🗑️ Apagar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($users->isEmpty())
                            <div class="alert alert-warning text-center mt-3">
                                Nenhum usuário cadastrado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
