<?php

/*



add summary of program


*/

include_once('tableHeader.php');

// session_start();

function connectToServer() {
	$server = 'localhost';
	$user = 'printrefund';
	$pass = 'j3VacXSNFcb';
	$dbname = 'printrefund';
	$port = '3306';

	$mysqli = new mysqli($server, $user, $pass, $dbname)
	or die('Error connecting to MySQL server.');

	return $mysqli;
}

ini_set('display_errors',1); 
error_reporting(E_ALL);

$mysqli = connectToServer();

$query = "SELECT * FROM printrefund.printrefunds";
if(!($stmt = $mysqli->prepare($query))) {
	echo "prepared failed";
}
if(!($stmt->execute())) {
	echo "execute failed";
}
$stmt->store_result();
if(!($stmt->bind_result($id,$date,$fname,$lname,$email,$uoid,$amtClaimed,$location,$printer,$explanation,$submitter,$archived))) {
	echo "bind result failed";
}

?>
<br>

<div class="fw-body">
	<div class="content">
		<table id="showAllTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<p><b>You selected:</b></p>
				<tr>
					<th>ID</th>
		            <th>Date</th>
		            <th>First name</th>
		            <th>Last name</th>
		            <!-- <th>Email</th>
		            <th>UO ID</th>
		            <th>Amt Claimed</th>
		            <th>Location</th>
		            <th>Printer</th>
		            <th>Explanation</th>
		            <th>Submitter</th>
		            <th>Archived</th> -->
		        </tr>
		    </thead>
		    <tfoot>
		    	<tr>
					<th>ID</th>
		            <th>Date</th>
		            <th>First name</th>
		            <th>Last name</th>
		            <!-- <th>Email</th>
		            <th>UO ID</th>
		            <th>Amt Claimed</th>
		            <th>Location</th>
		            <th>Printer</th>
		            <th>Explanation</th>
		            <th>Submitter</th>
		            <th>Archived</th> -->
		        </tr>
		    </tfoot>
		    <tbody>


<?php

$entriesToArchive = $_POST['archive'];
// var_dump($_POST['archive']);
if(!is_null($entriesToArchive)) {
	while($stmt->fetch()) {
		if (in_array($id, $entriesToArchive)) {
			echo "<tr><td>$id</td><td>$date</td><td>$fname</td><td>$lname</td></tr>";
		}
	}

} else {
	?>
	<form action="showArchivedHandler.php" method="POST">
		<h4>You suck</h4>

		<input type="hidden" name="archived" value="showUnarchived">

	<input type="submit" class="btn btn-info" name="showUnarchived" value="Return">
	</form>
	<?php
	exit();
}
echo '</table>';

// $serializedEntries = serialize($entriesToArchive);
// var_dump($serializedEntries);

/*
foreach($_POST as $key=>$value)
	echo "<p>$key=&gt;$value</p><pre>";
	var_dump($value);
	echo '</pre><hr />';
}
*/

/*
if(isset($_POST['archive'])) {
	$id=$_GET['id'];
	print $id;
	$sql = "UPDATE printrefunds SET archived='1' WHERE printrefunds.id='$id'";
}

if($mysqli->query($sql) === TRUE) {
	echo "Archived entry successfully";
} else {
	echo "Error: " . $sql . "<br>" . $mysqli->error;
}
*/

?>
<!-- <form name="return" action="printrefund.html">
	<input type="submit"  value="Return">
</form>
<form name="undo" action="">
	<input type="submit" value="Undo">
</form> -->

<form action="archiveConfirmation.php" method="POST">
<b>Are you sure you want to archive these entries?</b>
<select name="confirmation">
<option value="">Select...</option>
<option value="confirmArchive">Yes, archive entries</option>
<option value="return">No, return</option>
</select><input type="Submit" class="btn btn-info" value="Submit">
<input type="hidden" name="entriesToArchive" value='<?=serialize($entriesToArchive)?>'>
</form>
<?php

// $_SESSION["entriesToArchive"] = base64_encode(serialize($entriesToArchive));
// $_SESSION["entriesToArchive"] = $entriesToArchive;
 
mysqli_close($mysqli);
// header('location:printrefund.html');
include_once('footer.php');
?>