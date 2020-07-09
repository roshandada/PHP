<?php
include'functions.php';
include'db/connect.php';

	if (isset($_POST['submit'])) {
		$date = new DateTime();

		unset($_POST['submit']);
		$_POST['messageDate'] = $date->format('Y-m-d');

		insert('message', $_POST);

		echo '<p>Message posted</p>';
		echo '<a href="listmessages.php">Return to message list</a>';
	}
	else {
?>

<form action="addmessage.php"? method="POST">
	
	<label>Select user</label>
	<select name="userId">
		<?php
			$stmt = findAll('person');

			foreach ($stmt as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['firstname'] . ' ' . $row['surname'] . '</option>';
			}
		?>
	</select>

	<label>Message</label>
	<textarea name="messageText"></textarea>

	<input type="submit" name="submit" value="add message" />
</form>

<?php
}
?>
