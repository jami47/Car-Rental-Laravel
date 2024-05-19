<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyles.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <div class="wrapper">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            @method('post')
            <h1>Login</h1>

            @if (Session::has('error'))
                <div class="register-link">
                    <p style="color:orange; font-weight: bold;">*{{ Session::get('error') }}</p>
                </div>
            @endif

            <div class="input-box">
                {{--! Used cookie to set UserName --}}
                <input type="text" name="username" placeholder="Username" value="{{ Cookie::get('username') ? Cookie::get('username') : '' }}" required>

                {{--! Nicher partke use korte hole newline/space egula bujeshune dite hobe value er moddhe --}}
                {{-- <input type="text" name="username" placeholder="Username" value="
                    @if(Cookie::get('username'))
                        {{ Cookie::get('username') }}
                    @elseif(old('username'))
                        {{ old('username') }}
                    @else
                        {{ '' }}
                    @endif
                    "
                    required> --}}

                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" name="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>

            <input type="submit" class="btn" value="login"></input>

            <div class="register-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>


</body>
</html>
