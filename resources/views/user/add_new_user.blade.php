@extends('basesLayout.base')
@section('title','Adicionar Usuário')
@section('container')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif
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
                                <option value="estagiario">Estagiário</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                        </div>

                        <!-- Campo Lattes: oculto por padrão -->
                        <div class="mb-3 d-none" id="lattesField">
                            <label for="lattes_url" class="form-label">Link do Lattes</label>
                            <input type="url" class="form-control" id="lattes_url" name="lattes_url" placeholder="https://lattes.cnpq.br/..." />
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script: Exibe campo do Lattes ao escolher "professor" --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const levelSelect = document.getElementById('level');
        const lattesField = document.getElementById('lattesField');

        levelSelect.addEventListener('change', function () {
            if (this.value === 'professor') {
                lattesField.classList.remove('d-none');
            } else {
                lattesField.classList.add('d-none');
            }
        });
    });
</script>

@endsection
