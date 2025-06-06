<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}">Nexus Acadêmico</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          @auth
              @if (Auth::user()->level == 'administrador')
              <li class="nav-item"><a class="nav-link" href="{{ route('list_users') }}">Listar Usuarios</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('view.user.add.create') }}">Adicionar Usuarios</a></li>

              <li class="nav-item"><a class="nav-link" href="{{ route('view.all.projects') }}">Todos os Projetos</a></li>


         
              @elseif (Auth::user()->level == 'professor')

                 <li class="nav-item"><a class="nav-link" href="{{ route('view.my.projects') }}">Meus Projetos</a></li>

              @endif


              
          @endauth
          <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Início</a></li>
       
       

          @if(Auth::check())
          <li class="nav-item"><a class="nav-link" href="{{ route('view.my.profile') }}">Meu Perfil</a></li>

          <li class="nav-item"><a class="nav-link" href="{{ route('lagout.user') }}">Sair</a></li>
         @else
          <li class="nav-item"><a class="nav-link" href="{{ route('view.user.login') }}">Login</a></li>
         @endif
        </ul>
      </div>

      

      
    </div>
  </nav>




  <!-- CONTEÚDO PRINCIPAL -->
  <main class="container-fluid p-0 ">
    @yield('container')
  </main>



  <!-- FOOTER -->
  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">&copy; 2025 Nexus Acadêmico. Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
