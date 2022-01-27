<?php require_once 'includes/baza.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"/>
</head>
<body>
<?php require_once 'includes/nav.php'; ?>

<div class="articles__title">
    <h2>Artykuły:</h2>
</div>

<?php

$sql = 'SELECT * FROM articles ORDER BY id DESC';

$tbl = $pdo->query( $sql );

    foreach( $tbl->fetchAll() as $value ) {

?>

<div class="articles">
    <div class="articles__container">
		<div class="articles__card">
            <a href="view.php?id=<?php echo $value['id']; ?>">
                <h2><?php echo $value['title']; ?></h2>
                <p><?php echo $value['description']; ?></p>
            </a>
        </div>  
    </div>
</div>

<?php } ?>

<?php require_once('includes/footer.php'); ?>