<?php
/*



add summary of program


*/

include_once('header.php');

// session_start();

ini_set('display_errors',1); 
error_reporting(E_ALL);

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

$mysqli = connectToServer();

if(!empty($_POST['confirmation'])) {
	$selection = $_POST['confirmation'];
	if($selection == "confirmArchive") {

		// $entriesToArchive = unserialize(base64_decode($_SESSION["entriesToArchive"]));
		// $entriesToArchive = $_SESSION["entriesToArchive"];
		$entriesToArchive = unserialize($_POST['entriesToArchive']);
		if($entriesToArchive) {
			echo "Archiving disabled so I don't lose all my data<br>";
			foreach($entriesToArchive as $key=>$value) {
				$key = $value;
				echo "Returned key: $key<br>";
				// $finalEntries.add($key);

				/* // UNCOMMENT THIS TO ALLOW ARCHIVING ENTRIES
				$sql = "UPDATE printrefunds SET archived='1' WHERE printrefunds.id='$key'";
				if($mysqli->query($sql) === TRUE) {
					echo "Archived entry successfully<br>";
				} else {
					echo "Error: " . $sql . "<br>" . $mysqli->error;
				}
				*/ //UNCOMMENT THIS TO ALLOW ARCHIVING ENTRIES
			}
			?>

			<form action="showArchivedHandler.php" method="POST">

				<input type="hidden" name="archived" value="showUnarchived">

				<!-- <select name="archived">
				<option value="showUnarchived">Return</option>
				</select> -->


			<input type="submit" class="btn btn-info" name="showUnarchived" value="Return to unarchived entries">
			</form>

			<?php
			// while($entriesToArchive)
			// 	echo "farts";
			// }
			// $entriesToArchive = urldecode($entriesToArchive);
			// var_dump($entriesToArchive);
			// var_dump($entriesToArchive);
			// echo '<br>';
			// echo "<br>confirm fart";
		} else {
			echo "Error: " . $sql . "<br>" . $mysqli->error;
		}

		// $query = 
		// 	"SELECT p.id,p.date,p.fname,p.lname,p.archived
		// 	FROM printrefunds p
		// 	WHERE p.archived = 1";
	} else if($selection == "return") {
		?>

		<form action="showArchivedHandler.php" method="POST">
			<h4>Return to unarchived entries</h4>

			<input type="hidden" name="archived" value="showUnarchived">

			<!-- <select name="archived">
			<option value="showUnarchived">Return</option>
			</select> -->


		<input type="submit" class="btn btn-info" name="showUnarchived" value="Return">
		</form>

		<?php
		// header('location:printrefund.html');
	}
}
include_once('footer.php');
?>