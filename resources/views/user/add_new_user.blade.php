@extends('basesLayout.base')
@section('title','Adicionar Usuário')
@section('container')

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="fw-bold mb-0">Nexus Acadêmico - Cadastro</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('date.user.add.create') }}" method="GET">
                      @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Seu nome completo" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@exemplo.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">Nível</label>
                            <select class="form-select" id="level" name="level" required>
                                <option value="">Selecione</option>
                                <option value="professor">Professor</option>
                                <option value="estagiario">Estagiario</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
