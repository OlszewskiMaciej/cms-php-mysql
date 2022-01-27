<?php
	require_once('includes/baza.php');

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
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

	<?php
		if( $idGet > 0 ) {
			echo '<input type="hidden" name="id" value="' . $idGet . '">';
		}
	?>

<div class="article">
    <div class="article__container">
		<div class="article__card">
				<h1><?php echo $result['namemenu']; ?></h1>
				<p><?php echo $result['sitedescription']; ?></p>
            </a>
        </div>  
    </div>
</div>

<?php require_once 'includes/footer.php';?>
</body>
</html>

