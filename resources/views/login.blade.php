<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      text-align: center;
      background: linear-gradient(to right, #f6f6f6, #ffffff);
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .login-container {
      max-width: 400px;
      margin: auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }
    h1 {
      font-size: 24px;
      font-weight: 600;
      color: #000000;
      margin-bottom: 20px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-bottom: 15px;
    }
    label {
      font-size: 16px;
      font-weight: 600;
      color: #555;
      margin-bottom: 5px;
    }
    select, input {
      padding: 10px 12px;
      font-size: 14px;
      width: 100%;
      border: 1px solid #ddd;
      border-radius: 6px;
      box-sizing: border-box;
      transition: border-color 0.3s;
    }
    button {
      margin-top: 15px;
      padding: 12px 15px;
      font-size: 16px;
      width: 100%;
      background: #4c86af;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s, box-shadow 0.3s;
    }
    p {
      color: red;
      font-size: 14px;
    }
    .logo {
      margin-bottom: 20px;
    }
    .logo img {
      width: 150px; /* Sesuaikan ukuran logo */
      height: auto;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- Logo Section -->
    <div class="logo">
        <img src="{{ auth()->user()->login_logo ? asset('storage/' . auth()->user()->login_logo) : asset('path/to/default/login-logo.png') }}" alt="Logo Login">
    </div>


    <h1>Login</h1>

    @if ($errors->has('login_error'))
      <p>{{ $errors->first('login_error') }}</p>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Email" value="{{ old('email') }}">
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Password">
      </div>

      <button type="submit">Login</button>
    </form>
  </div>

</body>
</html>
