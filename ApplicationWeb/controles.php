<?php
	if(isset($_POST['reboot'])) {
		exec('sudo -u www-data /usr/lib/cgi-bin/reboot.sh');
	}

	if(isset($_POST['update_repo'])) {
		exec('/var/www/html/controles.sh');
	}
?>

<html>
	<head>

		<title>Controles Serveur GMP</title
  		<meta http-equiv="Content-Type"
        	content="text/html; charset=utf-8" />

	</head>

	<body>

		<br/>

		<form method="POST" action="">

			<input type="submit" value="REBOOT" name="reboot"/>

			</br>
			</br>

			<input type="submit" value="UPDATE REPO" name="update_repo"/>

		</form>

	</body>
</html>
