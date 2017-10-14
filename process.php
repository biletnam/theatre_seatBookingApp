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
	
//insert the booking into the database
		$name = $_POST['name'];
		//create a unique booking ID for this transaction
		$bookingID = uniqid();
		$email = $_POST['emailaddress'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		
		$conn = connect();
		
		//if rear stall seat(s) are chosen.
		if (isset($_POST['rear'])){
			$rear = $_POST['rear'];
			//add a booking for each seat.
				foreach ($rear as $seat) {
				$query = "INSERT INTO Booking VALUES ('$bookingID','$date','$time','$name','$email','$seat')";
				$handle = $conn->prepare($query);
				$handle->execute();
				}
		}
		
		//if front stall seat(s) are chosen.
		if (isset($_POST['front'])){
			$front = $_POST['front'];
			//add a booking for each seat.
				foreach ($front as $seat) {
				$query = "INSERT INTO Booking VALUES ('$bookingID','$date','$time','$name','$email','$seat')";
				$handle = $conn->prepare($query);
				$handle->execute();
				}
		}
		
		//if balcony seat(s) chosen.
		if (isset($_POST['balcony'])){
			$balcony = $_POST['balcony'];
			//add a booking for each seat.
				foreach ($balcony as $seat) {
				$query = "INSERT INTO Booking VALUES ('$bookingID','$date','$time','$name','$email','$seat')";
				$handle = $conn->prepare($query);
				$handle->execute();
				}
		}
		
		//if box 1 seat(s) chosen.
		if (isset($_POST['box1'])){
			$box1 = $_POST['box1'];
			//add a booking for each seat.
				foreach ($box1 as $seat) {
				$query = "INSERT INTO Booking VALUES ('$bookingID','$date','$time','$name','$email','$seat')";
				$handle = $conn->prepare($query);
				$handle->execute();
				}
		}
		
		//if box 2 seat(s) chosen.
		if (isset($_POST['box2'])){
			$box2 = $_POST['box2'];
			//add a booking for each seat.
				foreach ($box2 as $seat) {
				$query = "INSERT INTO Booking VALUES ('$bookingID','$date','$time','$name','$email','$seat')";
				$handle = $conn->prepare($query);
				$handle->execute();
				}
		}
		
		//if box 3 seat(s) chosen
		if (isset($_POST['box3'])){
			$box3 = $_POST['box3'];
			//add a booking for each seat.
				foreach ($box3 as $seat) {
				$query = "INSERT INTO Booking VALUES ('$bookingID','$date','$time','$name','$email','$seat')";
				$handle = $conn->prepare($query);
				$handle->execute();
				}
		}
		
		//if box 4 seat(s) chosen
		if (isset($_POST['box4'])){
			$box4 = $_POST['box4'];
			//add a booking for each seat.
				foreach ($box4 as $seat) {
				$query = "INSERT INTO Booking VALUES ('$bookingID','$date','$time','$name','$email','$seat')";
				$handle = $conn->prepare($query);
				$handle->execute();
				}
		}
?>

<link href="style/style.css" type="text/css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

<html>
	<head>
		<title> The Canterbury Theatre </title>
	</head>
	
	<center><div id="titleimg">
		<img src="images/kay-theatre.jpg" alt="The Canterbury Theatre">
	</div></center>

	<center><div id="content"><center>
		<div id="nav">
			<a href="index.html">Home</a> || Book
		</div>
	
		<body>
			<h1>Thank you</h1>
			Thank you <?php echo $name?> for your booking! Your e-ticket will be emailed to <?php echo $email?>.
			Your booking ID is <?php echo $bookingID?>. Please keep it for your records. Below is a confirmation of your booking:<br><br>

			<b>Production:</b><?php echo $_POST['title']?><br>
			<b>Date and Time: <?php echo $date?> at <?php echo $time?></b><br><br>

			<b><u>Your booked seats:</u></b><br> 
			<?php
				//print the seats booked according to zone.
			
				if (isset($_POST["rear"])) {
					echo "<b>Rear Stalls: </b>"; 
					foreach ($_POST["rear"] as $seat) {
						echo $seat . ",";
					} 
				echo "<br>";
				}

				if (isset($_POST["front"])) {
					echo "<b>Front Stalls: </b>"; 
					foreach ($_POST["front"] as $seat) {
						echo $seat . ",";
					} 
				echo "<br>";
				}

				if (isset($_POST["balcony"])) {
					echo "<b>Balcony: </b>"; 
					foreach ($_POST["balcony"] as $seat) {
						echo $seat . ",";
					} 
				echo "<br>";
				}

				if (isset($_POST["box1"])) {
					echo "<b>Box 1: </b>"; 
					foreach ($_POST["box1"] as $seat) {
						echo $seat . ",";
					} 
				echo "<br>";
				}

				if (isset($_POST["box2"])) {
					echo "<b>Box 2: </b>"; 
					foreach ($_POST["box2"] as $seat) {
						echo $seat . ",";
					} 
				echo "<br>";
				}

				if (isset($_POST["box3"])) {
					echo "<b>Box 3: </b>"; 
					foreach ($_POST["box3"] as $seat) {
						echo $seat . ",";
					} 
				echo "<br>";
				}

				if (isset($_POST["box4"])) {
					echo "<b>Box 4: </b>"; 
					foreach ($_POST["box4"] as $seat) {
						echo $seat . ",";
					} 
				echo "<br>";
				}
			echo "<br>";
			?>

			<b>Total: £</b><?php echo $_POST['total'];?><br>

		</body>
	</center></div></center>

</html>