<!DOCTYPE html>
<html>
<head>
	<title>Discord Oauth</title>
</head>
<body>
	<?php
	include 'requests.php';
	include 'settings.php';
	session_start();
	
	// If user presses logout link the session gets destroyed.
	if (isset($_GET['logout'])) {
		unset($_SESSION);
		session_destroy();
		header("Location: index.php");
	}

	// Error handler
	if (isset($_GET['error'])) {
		echo "<center>";
		echo "<p style='color: red'><b>";
		echo $_GET['error'] . "<br>";
		echo $_GET['error_description'];
		echo "</b></p>";
		echo "<a href='index.php'>Back</a>";
		echo "</center>";

	}

	// Discord's "Login with Discord" page returns a code.
	// We need to convert that code into a token for API calls.
	if (isset($_GET['code'])) {
		$token_url = "https://discord.com/api/oauth2/token";
		$data = [
			'client_id'=> $client_id,
			'client_secret'=> $client_secret,
			'grant_type'=> 'authorization_code',
			'code'=> $_GET['code'],
			'redirect_uri'=> $redirect_uri,
			'scope'=> $scope
		];
		$headers = [
			'Content-Type'=> 'application/x-www-form-urlencoded'
		];

		$res = post($token_url, $data, $headers);
		$_SESSION['oauth'] = [];
		$_SESSION['oauth']['token'] = $res['access_token'];
		$_SESSION['oauth']['refresh_token'] = $res['refresh_token'];
		$_SESSION['oauth']['scope'] = $res['scope'];

		header("Location: index.php");
	}

	?>
</body>
</html>