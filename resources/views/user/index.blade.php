@extends('basesLayout.base')
@section('title', 'index')
@section('container')

<style>

  #suggestions {
  z-index: 1050; /* alto o suficiente para ficar acima de carrosséis e imagens */
  position: absolute; /* necessário para z-index funcionar corretamente */
}
</style>
@auth
<div id="meu-alerta" class="alert alert-success alert-dismissible fade show" role="alert">
    Olá, {{ explode(' ', Auth::user()->name)[0] }}! Seu nível de acesso é: {{ Auth::user()->level }}.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
</div>
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
                <input type="text" class="form-control" id="searchInput" placeholder="Busque por projetos, professores...">
                <button class="btn btn-dark" id="#">Pesquisar</button>
            </div>
            <div id="suggestions" class="list-group position-absolute w-100 d-none shadow"></div>
        </div>
    </div>
</header>

<!-- CARROSSEL DE DESTAQUES -->
<div class="container p-2">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-sm-8">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($posts as $index => $post)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}"
                                class="{{ $index == 0 ? 'active' : '' }}" 
                                aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach($posts as $index => $post)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 class="d-block w-100 img-fluid object-fit-cover"
                                 alt="{{ $post->title }}"
                                 style="max-height: 500px;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $post->title }}</h5>
                                <p>{{ Str::limit($post->abstract, 100) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- PROJETOS RECENTES -->
<section class="container my-5">
    <h2 class="text-center mb-4">Projetos Recentes</h2>

    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->abstract, 100) }}</p>
                        <a href="{{ route('unique.projects', $post->id) }}" class="btn btn-primary">Ver mais</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center mt-4">Nenhum projeto publicado ainda.</p>
        @endforelse
    </div>
</section>

<!-- SCRIPT FINAL -->
<script>
setTimeout(function () {
    const alert = bootstrap.Alert.getOrCreateInstance(document.getElementById('meu-alerta'));
    alert?.close();
}, 4000);

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const suggestionsBox = document.getElementById('suggestions');
    const searchButton = document.getElementById('searchButton');

    searchInput.addEventListener('input', handleInput);
    searchButton.addEventListener('click', redirectToSearchPage);

    async function handleInput(event) {
        const query = event.target.value.trim();
        if (query.length < 2) {
            hideSuggestions();
            return;
        }

        const results = await fetchSuggestions(query);
        showSuggestions(results);
    }

    async function fetchSuggestions(query) {
        try {
            const response = await fetch(`/buscar?q=${encodeURIComponent(query)}`);
            if (!response.ok) throw new Error('Erro na busca');
            return await response.json();
        } catch (error) {
            console.error(error);
            return { posts: [], users: [] };
        }
    }

    function showSuggestions(data) {
        const { posts, users } = data;
        suggestionsBox.innerHTML = '';

        if (posts.length === 0 && users.length === 0) {
            hideSuggestions();
            return;
        }

        if (posts.length > 0) {
            suggestionsBox.innerHTML += `<div class="list-group-item active">Projetos</div>`;
            posts.forEach(post => {
                suggestionsBox.innerHTML += `
                    <a href="/unique/projects/${post.id}" class="list-group-item list-group-item-action">
                        ${post.title}
                    </a>`;
            });
        }

        if (users.length > 0) {
            suggestionsBox.innerHTML += `<div class="list-group-item active">Professores</div>`;
            users.forEach(user => {
                suggestionsBox.innerHTML += `
                    <a href="/profile/${user.id}" class="list-group-item list-group-item-action">
                        ${user.name}
                    </a>`;
            });
        }

        suggestionsBox.classList.remove('d-none');
    }

    function hideSuggestions() {
        suggestionsBox.innerHTML = '';
        suggestionsBox.classList.add('d-none');
    }

    function redirectToSearchPage() {
        const query = searchInput.value.trim();
        if (query.length >= 2) {
            window.location.href = `/buscar-resultados?q=${encodeURIComponent(query)}`;
        }
    }
});
</script>

@endsection
