<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
<form class="row g-3 m-3" action="{{ route('user.store') }}" method="post">
    @csrf
    <div class="col-md-6">
      <label for="login" class="form-label">Login</label>
      <input type="text" class="form-control" id="login" name="login">
    </div>
    <div class="col-md-6">
      <label for="nick" class="form-label">Nick</label>
      <input type="text" class="form-control" id="nick" name="nick">
    </div>
    <div class="col-md-6">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="col-md-6">
      <label for="password_confirmation" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Apply</button>
    </div>
    <a href="{{ route('login.show') }}">login</a>
    <a href="{{ route('home.index') }}">Home</a>
</form>
</body>
</html>