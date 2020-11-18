<?php

function showTable() {
	include 'includes/config.php';

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$query = "SELECT * FROM `logging`";
	$results = $conn->query($query);

	if ($results->num_rows > 0) {
		while ($row = $results->fetch_assoc()) {
			$servername     	= $row['server'];
			$name 				= $row['name'];
			$steamid  			= $row['steamid'];
			$command			= $row['command'];
			$date 				= $row['date'];
			if ($date === "") {
				$date = 'Unavailable';
			}
				
			echo "<tr>";
			echo "<td>" . $servername . "</td>";

			$url = "http://steamcommunity.com/profiles/" . $steamid ."/?xml=1";
			$xml = simplexml_load_string(file_get_contents($url));
			$picURL = $xml->avatarMedium;
			$fullName = "<td><a href='http://steamcommunity.com/profiles/%s' target='_blank'><img src='%s' alt='%s' /></a></td>";
			echo sprintf($fullName, $steamid, $picURL, $name);
			
			echo "<td>" . $steamid . "</td>";
			echo "<td>" . $command . "</td>";
			echo "<td>" . $date . "</td>";
			echo "</tr>";
		}
	} else {
		echo "No results found.";
	}

	$conn->close();
}
?>