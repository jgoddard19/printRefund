<html>
<head>
  <title>jgoddard rough printrefund php</title>
  </head>
  <body>

<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

$server = "localhost";
$user = "printrefund";
$pass = "j3VacXSNFcb";
$dbname = "printrefund";
$port = "3306";

$mysqli = new mysqli($server, $user, $pass, $dbname)
or die('Error connecting to MySQL server.');

$required = array('date', 'fname', 'lname', 'email', 'uoid', 'amtClaimed', 'location', 'printer', 'explanation', 'submitter');
$error = false;
foreach($required as $field) {
	if(empty($_POST[$field])) {
		$error=true;
	}
}
if ($error) {
	echo "All fields are required.";
} else {
	$date=$_POST['date'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$uoid=$_POST['uoid'];
	$amtClaimed=$_POST['amtClaimed'];
	$location=$_POST['location'];
	$printer=$_POST['printer'];
	$explanation=$_POST['explanation'];
	$submitter=$_POST['submitter'];
}

// if(!empty($_POST['id'])) {
// 	$id=$_POST['id'];
// }
// if(!empty($_POST['date'])) {
// 	$date=$_POST['date'];
// }
// if(!empty($_POST['fname'])) {
// 	$fname=$_POST['fname'];
// }
// if(!empty($_POST['lname'])) {
// 	$lname=$_POST['lname'];
// }
// if(!empty($_POST['email'])) {
// 	$email=$_POST['email'];
// }
// if(!empty($_POST['uoid'])) {
// 	$uoid=$_POST['uoid'];
// }
// if(!empty($_POST['amtClaimed'])) {
// 	$amtClaimed=$_POST['amtClaimed'];
// }
// if(!empty($_POST['location'])) {
// 	$location=$_POST['location'];
// }
// if(!empty($_POST['printer'])) {
// 	$printer=$_POST['printer'];
// }
// if(!empty($_POST['explanation'])) {
// 	$explanation=$_POST['explanation'];
// }
// if(!empty($_POST['submitter'])) {
// 	$submitter=$_POST['submitter'];
// }
?>

<p>
Entries:
<p>
<table>

<?php
foreach($_POST as $key => $value) {
	echo "<tr>";
    echo "<td>";
    echo $key;
    echo "</td>";
    echo "<td>";
    echo $value;
    echo "</td>";
    echo "</tr>";
}

$sql = "INSERT INTO printrefunds (date, fname, lname, email, uoid, amtClaimed, location, printer, explanation, submitter)
	VALUES ('$date', '$fname', '$lname', '$email', '$uoid', '$amtClaimed', '$location', '$printer', '$explanation', '$submitter')";
if($mysqli->query($sql)===TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $mysqli->error;
}

mysqli_close($mysqli);
?>

</body>
</html>