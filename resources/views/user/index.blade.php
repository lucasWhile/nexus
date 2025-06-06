
@extends('basesLayout.base')
@section('title','index')
@section('container')


@auth

<div id="meu-alerta" class="alert alert-success alert-dismissible fade show" role="alert">
Olá, {{ explode(' ', Auth::user()->name)[0] }}! Seu nível de acesso é: {{ Auth::user()->level }}.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
</div>

<script>
// Espera 4 segundos e remove o alerta automaticamente
setTimeout(function () {
  const alert = bootstrap.Alert.getOrCreateInstance(document.getElementById('meu-alerta'));
  alert.close();
}, 4000);
</script>

    
@endauth
    
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
      <div class="col-8 col-sm-8 ">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            
            <div class="carousel-indicators">
                @foreach($posts as $index => $post)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
    
            <div class="carousel-inner">
                @foreach($posts as $index => $post)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $post->image) }}" class="d-block " alt="{{ $post->title }}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $post->title }}</h5>
                            <p>{{ Str::limit($post->abstract, 100) }}</p>
                        </div>
                    </div>
                @endforeach
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
        @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->abstract, 100) }}</p>
                        <a href="{{ route('unique.projects',$post->id) }}" class="btn btn-primary">Ver mais</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($posts->isEmpty())
        <p class="text-center mt-4">Nenhum projeto publicado ainda.</p>
    @endif
</section>

  @endsection