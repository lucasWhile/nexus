
@extends('basesLayout.base')
@section('title','index')
@section('container')
    


  <!-- HEADER COM BUSCA -->
  <header class="bg-primary text-white text-center py-5">
    <div class="container">
      <h1 class="display-5 fw-bold">Encontre Projetos Acadêmicos e Orientadores</h1>
      <p class="lead">Explore oportunidades de pesquisa, extensão e TCCs em sua instituição</p>
      <div class="position-relative mt-4">
        <div class="input-group">
          <input type="text" class="form-control" id="searchInput" placeholder="Busque por projetos, professores..." />
          <button class="btn btn-dark">Pesquisar</button>
        </div>
        <div id="suggestions" class="list-group position-absolute w-100 d-none"></div>
      </div>
    </div>
  </header>

  <!-- PROJETOS -->
  <section class="container my-5">
    <h2 class="text-center mb-4">Projetos Recentes</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Projeto 1</h5>
            <p class="card-text">Descrição breve do projeto acadêmico.</p>
            <a href="#" class="btn btn-primary">Ver mais</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Projeto 2</h5>
            <p class="card-text">Descrição breve do projeto acadêmico.</p>
            <a href="#" class="btn btn-primary">Ver mais</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Projeto 3</h5>
            <p class="card-text">Descrição breve do projeto acadêmico.</p>
            <a href="#" class="btn btn-primary">Ver mais</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection