 <?php
//connect to the database
function connect() {
	$host = 'dragon.ukc.ac.uk';
		$dbname = 'ss2159';
		$user = 'ss2159';
		$pwd = 'cap!apu';
		
		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// from www4 PHPSQL class model answer
			if ($conn) {
						return $conn;
						} else {
						echo 'Failed to connect';
						}	
		}
		catch (PDOException $e) {
			echo "PDOException: ".$e->getMessage();
		}
}

?> 

<link href="style/style.css" type="text/css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

<html>
	<head>
		<title>
			The Canterbury Theatre
		</title>

	</head>

	<center><div id="titleimg">
		<img src="images/kay-theatre.jpg" alt="The Canterbury Theatre">
	</div></center>

	<center><div id="content"><center>
		<div id="nav">
			<a href="index.html">Home</a> || Book
		</div>
	
		<body>
			<h1>Performances</h1>
				Here are all our productions. Click the image to view performance dates and times
				for that play.
				To book, please click 'Book' next to the performance you want.<br><br>

			<br><br>
			<?php
				echo '<table>';
					//get performance information from the database and output it
					//in a table.
					$conn = connect();
					
					$query="SELECT * FROM Performance ORDER BY PerfDate";
					$handle = $conn->prepare($query);
					$handle->execute();
					$conn = null;
					$result = $handle->fetchAll();
					
					echo "<th>Date</th><th>Time</th><th>Title</th><th></th>";
					foreach($result as $row) {
						echo "<tr>
							<td>" . $row['PerfDate'] . "</td>
							<td>" . $row['PerfTime'] . "</td>
							<td>" . $row['Title'] . "</td>
							<td> <a href='seats.php?title=".$row['Title']."&date=".$row['PerfDate']."&time=".$row['PerfTime']."'>Book</a> </td>
						</tr>";
					}
				echo '</table>';
			?>
			
			<br><br>
		</body>
	</center></div></center>

</html>