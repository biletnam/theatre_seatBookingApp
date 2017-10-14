<?php
// connect to the database
function connect() {
	$host = 'dragon.ukc.ac.uk';
		$dbname = 'ss2159';
		$user = 'ss2159';
		$pwd = 'cap!apu';
		
		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

$conn = connect();

		// set the variables from the previous page
		$time = $_POST['time'];
		$date = $_POST['date'];
		$title = $_POST['title'];
		
		//get the ticket prices for this production
		$query="SELECT * FROM TicketPrices WHERE Title='$title'";
		$handle = $conn->prepare($query);
		$handle->execute();
		$conn = null;
		$result = $handle->fetchAll();
		
		//convert them to numbers (float)
		foreach($result as $zoneprice) {
			
				$rearcost = (float) $zoneprice['Rear'];
				$frontcost = (float) $zoneprice['Front'];
				$balconycost = (float) $zoneprice['Balcony'];
				$b1cost = (float) $zoneprice['Box1'];
				$b2cost = (float) $zoneprice['Box2'];
				$b3cost = (float) $zoneprice['Box3'];
				$b4cost = (float) $zoneprice['Box4'];
			}
		
		// initialise all seat charges to zero

		$rearseats = 0;
		$frontseats = 0;
		$balconyseats = 0;
		$b1seats = 0;
		$b2seats = 0;
		$b3seats = 0;
		$b4seats = 0;
		
		//if a seat of a certain zone is chosen, work out the total cost for that zone
		if (isset($_POST["rear"])) {
			$rearseats = count($_POST['rear']) * $rearcost;
		}
		
		if (isset($_POST["front"])) {
			$frontseats = count($_POST['front']) * $frontcost;
		}
		
		if (isset($_POST["balcony"])) {
			$balconyseats = count($_POST['balcony']) * $balconycost;
		}
		
		if (isset($_POST["box1"])) {
			$b1seats = count($_POST['box1']) * $b1cost;
		}
		
		if (isset($_POST["box2"])) {
			$b2seats = count($_POST['box2']) * $b2cost;
		}
		
		if (isset($_POST["box3"])) {
			$b3seats = count($_POST['box3']) * $b3cost;
		}
		
		if (isset($_POST["box4"])) {
			$b4seats = count($_POST['box4']) * $b4cost;
		}
		
		//add them all together to get the total cost
		$total = $rearseats + $frontseats + $balconyseats + $b1seats + $b2seats + $b3seats + $b4seats;
?>

<link href="style/style.css" type="text/css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

<html>
	<head>
		<title> The Canterbury Theatre </title>
		<script type="text/javascript">

			function validateForm() {
				var name = document.forms["book"]["name"].value;
				if (name == "" | name == "Name (required)") {
					alert("Name must be filled out.");
					return false;
				}
			}

		</script>
	</head>
	
	<center><div id="titleimg">
		<img src="images/kay-theatre.jpg" alt="The Canterbury Theatre">
	</div></center>

	<center><div id="content"><center>
		<div id="nav">
			<a href="index.html">Home</a> || Book
		</div>
	
		<body>
			<h1>Confirm</h1>
			<?php 
			echo "You are booking seats for " . $title . " on " . $date . " at " . $time . "<br><br>"; ?>

			<?php
			
			//check if any seats were chosen. If so, print the confirmation and allow
			//them to enter their name and email, and proceed to the next step.
			
				if (!(isset($_POST["rear"])) && !(isset($_POST["front"])) && !(isset($_POST["balcony"])) && !(isset($_POST["box1"])) && !(isset($_POST["box2"])) && !(isset($_POST["box3"])) && !(isset($_POST["box4"]))) {
					echo 'You did not choose any seats. Please <a href="performances.php">try again</a>. <br><br>';
				}
				else {
					echo "Your chosen seats are:<br>";
					
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
					echo "<br><br>";
					}
					
					echo "<b>Total:</b> £" . $total . "<br><br>";
					
					echo "Please enter your name and email address and click 'Confirm Purchase' to confirm your booking, if you are happy with your seats.<br>
					Otherwise, please click <a href='#' onclick='history.go(-1)'>here</a> to go back to the previous page and change your seats.<br>
					Please note your booking is not complete until you click 'Confirm Purchase'. <br><br>";

					echo '<form name="book", onsubmit="return validateForm()", action="process.php", method="POST">
					<input type="hidden" name="title" value="' . $title . '">
					<input type="hidden" name="date" value="' . $date . '">
					<input type="hidden" name="time" value="' . $time . '">';
					
					//check if seats from each zone were chosen. If so, have it as a hidden value
					//to pass onto the confirmation page.
					if (isset($_POST["rear"])) {
						foreach ($_POST["rear"] as $seat) {
							echo '<input type="hidden" name="rear[]" value="'. $seat. '">';
						}
					}
					
					if (isset($_POST["front"])) {
						foreach ($_POST["front"] as $seat) {
							echo '<input type="hidden" name="front[]" value="'. $seat. '">';
						}
					}
					
					if (isset($_POST["balcony"])) {
						foreach ($_POST["balcony"] as $seat) {
							echo '<input type="hidden" name="balcony[]" value="'. $seat. '">';
						}
					}
					
					if (isset($_POST["box1"])) {
						foreach ($_POST["box1"] as $seat) {
							echo '<input type="hidden" name="box1[]" value="'. $seat. '">';
						}
					}
					
					if (isset($_POST["box2"])) {
						foreach ($_POST["box2"] as $seat) {
							echo '<input type="hidden" name="box2[]" value="'. $seat. '">';
						}
					}
					
					if (isset($_POST["box3"])) {
						foreach ($_POST["box3"] as $seat) {
							echo '<input type="hidden" name="box3[]" value="'. $seat. '">';
						}
					}
					
					if (isset($_POST["box4"])) {
						foreach ($_POST["box4"] as $seat) {
							echo '<input type="hidden" name="box4[]" value="'. $seat. '">';
						}
					}
					
					//allow them to enter their name and email address.
					echo '<fieldset>
							<input type="hidden", name="total", value="' . $total . '">
							<input type="text", name="name", value="Name (required)"><br><br>
							<input type="email", name="emailaddress", value="Email address (required)"><br>
					</fieldset><br><br>
					
				<input type="submit", id="subm", value="Confirm Purchase">
				</form>';
					
				};
				
			?>
		</body>
	</center></div></center>
	
</html>