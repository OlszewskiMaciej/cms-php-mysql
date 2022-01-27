<?php
	require_once('session.php');
	
	if( isSet( $_POST['namemenu'] ) ) {
		$id = isSet( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
		if( $id > 0 ) {
			$sth = $pdo->prepare( 'UPDATE `menu` SET `namemenu`=:namemenu, `ordermenuid`=:ordermenuid, `sitedescription`=:sitedescription WHERE id = :id' );
			$sth->bindParam( ':id', $id );
		} else {
			$sth = $pdo->prepare( 'INSERT INTO `menu`(`namemenu`, `ordermenuid`, `sitedescription`) VALUES ( :namemenu, :ordermenuid, :sitedescription )' );
		}
		$sth->bindParam( ':namemenu', $_POST['namemenu'] );
		$sth->bindParam( ':ordermenuid', $_POST['ordermenuid'] );
		$sth->bindParam( ':sitedescription', $_POST['sitedescription'] );
        $sth->execute();
        header( 'location: loopmenu.php' );
		ob_end_flush();
	}
	$idGet = isSet( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
	if( $idGet > 0 ) {
        $sth = $pdo->prepare( 'SELECT * FROM menu WHERE id = :id' );
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

<form method="post" action="addeditmenu.php">

<?php
	if( $idGet > 0 ) {
		echo '<input type="hidden" name="id" value="' . $idGet . '">';
	}
?>
        <ul class="form-style-1">
            <li>
                <label>Tytuł strony <span class="required">*</span></label>
                <input type="text" name="namemenu" class="field-long" <?php if( isSet( $result['namemenu'] ) ) { echo 'value="' . $result['namemenu'] . '"'; } ?>/>
            </li>
			<li>
                <label>Miejsce w kolejności <span class="required">*</span></label>
                <input type="number" name="ordermenuid" class="field-long" <?php if( isSet( $result['ordermenuid'] ) ) { echo 'value="' . $result['ordermenuid'] . '"'; } ?>/>
            </li>
            <li>
                <label>Treść strony<span class="required">*</span></label>
                <textarea name="sitedescription" class="field-long field-textarea"><?php if( isSet( $result['sitedescription'] ) ) { echo $result['sitedescription'] . ''; } ?></textarea>
            </li>
            <li>
                <input type="submit" value="Dodaj" /><a href="loopmenu.php">Cofnij</a>
            </li>
        </ul>
        </form>

</body>
</html>