<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar password</title>
  <!--bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

  <link rel="stylesheet" href="css/login-style.css">
</head>

<body>

  <div class="container-fluid">

    <div class="row">
      <div class="col-12 fixed-top d-flex justify-content-end p-4">
        <div class="dropdown">
          <button class="btn bg-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            PT
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">EN</a></li>
            <li><a class="dropdown-item" href="#">FR</a></li>
            <li><a class="dropdown-item" href="#">JP</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Formulario de logim-->

    <main class="form-recuperar w-100 m-auto">
      <form method="POST" action="#">
        @csrf
        <h4 class=" mt-2">Recuperar password</h4>
        <p>insere o teu email para poder recuperar a palavra-passe</p>
        @if(session('sucesso') != null)
        <div class="alert alert-success" role="alert">
          {{session('sucesso')}}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-warning" role="alert">
          {{$errors->first()}}
        </div>
        @endif

        <div class="form-floating">
          <input type="email" name='email' class="form-control mb-2" id="floatingInput" placeholder="name@example.com" value='{{old("email")}}'>
          <label for="floatingInput">Email address</label>
        </div>


        <div class="text-end">
          <a class="w-25 mb-4 btn btn-lg btn-secondary" href="/login">Cancelar</a>
          <button class="w-25 mb-4 btn btn-lg btn-primary" type="submit">Recuperar</button>
        </div>
      </form>
    </main>

    <div class="row">
      <div class="col-12 fixed-bottom">

      </div>
    </div>
    <div class="row">
      <div class="col-12 fixed-bottom">
        <p class="mb-3 text-body-secondary text-center">&copy; Sistema de gestão de preços de matéria-prima 2023</p>
      </div>
    </div>
  </div>

  <!--bootstrap javascript-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</body>

</html>