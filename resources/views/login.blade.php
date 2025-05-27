<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login untuk Delete Data</title>
    <style>
        body {
            background-color: #3e2723;
            color: #fff8dc;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: rgba(69, 35, 10, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px #6d4c41;
            max-width: 350px;
            width: 100%;
        }

        .login-box input,
        .login-box button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 8px;
            border: none;
        }

        button {
            background: #8d6e63;
            color: white;
            font-weight: bold;
        }

        button:hover {
            background: #a1887f;
        }

        .error {
            color: #ffcdd2;
        }

        .success {
            color: #c8e6c9;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login untuk Hapus Data 🗑️</h2>

        @if($errors->has('login'))
            <div class="error">{{ $errors->first('login') }}</div>
        @endif

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>
