<?php

require_once('session.php');

$id = 0;
if (isSet ($_GET['id'])) 
{
	$id = intval($_GET['id']);
}

if ($id > 0)
{
	$sth = $pdo->prepare('DELETE FROM menu WHERE id = :id');
	$sth->bindParam(':id', $id);
	$sth->execute();

	header('location: loopmenu.php');
	ob_end_flush();
} else {
	header ('location: loopmenu.php');
	ob_end_flush();
}