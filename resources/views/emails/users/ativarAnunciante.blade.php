<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Consagre Imoveis</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body style="margin: 0; padding: 0; font-family: sans-serif;  ">

	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr>
			<td>

				<table align="center" border="0" cellpadding="0" cellspacing="0" width="80%" style="border-collapse: collapse;">

					<tr>
						<td bgcolor="#007aa5" align="center" style="padding-top: 40px; padding-bottom: 20px; padding-left: 0px; padding-right: 0px;">
						<img width="300px" height="120px" src="{{ $message->embed(public_path().'/imagens/logo-page-login.png')}}" style="display: block;" alt="Imoveis na Baixada Santista"/>
						</td>
					</tr>
					<tr>
						<td style="padding-top: 20px; padding-bottom: 20px; padding-right: 10px; padding-left: 10px;" bgcolor="#ffffff">
							
							 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="color: #454545">
							  <tr>
							   <td>
							     Olá {{ $nome }},
							   </td>
							  </tr>
							  <tr>
							   <td style="padding-top: 20px; padding-left: 0px; padding-bottom: 20px; padding-right: 0;">
							    Você acabou de ativar uma conta de anunciante com o email: <strong>{{ $email }}</strong> em {{ $datahora }}. <br/>					   	
							    
							    Para dar sequencia e ter acesso ao seu painel de anuncios, acesse o link abaixo e cadastre uma senha de acesso.

							   </td>
							  </tr>

							  <tr>
							   <td style="padding-top: 8px; padding-left: 0px; padding-bottom: 20px; padding-right: 0;">
							    <small>* Para sua segurança tente cadastrar uma senha com no minimo 6 digitos, <br/>
							    incluindo letras maiusculas, minusculas, numeros e caracteres.<br/>	</small>
 
							   </td>
							  </tr>

							 </table>

						</td>
					</tr>

					<tr>
						<td>
							<table align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td> Para cadastrar sua senha e completar seu cadastro, clique no botão abaixo:</td>
								</tr>
								<tr>
									<td style="padding: 25px 15px 25px 15px" width="100%" >

										<a href="{{ route('anunciante.ativar', $token) }}" 
										style="background-color:#007aa5; color: #fff; padding: 20px 15px 20px 15px; text-decoration: none; display: block; text-align: center;"> 
										Cadastrar Senha 
										</a>

									</td>
								</tr>
							</table>
						</td>
					</tr>

					<tr>
						<td bgcolor="#007aa5" style="padding: 30px 30px 30px 30px;" >
						
							<table cellpadding="0" cellspacing="0" style="color: #ffffff;" width="100%">

								 <tr>

									  <td width="75%">
									   &reg; Consagre Imoveis, Baixada Santista 2018<br/>
		 								<small>O melhor lugar para anunciar seu imóvel.</small>
									  </td>

									  <td align="right" border="0" width="25%">
											 <table border="0" cellpadding="0" cellspacing="0">
											  <tr>
											   <td>
											    <a href="http://www.twitter.com/">
											     <img src="{{ $message->embed(public_path().'/imagens/tw.png')}}" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
											    </a>
											   </td>
											   <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
											   <td>
											    <a href="http://www.facebook.com/">
											     <img src="{{ $message->embed(public_path().'/imagens/fb.png')}}" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
											    </a>
											   </td>
											  </tr>
											 </table>							  
									  </td>

								 </tr>
							</table>


						</td>
					</tr>


				</table>


			</td>
		</tr>		

	</table>

</body>
</html>	