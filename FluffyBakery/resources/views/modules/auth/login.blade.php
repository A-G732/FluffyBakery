@section('contenido')
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio de Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="css/style.css">
  <link href="img/logo.jpeg" rel="icon">
</head>

<body>
  <div class="container col-12">
    <div class="card shadow lg p-3 mb-3 mt-3 bg-body rounded">
      <h2 class="card-title text-center mt-2 mb-2">Inicio de Sesión</h2>
      <div class="card-body">
        <form action="validacion_login.php" method="post">
          <div class="form-floating mb-3">
            <input class="form-control" type="email" id="email" name="email" placeholder="Email">
            <label for="email">Correo Electrónico</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña">
            <label for="password">Contraseña</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Inicia Sesión</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@endsection