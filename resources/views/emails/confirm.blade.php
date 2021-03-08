<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Активация регистрации нового ползователя</title>
</head>
<body>
<h1>Спасибо за регистрацию, {{$user->name}}!</h1>

<p>
    Перейдите <a href='{{ url("email/confirm/{$user->token}") }}'>по ссылке </a>чтобы подтвердить свой аккаунт!
</p>
</body>
</html>
