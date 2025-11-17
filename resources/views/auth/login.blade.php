<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite([
        'resources/sass/app.scss',
        'resources/css/app.css',
        'resources/js/bootstrap.js',
        'resources/js/app.js',
    ])
    <title>Document</title>
</head>
<body>
<div class="form-container">
    <form class="row g-3 m-3 form-wrapper" action="{{ route('login.show') }}" method="post">
      @csrf
      <div class="duo">
      <div class="col-md-6 log-input">
        <label for="login" class="form-label">Login</label>
        <input type="input" class="form-control" id="login" name="login">
      </div>
      <div class="col-md-6 log-input">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Apply</button>
      </div>
      <div class="aditional1">
        <a class="dropdown-item reg-btn-log" href="{{ route('user.create') }}">Register</a>
        <!-- <a class="dropdown-item" href="{{ route('home.index') }}">Home</a> -->
        <a class="dropdown-item main-btn-log" href="{{ route('home.welcome') }}">Main</a>
      </div>
    </form>
  </div>
</body>
</html>