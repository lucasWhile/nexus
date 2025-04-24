@extends('basesLayout.base')
@section('title','Editar Usuário:')
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
                    <h4 class="fw-bold mb-0">Editar Usuario</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('date.edit.user') }}" method="GET">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value=" {{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value=" {{ $user->email }}" placeholder="seuemail@exemplo.com" required>
                        </div>

                    
                        <div class="mb-3">
                            <label for="level" class="form-label">Nível</label>
                            <select class="form-select"   id="level" name="level" required >
                                <option value=" {{ $user->level }}"> {{ $user->level }}</option>
                                <option value="professor">Professor</option>
                                <option value="estagiario">Estagiário</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value=" {{ $user->cpf }}" required>
                        </div>

                        <!-- Campo Lattes: oculto por padrão -->
                        <div class="mb-3 {{ $user->level === 'professor' ? '' : 'd-none' }}" id="lattesField">

                            <label for="lattes_url" class="form-label">Link do Lattes</label>
                            <input type="url" class="form-control" id="lattes_url" name="lattes_url" value=" {{ optional($user->profile)->lattes_url }}" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Atualizar</button>
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
