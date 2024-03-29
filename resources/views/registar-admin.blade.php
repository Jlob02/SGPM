<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!--bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

  <link rel="stylesheet" href="css/login-style.css">
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 fixed-top d-flex justify-content-end p-4">
        <div class="dropdown">
          <a class="btn btn-sm text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ strtoupper(str_replace('_', '-', app()->getLocale()))}}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="locale/en">EN</a></li>
            <li><a class="dropdown-item" href="locale/pt">PT</a></li>
            <li><a class="dropdown-item" href="locale/fr">FR</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Formulario de logim-->

    <main class="form-signin w-100 m-auto">
      <form method="POST" action="/registar-admin">
        @csrf

        <h1 class="h4 mb-3 fw-normal">{{__('login.admin-registration')}}</h1>
        @if($errors->any())
        <div class="alert alert-warning" role="alert">
          {{$errors->first()}}
        </div>
        @endif
        <div class="form-floating">
          <input type="text" name='nome' class="form-control mb-2" id="floatingName" placeholder="John Doe" value='{{old("name")}}'>
          <label for="floatingName">{{__('login.name')}}</label>
        </div>
        <div class="form-floating">
          <input type="email" name='email' class="form-control mb-2" id="floatingInput" placeholder="name@example.com" value='{{old("email")}}'>
          <label for="floatingInput">{{__('login.email')}}</label>
        </div>
        <div class="form-floating">
          <input type="password" name='password' class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">{{__('login.password')}}</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">{{__('login.register')}}</button>
      </form>
    </main>


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