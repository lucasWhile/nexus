
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

  <div class="container p-2">
    <div class="row d-flex justify-content-center">
        <div class="col-8 col-sm-12 ">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ asset('img_teste/1.jpeg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>First slide label</h5>
                      <p>Some representative placeholder content for the first slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img_teste/1.jpeg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Second slide label</h5>
                      <p>Some representative placeholder content for the second slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img_teste/1.jpeg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Third slide label</h5>
                      <p>Some representative placeholder content for the third slide.</p>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              
        </div>
    </div>
  </div>
 

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