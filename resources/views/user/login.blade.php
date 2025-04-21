<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Nexus Acadêmico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-lg border-0 w-100" style="max-width: 500px;">
      <div class="card-header bg-white text-center border-0">
        <h4 class="text-primary fw-bold">Nexus Acadêmico - Login</h4>
      </div>
      <div class="card-body bg-white">
        <form method="POST" action="{{ route('date.user.login') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" class="form-control" id="password" name="password">
      
          @error('password')
              <div class="text-danger mt-1">{{ $message }}</div>
          @enderror
        </div>
          
          <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
