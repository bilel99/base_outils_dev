<!DOCTYPE html>
<html>
<head>
	<title>Password Reset</title>
</head>
<body>
	Bonjour, 

	Votre mot de passe provisoire est {{$generation}}.<br>
	Veuillez cliquer sur le lien ci-dessous pour saisir votre nouveau mot de passe.
	{{ url('password/reset/') }}
</body>
</html>