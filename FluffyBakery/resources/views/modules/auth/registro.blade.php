@section('contenido')
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container col-12">
    <div class="card shadow lg p-3 mb-3 mt-3 bg-body rounded">
      <h2 class="text-center mt-2 mb-2">Regístrate</h2>
      <form action="validacion_registro.php" method="post">
        <div class="mb-3">
          <label class="form-label" for="inputGroupSelect01"></label>
          <select class="form-select" id="inputGroupSelect01" name="document_type">
            <option selected>Tipo de Documento</option>
            <option value="cc">Cédula de Ciudadanía</option>
            <option value="ce">Cédula de Extranjería</option>
            <option value="ti">Tarjeta de Identidad</option>
          </select>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" type="text" id="document_number" name="document_number" placeholder="Número de Documento">
          <label for="document_number">Número de Documento</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" type="text" id="name" name="name" placeholder="Nombre">
          <label for="name">Nombre</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Apellido">
          <label for="lastname">Apellido</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" type="email" id="email" name="email" placeholder="Email">
          <label for="email">Correo Electrónico</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña">
          <label for="password">Contraseña</label>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary col-12 btn-lg">Regístrate</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-4 mt-2">
      <?php
      if (isset($_GET['var'])) {
      ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <p style="text-align: center; margin: 0px; padding: 0px; font-weight: bold;">
            <?php
            echo $_GET['var'];
            ?>
          </p>

          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

      <?php
      }
      ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

@endsection