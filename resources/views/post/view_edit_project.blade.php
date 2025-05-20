@extends('basesLayout.base')
@section('title', 'Editar Projeto')

@section('container')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Editar Projeto</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('update.project', $projeto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
            

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $projeto->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="abstract" class="form-label">Resumo</label>
                    <textarea class="form-control" id="abstract" name="abstract" rows="5" required>{{ $projeto->abstract }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Selecione o status</option>
                        <option value="em andamento" {{ $projeto->status == 'em andamento' ? 'selected' : '' }}>Em andamento</option>
                        <option value="finalizado" {{ $projeto->status == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="pendente" {{ $projeto->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    </select>
                </div>

                @if ($projeto->image)
                    <div class="mb-3">
                        <label class="form-label">Imagem atual:</label><br>
                        <img src="{{ asset('storage/' . $projeto->image) }}" class="img-fluid rounded mb-2" style="max-height: 200px;">
                    </div>
                @endif

                <div class="mb-3">
                    <label for="image" class="form-label">Nova Imagem (opcional)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>

                <div class="mb-3">
                    <img id="preview" src="#" alt="Pré-visualização da imagem" class="img-fluid rounded" style="display: none; max-height: 300px;">
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Data de Início</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $projeto->start_date }}" required>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">Data de Término</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $projeto->end_date }}" required>
                </div>

                <div class="mb-3">
                    <label for="project_url" class="form-label">URL do Projeto</label>
                    <input type="text" class="form-control" id="project_url" name="project_url" value="{{ $projeto->project_url }}" maxlength="45">
                </div>

                <div class="mb-3">
                    <label for="call_number" class="form-label">Número de Edital</label>
                    <input type="text" class="form-control" id="call_number" name="call_number" value="{{ $projeto->call_number }}" maxlength="45">
                </div>

                <div class="mb-3">
                    <label for="research_group" class="form-label">Grupo de Pesquisa</label>
                    <input type="text" class="form-control" id="research_group" name="research_group" value="{{ $projeto->research_group }}" maxlength="45">
                </div>

                <button type="submit" class="btn btn-dark w-100">Atualizar Projeto</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('image');
        const preview = document.getElementById('preview');

        input.addEventListener('change', function () {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    });
</script>
@endsection
