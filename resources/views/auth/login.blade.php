<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
          .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
    </style>
</head>
<body class="bg-light">
<div class="login-wrapper">
    <div class="card p-4">
    <h3 class="mb-3 text-center">Login</h3>

    <div id="login-success" class="alert alert-success d-none"></div>
    <div id="login-error" class="alert alert-danger d-none"></div>

    <form id="loginForm">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label id="captcha-label">Captcha</label>
            <input type="number" name="captcha" class="form-control" required>
            <input type="hidden" name="captcha_result" id="captcha_result">
        </div>

        <button type="submit" class="btn btn-success w-100">Login</button>
        <a href="{{ route('register.form') }}" class="btn btn-primary w-100 mt-3">Register</a>
    </form>
</div>
    </div>

<!-- Scripts -->
<script src="{{url('/js/jquery.min.js')}}"></script>
<script src="{{url('/js/popper.min.js')}}"></script>
<script src="{{url('/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('/js/login.js')}}"></script>


</body>
</html>
