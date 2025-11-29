<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - MySCAT</title>
  <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet">
</head>
<body class="auth-body"  style="background: url('{{ asset('assets/img/auth/authh.png') }}') no-repeat center/cover;">

  <div class="auth-card">
    <h2>Create Account</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-error">
        <ul style="margin: 0; padding-left: 20px;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

      <button type="submit">Sign Up</button>

      <div class="auth-links">
        <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
      </div>
    </form>
  </div>

</body>
</html>
