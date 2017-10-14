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

$conn = connect();

		// set the variables from the previous page
		$time = $_GET['time'];
		$date = $_GET['date'];
		$title = $_GET['title'];
		
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
			<h1>Choose your seats</h1>
			<?php 
			echo "You are booking seats for " . $title . " on " . $date . " at " . $time;
			?>
			<br><br>

			<b>Seats (use Ctrl+click/Shift+click to select multiple seats):</b><br>
						PLEASE NOTE: only available seats are shown. If a zone is empty,
						all seats in that zone are booked.<br><br>

			<form name="book", action="bookingdetails.php", method="post">
					<input type="hidden" name="title" value="<?php echo $title;?>">
					<input type="hidden" name="date" value="<?php echo $date;?>">
					<input type="hidden" name="time" value="<?php echo $time;?>">
					
			<table>

					<th><b>Rear Stalls</b></th>
					<th><b>Front Stalls</b></th>
					<th><b>Balcony</b></th>
					<th><b>Box 1</b></th>
					<th><b>Box 2</b></th>
					<th><b>Box 3</b></th>
					<th><b>Box 4</b></th>
					<tr>
						<td>
							<select multiple="multiple" name="rear[]">
							<?php
							
							// output the seats as options in the dropdown menu
							$conn = connect();
							$query="SELECT RowNumber FROM Seat WHERE Zone='rear stalls' AND 
							RowNumber NOT IN (SELECT RowNumber FROM Booking WHERE 
							PerfTime='$time' AND PerfDate='$date')";
							$handle = $conn->prepare($query);
							$handle->execute();
							$conn = null;
							$result = $handle->fetchAll();
							
							foreach($result as $option) {
								echo '<option value="' . $option['RowNumber'] . '">' . $option['RowNumber'] . '</option>';
							}
							?>
							</select>
					</td>
					<td>
							<select multiple="multiple" name="front[]">
							<?php
							
							// output the seats as options in the dropdown menu
							$conn = connect();
							$query="SELECT RowNumber FROM Seat WHERE Zone='front stalls' AND 
							RowNumber NOT IN (SELECT RowNumber FROM Booking WHERE 
							PerfTime='$time' AND PerfDate='$date')";
							$handle = $conn->prepare($query);
							$handle->execute();
							$conn = null;
							$result = $handle->fetchAll();
							
							foreach($result as $option) {
								echo '<option value="' . $option['RowNumber'] . '">' . $option['RowNumber'] . '</option>';
							}
							?>
							</select>
					</td>
					<td>
							<select multiple="multiple" name="balcony[]">
							<?php
							
							// output the seats as options in the dropdown menu
							$conn = connect();
							$query="SELECT RowNumber FROM Seat WHERE Zone='balcony' AND 
							RowNumber NOT IN (SELECT RowNumber FROM Booking WHERE 
							PerfTime='$time' AND PerfDate='$date')";
							$handle = $conn->prepare($query);
							$handle->execute();
							$conn = null;
							$result = $handle->fetchAll();
							
							foreach($result as $option) {
								echo '<option value="' . $option['RowNumber'] . '">' . $option['RowNumber'] . '</option>';
							}
							?>
							</select>
					</td>
					<td>
							<select multiple="multiple" name="box1[]">
							<?php
							
							// output the seats as options in the dropdown menu
							$conn = connect();
							$query="SELECT RowNumber FROM Seat WHERE Zone='box 1' AND 
							RowNumber NOT IN (SELECT RowNumber FROM Booking WHERE 
							PerfTime='$time' AND PerfDate='$date')";
							$handle = $conn->prepare($query);
							$handle->execute();
							$conn = null;
							$result = $handle->fetchAll();
							
							foreach($result as $option) {
								echo '<option value="' . $option['RowNumber'] . '">' . $option['RowNumber'] . '</option>';
							}
							?>
							</select>
					</td>
					<td>
							<select multiple="multiple" name="box2[]">
							<?php
							
							// output the seats as options in the dropdown menu
							$conn = connect();
							$query="SELECT RowNumber FROM Seat WHERE Zone='box 2' AND 
							RowNumber NOT IN (SELECT RowNumber FROM Booking WHERE 
							PerfTime='$time' AND PerfDate='$date')";
							$handle = $conn->prepare($query);
							$handle->execute();
							$conn = null;
							$result = $handle->fetchAll();
							
							foreach($result as $option) {
								echo '<option value="' . $option['RowNumber'] . '">' . $option['RowNumber'] . '</option>';
							}
							?>
							</select>
					</td>
					<td>
							<select multiple="multiple" name="box3[]">
							<?php
							
							// output the seats as options in the dropdown menu
							$conn = connect();
							$query="SELECT RowNumber FROM Seat WHERE Zone='box 3' AND 
							RowNumber NOT IN (SELECT RowNumber FROM Booking WHERE 
							PerfTime='$time' AND PerfDate='$date')";
							$handle = $conn->prepare($query);
							$handle->execute();
							$conn = null;
							$result = $handle->fetchAll();
							
							foreach($result as $option) {
								echo '<option value="' . $option['RowNumber'] . '">' . $option['RowNumber'] . '</option>';
							}
							?>
							</select>
					</td>
					<td>
							<select multiple="multiple" name="box4[]">
							<?php
							
							// output the seats as options in the dropdown menu
							$conn = connect();
							$query="SELECT RowNumber FROM Seat WHERE Zone='box 4' AND 
							RowNumber NOT IN (SELECT RowNumber FROM Booking WHERE 
							PerfTime='$time' AND PerfDate='$date')";
							$handle = $conn->prepare($query);
							$handle->execute();
							$conn = null;
							$result = $handle->fetchAll();
							
							foreach($result as $option) {
								echo '<option value="' . $option['RowNumber'] . '">' . $option['RowNumber'] . '</option>';
							}
							?>
							</select>
					</td>
				</tr>
				<tr>
						<?php
						// output the seat prices in the respective columns.
						$conn = connect();
						$query="SELECT * FROM TicketPrices WHERE Title='$title'";
						$handle = $conn->prepare($query);
						$handle->execute();
						$conn = null;
						$result = $handle->fetchAll();
						
						foreach($result as $zoneprice) {
							echo '<td> £' . $zoneprice['Rear'] . '/ticket</td>';
							echo '<td> £' . $zoneprice['Front'] . '/ticket</td>';
							echo '<td> £' . $zoneprice['Balcony'] . '/ticket</td>';
							echo '<td> £' . $zoneprice['Box1'] . '/ticket</td>';
							echo '<td> £' . $zoneprice['Box2'] . '/ticket</td>';
							echo '<td> £' . $zoneprice['Box3'] . '/ticket</td>';
							echo '<td> £' . $zoneprice['Box4'] . '/ticket</td>';
						}
						?>
				</tr>
					
			</table><br><br>
					
				<input type="submit", id="subm", value="Next">
			</form>

		</body>
	</center></div></center>
	
</html>