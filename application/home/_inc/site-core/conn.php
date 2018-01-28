<?php
	include "db-core.php";

	$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

	if(!$conn) {
		echo "Error connection";

		return false;
	}
?>