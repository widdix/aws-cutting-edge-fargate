<?php
require_once('./shared.php');
if (in_array($_POST['service'], SERVICES)) {
	$pdo = new PDO('mysql:host=' . getenv('RDS_HOSTNAME') .';dbname=test', 'master', getenv('RDS_PASSWORD'));
	$statement = $pdo->prepare('INSERT INTO votes (service) VALUES(?)');
	$statement->execute(array($_POST['service']));
}
header('Location: /');
?>
