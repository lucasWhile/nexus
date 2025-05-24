@extends('basesLayout.base')
@section('title','Postar Projeto')

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
        <h5 class="mb-0">Cadastrar Projeto</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('date.post') }}" method="POST" enctype="multipart/form-data">
          @csrf
  
          <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title"  required>
          </div>
  
          <div class="mb-3">
            <label for="abstract" class="form-label">Resumo</label>
            <textarea class="form-control" id="abstract" name="abstract" rows="5" required></textarea>
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
              <option value="">Selecione o status</option>
              <option value="em andamento">Em andamento</option>
              <option value="finalizado">Finalizado</option>
              <option value="pendente">Pendente</option>
            </select>
          </div>
  
          <div class="mb-3">
            <label for="image" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
          </div>

          <div class="mb-3">
            <img id="preview" src="#" alt="Pré-visualização da imagem" class="img-fluid rounded" style="display: none; max-height: 300px;">
          </div>
              
          <div class="mb-3">
            <label for="start_date" class="form-label">Data de Início</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
          </div>
  
          <div class="mb-3">
            <label for="end_date" class="form-label">Data de Término</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
          </div>
  
          <div class="mb-3">
            <label for="project_url" class="form-label">URL do Projeto</label>
            <input type="text" class="form-control" id="project_url" name="project_url" maxlength="45">
          </div>
  
          <div class="mb-3">
            <label for="call_number" class="form-label">Número de Edital</label>
            <input type="text" class="form-control" id="call_number" name="call_number" maxlength="45">
          </div>
  
          <div class="mb-3">
            <label for="research_group" class="form-label">Grupo de Pesquisa</label>
            <input type="text" class="form-control" id="research_group" name="research_group" maxlength="45">
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="participa" value="1" id="checkDefault">
            <label class="form-check-label" for="checkDefault">
             Você participa desse Projeto?
            </label>
          </div>

          <div class="mb-3">
            <label for="professor_search" class="form-label">Professores:</label>
            <input type="text" class="form-control" id="professor_search" maxlength="45" autocomplete="off">
            <input type="hidden" id="professor_id" name="professor_id[]">
          </div>

          <!-- Botão para adicionar o professor -->
          <button type="button" id="add_professor_btn" class="btn btn-secondary mb-3">Adicionar professor</button>

          <!-- Lista de professores adicionados -->
          <ul id="professores_lista" class="list-group mb-3"></ul>
  
          <button type="submit" class="btn btn-dark w-100">Salvar Projeto</button>
  
        </form>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    function previewImage() {
      const input = document.getElementById('image');
      const preview = document.getElementById('preview');

      const file = input.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
      }
    }

    document.getElementById('image').addEventListener('change', previewImage);
  });

  $(function() {
    // Autocomplete para busca de professores
    $("#professor_search").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "/professores/buscar", // URL para buscar os professores
          dataType: "json",
          data: {
            term: request.term
          },
          success: function(data) {
            response(data);
          }
        });
      },
      minLength: 2,
      select: function(event, ui) {
        $("#professor_search").val(ui.item.label);  // Exibe nome do professor
        $("#professor_id").val(ui.item.value);  // Armazena o id do professor
        return false;
      }
    });

    // Botão "Adicionar professor"
    $("#add_professor_btn").click(function() {
      let nome = $("#professor_search").val();
      let id = $("#professor_id").val();

      if (id && nome) {
        // Evita duplicidade de professores na lista
        if ($(`#professores_lista li[data-id='${id}']`).length === 0) {
          // Adiciona o professor na lista
          $("#professores_lista").append(
            `<li class="list-group-item d-flex justify-content-between align-items-center" data-id="${id}">
              ${nome} 
              <button type="button" class="btn btn-sm btn-danger remove_professor">x</button>
            </li>`
          );

          // Cria input hidden para enviar o ID do professor
          $(`<input type="hidden" name="professores_ids[]" value="${id}" id="input_professor_${id}">`).appendTo("form");

          // Limpa o campo de busca
          $("#professor_search").val('');
          $("#professor_id").val('');
        } else {
          alert("Professor já adicionado!");
        }
      } else {
        alert("Selecione um professor válido!");
      }
    });

    // Remover professor da lista e também do formulário
    $("#professores_lista").on("click", ".remove_professor", function() {
      let li = $(this).parent();
      let id = li.data('id');

      // Remove o input hidden do professor
      $(`#input_professor_${id}`).remove();

      // Remove o item da lista
      li.remove();
    });
  });
</script>

@endsection
