<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-gradient bg-light">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
      <div class="card shadow-lg border-0 w-100" style="max-width: 500px;">
        <div class="card-header bg-white text-center border-0">
          <h4 class="text-purple fw-bold">Nexus Acadêmico - Login</h4>
        </div>
        <div class="card-body bg-white">
          <form>
            <div class="mb-3">
              <label for="cpf" class="form-label text-purple">CPF</label>
              <input type="text" class="form-control border-purple" id="cpf" name="cpf" placeholder="000.000.000-00" required>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label text-purple">Senha</label>
              <input type="password" class="form-control border-purple" id="exampleInputPassword1" required>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input border-purple" id="exampleCheck1">
              <label class="form-check-label text-purple" for="exampleCheck1">Manter conectado</label>
            </div>

            <button type="submit" class="btn btn-purple w-100">Entrar</button>
          </form>
        </div>
      </div>
    </div>

    <style>
      .text-purple {
        color: #6f42c1 !important;
      }
      .border-purple {
        border-color: #6f42c1 !important;
      }
      .btn-purple {
        background-color: #6f42c1;
        color: #fff;
        border: none;
      }
      .btn-purple:hover {
        background-color: #5936a6;
      }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
