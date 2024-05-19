<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyles.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <div class="wrapper">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            @method('post')
            <h1>Registration</h1>

            <div class="input-box">
                <input type="text" name="name" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="email" name="email"  placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password"  placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <!-- <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div> -->

            <input type="submit" class="btn" value="Register"></input>

            <div class="register-link">
                <p>Already a user? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>


</body>
</html>
