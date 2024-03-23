<?php
session_start();
$codeApogee = $_GET['codeApogee'];

$users = simplexml_load_file('../../files/xml/members.xml');

//we're are going to create iterator to assign to each user
$index = 0;
$i = 0;

foreach ($users->user as $user) {
	if ($user->codeApogee == $codeApogee) {
		$index = $i;
		break;
	}
	$i++;
}

unset($users->user[$index]);
file_put_contents('../../files/xml/members.xml', $users->asXML());

$_SESSION['message'] = 'Suppression réussi';
header('location: ../../index.php');

?>