<?php

/*



add summary of program


*/

include_once('tableHeader.php');

// if(isset($_POST['archive'])) {
// 	header("Location: archiveEntry.php?id={$_POST['id']}");
// }

/*

load form
	-query database
		-func get checked
	-build form based on data & inputs
		-func build form
process form
	-confirmation page
		-grab data for each id
		-"are you sure you want to delete... (data)"
		-form
			-hidden field with command
			-hidden field with id's
			-hidden confirm
			-submit form button
	-update
		-change booleans in database for each id
		-if successful, "items were successfully archived"

*/ 

$data=getData();
showForm($data);

function getData() {
	//query here
	return $data;
}

function showForm($data) {

}

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

// var_dump($_POST['archived']);

if(!empty($_POST['archived'])) {
	$selection = $_POST['archived'];
	if($selection == "showArchived") {
		$query = 
			"SELECT p.id,p.date,p.fname,p.lname,p.archived
			FROM printrefunds p
			WHERE p.archived = 1";
	} else if($selection == "showUnarchived") {
		$query = 
			"SELECT p.id,p.date,p.fname,p.lname,p.archived
			FROM printrefunds p
			WHERE p.archived = 0";
	}
}

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
if(!($stmt->execute())) {
	echo "execute failed";
}
$stmt->store_result();
if(!($stmt->bind_result($id,$date,$fname,$lname,$archived))) {
	echo "bind result failed";
}

if($selection == "showArchived") {
	?>
	<h3>Showing all archived entries</h3>
	<div class="fw-body">
	<div class="content">
		<table id="showAllTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
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
		            <th>Submitter</th> -->
		            <th>Archived</th>
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
		            <th>Submitter</th> -->
		            <th>Archived</th>
		        </tr>
		    </tfoot>
		    <tbody>
	<?php
} else if($selection == "showUnarchived") {
	?>
	<h3>Showing all unarchived entries</h3>
	<h5><b>Select entries to archive:</b></h5>
	<div class="fw-body">
	<div class="content">
		<table id="showAllTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Archive</th>
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
		            <th>Submitter</th> -->
		            <th>Archived</th>
		        </tr>
		    </thead>
		    <tfoot>
		    	<tr>
					<th>Archive</th>
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
		            <th>Submitter</th> -->
		            <th>Archived</th>
		        </tr>
		    </tfoot>
		    <tbody>
	<?php
}

// echo '<table><tr>';
// echo "<th>id</th><th>date</th><th>first name</th><th>last name</th>";
// echo '</tr>';
while ($stmt->fetch()) {
	if($selection == "showArchived") {
		echo "<tr><td>$id</td><td>$date</td><td>$fname</td><td>$lname</td><td>$archived</td></tr>";
		// echo "<tr><td>$id</td><td>$date</td><td>$fname</td><td>$lname</td><td>$email</td><td>$uoid</td><td>$amtClaimed</td><td>$location</td><td>$printer</td><td>$explanation</td><td>$submitter</td><td>$archived</td></tr>";
		// echo '<tr>';
		// echo "<td>$id</td><td>$date</td><td>$fname</td><td>$lname</td>";
		// echo '</tr>';
	} else if($selection == "showUnarchived") {
		?>
		<!-- Hidden value to send checked boxes to archive -->
		<form name="archiveCheckboxes" action="archiveEntry.php" method="POST">
		<input type="hidden" name="command" value="archive">
		<tr><td><input type="checkbox" name="archive[]" value="<?=$id?>"></td>
		<?php
		echo "<td>$id</td><td>$date</td><td>$fname</td><td>$lname</td><td>$archived</td></tr>";
		// echo "<tr><td>$id</td><td>$date</td><td>$fname</td><td>$lname</td><td>$email</td><td>$uoid</td><td>$amtClaimed</td><td>$location</td><td>$printer</td><td>$explanation</td><td>$submitter</td><td>$archived</td></tr>";
	}
}

echo "</table>";
if($selection == "showUnarchived" and 'archive'!=NULL) {
	?>
	<input type="submit" class="btn btn-info" value="Archive selected">
	<?php
}
?>
</form>
<?php

$stmt->close();

mysqli_close($mysqli);
include_once('footer.php');
?>