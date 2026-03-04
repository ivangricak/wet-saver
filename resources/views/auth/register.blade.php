<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
<div class="form-container">
  <!-- English -->
<form class="row g-3 m-3 form-wrapper" action="{{ route('user.store') }}" method="post">
      @csrf
      <div class="duo">
        <div class="col-md-6 log-input">
          <label for="login" class="form-label">Login</label>
          <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="col-md-6 log-input">
          <label for="nick" class="form-label">Username</label>
          <input type="text" class="form-control" id="nick" name="nick">
        </div>
        <div class="col-md-6 log-input">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="col-md-6 log-input">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
      </div>
      <div class="kontrol">
        <button type="submit" class="btn btn-primary">Apply</button>
        <a class="dropdown-item reg-btn-log" href="{{ route('login.show') }}">Log-in</a>
      </div>
      <div class="aditional1">
        <a class="dropdown-item main-btn-log" href="{{ route('home.welcome') }}">Home</a>
      </div>
  </form>

<!-- Ukraine -->
  <!-- <form class="row g-3 m-3 form-wrapper" action="{{ route('user.store') }}" method="post">
      @csrf
      <div class="duo">
        <div class="col-md-6 log-input">
          <label for="login" class="form-label">Логін</label>
          <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="col-md-6 log-input">
          <label for="nick" class="form-label">Ім'я</label>
          <input type="text" class="form-control" id="nick" name="nick">
        </div>
        <div class="col-md-6 log-input">
          <label for="password" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="col-md-6 log-input">
          <label for="password_confirmation" class="form-label">Повторити пароль</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
      </div>
      <div class="kontrol">
        <button type="submit" class="btn btn-primary">Створити</button>
        <a class="dropdown-item reg-btn-log" href="{{ route('login.show') }}">Увійти в аккаунт</a>
      </div>
      <div class="aditional1">
        <a class="dropdown-item main-btn-log" href="{{ route('home.welcome') }}">Назад</a>
      </div>
  </form> -->
</div>
</body>
</html>