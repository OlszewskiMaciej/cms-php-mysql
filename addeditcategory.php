<?php
	require_once('session.php');
	
	if( isSet( $_POST['category'] ) ) {
		$id = isSet( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
		if( $id > 0 ) {
			$sth = $pdo->prepare( 'UPDATE `categories` SET `category`=:category WHERE id = :id' );
			$sth->bindParam( ':id', $id );
		} else {
			$sth = $pdo->prepare( 'INSERT INTO `categories`(`category`) VALUES ( :category )' );
		}
		$sth->bindParam( ':category', $_POST['category'] );
        $sth->execute();
        header( 'location: loopcategory.php' );
		ob_end_flush();
	}
	$idGet = isSet( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
	if( $idGet > 0 ) {
        $sth = $pdo->prepare( 'SELECT * FROM categories WHERE id = :id' );
		$sth->bindParam( ':id', $idGet );
        $sth->execute();
        $result = $sth->fetch();
	}
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

<?php require_once 'includes/navadmin.php'; ?>

<form method="post" action="addeditcategory.php">

<?php
	if( $idGet > 0 ) {
		echo '<input type="hidden" name="id" value="' . $idGet . '">';
	}
?>
        <ul class="form-style-1">
            <li>
                <label>Tytuł kategorii <span class="required">*</span></label>
                <input type="text" name="category" class="field-long" <?php if( isSet( $result['category'] ) ) { echo 'value="' . $result['category'] . '"'; } ?>/>
            </li>
            <li>
                <input type="submit" value="Dodaj" /><a href="loopcategory.php">Cofnij</a>
            </li>
        </ul>
        </form>

</body>
</html>