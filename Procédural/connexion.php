<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styleConnection.css">
	<title>Dendo Jitensha</title>
</head>
<body>
	<div id="conteneur">
		<div id="connectionForm">
			<h2> Formulaire de connexion </h2>
			<form action="Connexion_Verification.php" method="POST">
				<p> Votre nom : </p>
				<input type="text" name="Nom">
				<p> Mot de passe : </p>
				<input type="password" name="MDP">
				<p></p>
				<input class="btn btn-primary" type="submit" value="Se connecter">
			</form>
		</div>
	</div>
</body>
</html>
