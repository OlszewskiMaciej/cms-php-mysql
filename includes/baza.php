<?php
error_reporting(E_ERROR | E_PARSE);

    try {
	
        $pdo = new PDO('mysql:host=localhost;dbname=cms;encoding=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch( PDOException $e ) {

	echo 'ERROR: ' . $e->getMessage();
}

ob_start();
?>
  