<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body style="text-align:center;margin-top:100px;">
    <h2>Admin Login</h2>

    @if ($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Admin Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
