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
	if (isset($_SESSION['oauth'])) {
		$api = "https://discord.com/api";

		// Here you can customize the API endpoint.
		$endpoint = "/users/@me";

		$headers = array('Authorization: Bearer ' . $_SESSION['oauth']['token']);

		// GET request to api endpoint
		$user = get($api . $endpoint, $headers);

		// Display some user information
		echo "<h4>Logged in as " . $user['username'] . "#" . $user['discriminator'] . "</h4>";
		echo "<img src='https://cdn.discordapp.com/avatars/" . $user['id'] . "/" . $user['avatar'] . ".png?size=32'>";
		echo "<br><a href='login.php?logout'>Logout</a>";

	} else {
		// Display login link if user is not logged in.
		$url = "https://discord.com/api/oauth2/authorize?client_id=" . $client_id . "&redirect_uri=" . $redirect_uri . "&response_type=code&scope=" . $scope;
		echo "<a href='" . $url . "'>Login with Discord</a>";
	}
	?>
</body>
</html>