<?php
include_once('tableHeader.php');
?>

    <h3>Showing all entries</h3>

<?php

/*



add summary of program


*/

// include_once('header.php');

ini_set('display_errors',1); 
error_reporting(E_ALL);

$server = 'localhost';
$user = 'printrefund';
$pass = 'j3VacXSNFcb';
$dbname = 'printrefund';
$port = '3306';

$mysqli = new mysqli($server, $user, $pass, $dbname)
or die('Error connecting to MySQL server.');

$query = "SELECT * FROM printrefund.printrefunds";

/*
?>
<p>
The query:
<p>
<?php
print $query;
?>
<hr>
<?php
*/

if(!($stmt = $mysqli->prepare($query))) {
	echo "prepared failed";
}
// if(!($stmt->bind_param('s',$selection))) {
// 	echo "execute failed";
// }
if(!($stmt->execute())) {
	echo "execute failed";
}
$stmt->store_result();
if(!($stmt->bind_result($id,$date,$fname,$lname,$email,$uoid,$amtClaimed,$location,$printer,$explanation,$submitter,$archived))) {
	echo "bind result failed";
}

// $result = mysqli_query($mysqli, $query);
// $row_count = mysqli_num_rows($result);
// echo "Row count: " . $row_count;

?>
<br>

<div class="fw-body">
	<div class="content">
		<table id="showAllTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
		            <th>Date</th>
		            <th>First name</th>
		            <th>Last name</th>
		            <th>Email</th>
		            <th>UO ID</th>
		            <th>Amt Claimed</th>
		            <th>Location</th>
		            <th>Printer</th>
		            <th>Explanation</th>
		            <th>Submitter</th>
		            <th>Archived</th>
		        </tr>
		    </thead>
		    <tfoot>
		    	<tr>
					<th>ID</th>
		            <th>Date</th>
		            <th>First name</th>
		            <th>Last name</th>
		            <th>Email</th>
		            <th>UO ID</th>
		            <th>Amt Claimed</th>
		            <th>Location</th>
		            <th>Printer</th>
		            <th>Explanation</th>
		            <th>Submitter</th>
		            <th>Archived</th>
		        </tr>
		    </tfoot>
		    <tbody>


<?php

// echo '<table><thead><tr>';
// echo "<th>id</th><th>date</th><th>first name</th><th>last name</th><th>email</th><th>UO ID</th><th>Amount Claimed</th><th>Location</th><th>Printer</th><th>Explanation</th><th>Submitter</th><th>Archived</th>";
// echo '</tr></thead>';

while ($stmt->fetch()) {
	// echo '<tbody><tr>';
	echo "<tr><td>$id</td><td>$date</td><td>$fname</td><td>$lname</td><td>$email</td><td>$uoid</td><td>$amtClaimed</td><td>$location</td><td>$printer</td><td>$explanation</td><td>$submitter</td><td>$archived</td></tr>";
	// echo '</tr></tbody>';
}
// echo '</table>';

?>
<!-- <div class="container">
	<div class="row">
		<div class="col-md-1">ID</div>
		<div class="col-md-3">Date</div>
		<div class="col-md-2">First name</div>
		<div class="col-md-2">Last name</div>
		<div class="col-md-4">Email</div>
		<div class="col-md-4">UO ID</div>
		<div class="col-md-4">Amt Claimed</div>
		<div class="col-md-4">Location</div>
		<div class="col-md-4">Printer</div>
		<div class="col-md-4">Explanation</div>
		<div class="col-md-4">Submitter</div>
		<div class="col-md-4">Archived</div>
	</div>
</div> -->

		    </tbody>
		</table>
	</div>
</div>


<!-- <form action="printFriendlyTable.php">
<input type="Submit" class="btn btn-info" value="Printer-friendly Version">
</form> -->

<?php

$stmt->close();

// if ($row_count > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "id: " . $row["id"] . " - Date: " . $row["date"] . " - Full name: " . $row["fname"] . " " . $row["lname"] . "<br>";
//     }
// } else {
//     echo "0 results";
// }

// mysqli_free_result($result);

mysqli_close($mysqli);
include_once('footer.php');
?>