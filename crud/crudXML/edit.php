<?php
session_start();
if (isset ($_POST['edit'])) {
	$users = simplexml_load_file('../../files/xml/members.xml');
	foreach ($users->user as $user) {
		if ($user->codeApogee == $_POST['codeApogee']) {
			$user->firstname = $_POST['firstname'];
			$user->lastname = $_POST['lastname'];
			$user->address = $_POST['address'];
			break;
		}
	}

	file_put_contents('../../files/xml/members.xml', $users->asXML());
	$_SESSION['message'] = 'Modification réussi';
	header('location: ../../index.php');
} else {
	$_SESSION['errorMessage'] = 'Selectionner un élément à modifier';
	header('location: ../../index.php');
}
?>