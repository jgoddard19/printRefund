<?php
include_once('header.php');
?>

<div class="container">
	<div class="row">
		<h3>Show all entries</h3>
		<form action="showAllHandler.php">
		<!-- <input type="Submit" name="Show entries" value="Submit"> -->
		<!-- <p><a class="btn btn-secondary" href="showAllHandler.php" role="submit">Submit &raquo;</a></p> -->
		<input type="submit" class="btn btn-info" value="Submit">
		</form>
	</div>
	<div class="row">
		<h3>Show archived or unarchived entries</h3>
		<form action="showArchivedHandler.php" method="POST">
			<select name="archived">
				<option value="">Select...</option>
				<option value="showArchived">Show all archived</option>
				<option value="showUnarchived">Show all unarchived</option>
			</select>
			<!-- <div class="dropdown" name="archived">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
				<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="#" value="showArchived">HTML</a></li>
					<li><a href="#" value="showUnarchived">CSS</a></li>
				</ul>
			</div> -->
			<input type="submit" class="btn btn-info" value="Submit">
		</form>
	</div>

<!-- Add new entry, not being used right now
	
	<div class="row">
		<h3>Add new entry</h3>
		<form action="newEntryHandler.php" method="POST">
			<table>
			date: <input type="text" name="date" id="date"> <br/>
			first name: <input type="text" name="fname" id="fname"> <br/>
			last name: <input type="text" name="lname" id="lname"> <br/>
			email: <input type="text" name="email" id="email"> <br/>
			uo id: <input type="text" name="uoid" id="uoid"> <br/>
			amount claimed: <input type="text" name="amtClaimed" id="amtClaimed"> <br/>
			location: <input type="text" name="location" id="location"> <br/>
			printer: <input type="text" name="printer" id="printer"> <br/>
			explanation: <input type="text" name="explanation" id="explanation"> <br/>
			submitter: <input type="text" name="submitter" id="submitter"> <br/>

			</table>
			<div class="btn-toolbar">
				<div class="btn-group">
					<input type="submit" class="btn btn-info" value="Add Entry">
					<input type="reset" class="btn btn-info" value="Reset" onClick="window.location.reload()">
				</div>
			</div>
		</form>
	</div>

 -->

</div>

<?php
include_once('footer.php');
?>