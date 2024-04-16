<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <p>Hi {{ $email }},</p>
        <h1>Kode OTP Lupa Password Anda.</h1>
        <p>Kode Berlaku Selama 10 Menit</p>
        <h2>Kode OTP : {{ $kode_otp }}</h2>
    </body>

</html>
