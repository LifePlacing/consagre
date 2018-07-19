@component('mail::message')
# Olá {{ $name }}
Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.
@component('mail::button', ['url' => $url])
Redefinir Senha
@endcomponent
<p>Se você não solicitou uma alteração da senha, nenhuma ação adicional é necessária.</p>
<br>
Atenciosamente,<br>
{{ config('app.name') }}
@component('mail::subcopy', ['url' => $url])
Se você está tendo problemas para clicar no botão de "Redefinir Senha", copie e cole o URL abaixo no seu navegador [{{ $url }}]({{ $url }})
@endcomponent
@endcomponent
