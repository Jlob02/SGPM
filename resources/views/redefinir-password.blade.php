<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redefinir password</title>
  <!--bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

  <link rel="stylesheet" href="{{asset('css/login-style.css')}}">
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
      <form method="POST" action="/redefinir/password/@isset($token){{$token}}@endisset">
        @csrf
        <h4 class=" mt-2">Redefinir password</h4>
        @if(session('erro') != null)
        <div class="alert alert-warning" role="alert">
          {{session('erro')}}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-warning" role="alert">
          {{$errors->first()}}
        </div>
        @endif

        <div class="mt-3">
          <input type="password" name='password' class="form-control bg-body-secondary mb-2" placeholder="Password" value='{{old("password")}}'>

          <input type="password" name='password_confirmation' class="form-control bg-body-secondary " placeholder="Password" value='{{old("password_confirmation")}}'>
        </div>

        <div class="text-end">
          <button type="submit" class=" mt-2 btn  btn-primary" type="submit">Guardar</button>
        </div>
      </form>
    </main>

    <div class="row">
      <div class="col-12 fixed-bottom">

      </div>
    </div>
    <div class="row">
      <div class="col-12 fixed-bottom">
        <p class="mb-3 text-body-secondary text-center">&copy; Sistema de gestão de preços de mercado de matérias-primas 2023</p>
      </div>
    </div>
  </div>

  <!--bootstrap javascript-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</body>

</html>