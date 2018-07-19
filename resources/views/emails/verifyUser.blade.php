<!DOCTYPE html>
<html>
<head>
    <title>Bem Vindo</title>
</head>
 
<body>
<h2>Olá {{$user['name']}}</h2>
<br/>
Seu ID de e-mail registrado é {{$user['email']}} , Por favor, clique no link abaixo para confirmar sua conta de e-mail
<br/>
<a href="{{url('/usuario/confirmar', $user->verifyUser->token)}}">Confirmar Email</a>
</body>
 
</html>