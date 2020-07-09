<?php
include'functions.php';
include'db/connect.php';


$stmt = findAll('message');
$stmt->execute();

echo '<ul>';
foreach ($stmt as $row) {

	$userQuery = find('person' , 'id', $row['userId']);

	$user = $userQuery->fetch();

	$date = new DateTime($row['messageDate']);

	echo '<li>' . $row['messageText'] . ' posted by 
		<strong>' . $user['firstname'] . ' ' . $user['surname'] . '</strong> 
		on <em>' . $date->format('d/m/Y') . '</em>';

}
echo '</ul>';

echo '<a href="addmessage.php">Add a new message</a>';
?>
