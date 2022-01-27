<?php
	require_once( 'includes/baza.php' );
	
	session_start();
	if( isSet( $_POST['login'] ) ) {
		$login = $_POST['login'];
		$pass = $_POST['pass'];
 
		$sth = $pdo->prepare( 'SELECT * FROM users WHERE login = :login AND pass = :pass' );
		
		$sth->bindParam( ':login', $login, PDO::PARAM_STR );
		$sth->bindParam( ':pass', $pass, PDO::PARAM_STR );
		$sth->execute();

		$result = $sth->fetch();

		if( $result && isSet( $result['id'] ) ) {
			$_SESSION['logged'] = true;
			$_SESSION['userLogin'] = $result['login'];
			header('location:./loop.php');
			ob_end_flush();
		} 
	
	}
	
	if( !isSet( $_SESSION['logged'] ) || $_SESSION['logged'] == false ) {
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"/>
	<title>CMS</title>
</head>
<body>

<?php require_once 'includes/nav.php'; ?>

<form action="session.php" method="post">
        <ul class="form-style-1">
			<li>
                <label>Login <span class="required">*</span></label>
                <input type="text" name="login" class="field-long" />
            </li>
			<li>
                <label>Hasło <span class="required">*</span></label>
                <input type="password" name="pass" class="field-long" />
            </li>
            <li>
                <input type="submit" value="Logowanie" />
            </li>
        </ul>
        </form>

<?php die; } ?>

</body>
</html>