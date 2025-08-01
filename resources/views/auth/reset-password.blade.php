<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #B57EDC, #6A0DAD);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reset-container {
            background: #fff;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            box-sizing: border-box;
        }

        .reset-container img.logo {
            width: 80px;
            height: auto;
            display: block;
            margin: 0 auto 16px;
        }

        .reset-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #6A0DAD;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #6A0DAD;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(to right, #B57EDC, #6A0DAD);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-submit:hover {
            opacity: 0.95;
        }

        .status-message {
            color: green;
            text-align: center;
            margin-bottom: 12px;
        }

        .error-list {
            color: red;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .error-list li {
            margin-left: 16px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">

        <h2>Reset Password</h2>

        @if (session('status'))
            <div class="status-message">{{ session('status') }}</div>
        @endif

        @if ($errors->has('token') || $errors->has('email'))
            <div class="error-list">
                <strong>This reset link is invalid or has expired. Please request a new one.</strong>
            </div>
        @elseif ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ url('/reset-password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ request()->get('token') }}">
            <input type="hidden" name="email" value="{{ request()->get('email') }}">

            <div class="form-group">
                <label>New Password:</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
