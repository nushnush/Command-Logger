<!DOCTYPE html>
<html lang="en">
<head>
	<title>Command Logs</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.bootstrap.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.js"></script>
	<style>
		body {
			background-image: url("background.jpg");
			background-repeat: no-repeat;
			background-size: cover;
			color: white;
		}

		tr:hover td {
			background: #000;
			opacity: 0.8;
		}

		h2 {
			font-family: "Comic Sans MS", cursive, sans-serif;
			font-size: 40px;
		}
	</style>
</head>
<body>

<?php
	include 'functions.php';
?>

<div class="container">
	<h2><center>Command Logs</center></h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Server Name</th>
				<th>Admin</th>
				<th>SteamID</th>
				<th>Command</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
				showTable();
			?>
		</tbody>
	</table>
	<script>
		$('table').DataTable();
	</script>
</div>
</body>
<footer>
	<center><p><i>Made by <a href='http://steamcommunity.com/profiles/76561198164353433' target='_blank'>yelks</a></i></p></center>
</footer>
</html>