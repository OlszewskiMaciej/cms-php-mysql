<?php
	require_once('includes/baza.php');

	$idGet = isSet( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
	if( $idGet > 0 ) {

        $sth = $pdo->prepare( 'SELECT * FROM articles WHERE id = :id' );
		$sth->bindParam( ':id', $idGet );
        $sth->execute();
        $result = $sth->fetch();

        $sth2 = $pdo->prepare( 'SELECT * FROM categories LEFT JOIN articles ON articles.category_id = categories.id WHERE articles.id = :id' );
		$sth2->bindParam( ':id', $idGet );
        $sth2->execute();
        $result2 = $sth2->fetch();
	}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"/>
	<title><?php echo $result['title']; ?></title>
	<meta name="robots" content="<?php echo $result['robots']; ?>" />
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<div class="article">
    <div class="article__container">
		<div class="article__card">
                <h1><?php echo $result['title']; ?></h1>
				<p>Data publikacji: <?php echo $result['publishdate']; ?></p>
				<p>Kategoria: <?php echo $result2['category']; ?></p>
                <p><?php echo $result['description']; ?></p>
            </a>
        </div>  
    </div>
</div>

<?php require_once('includes/footer.php'); ?>

</body>
