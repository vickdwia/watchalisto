<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Watchalisto</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logoup.png') }}">
</head>

<style>
/* === SAMA PERSIS DENGAN LOGIN / FORGOT === */
body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
    background: radial-gradient(circle at top, #0d0d0d, #000);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.login-wrapper {
    background: rgba(20, 20, 20, 0.8);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(13, 148, 136, 0.2);
    border-radius: 20px;
    padding: 45px 40px;
    width: 100%;
    max-width: 450px;
    text-align: center;
    box-shadow: 0 0 30px rgba(13, 148, 136, 0.4);
}

.login-wrapper h1 {
    color: #fff;
    font-size: 26px;
    margin-bottom: 10px;
}

.login-wrapper p {
    color: #aaa;
    font-size: 14px;
    margin-bottom: 25px;
}

input {
    width: 100%;
    padding: 14px 18px;
    background: rgba(255,255,255,0.05);
    border: 1px solid #2a2a2a;
    border-radius: 10px;
    color: #eaeaea;
    font-size: 14px;
    margin-bottom: 12px;
}

button {
    width: 100%;
    padding: 14px;
    margin-top: 10px;
    background: linear-gradient(90deg, rgb(13,148,136), rgb(20,184,166));
    border: none;
    border-radius: 10px;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}
</style>

<body>
<div class="login-wrapper">

    <img src="{{ asset('images/logoup.png') }}" width="70" style="margin-bottom:10px">

    <h1>Reset Password</h1>
    <p>Masukkan password baru untuk akun kamu</p>

    @error('email')
        <p style="color:#ef4444">{{ $message }}</p>
    @enderror
    @error('password')
        <p style="color:#ef4444">{{ $message }}</p>
    @enderror

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <input type="email"
            name="email"
            value="{{ old('email', request()->email) }}"
            placeholder="Email"
            required>

        <input type="password"
            name="password"
            placeholder="Password baru"
            required>

        <input type="password"
            name="password_confirmation"
            placeholder="Ulangi password"
            required>

        <button type="submit">Reset Password</button>
    </form>

</div>
</body>
</html>
