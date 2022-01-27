<?php

require_once( 'session.php' );

$tbl = $pdo->query('SELECT * FROM `categories`');

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

<?php require_once( 'includes/navadmin.php' ); ?>

<main>
<li><a href="logout.php">Wyloguj</a></li>
<h1>Lista kategorii:</h1>

<table>
	<tr>
		<th>Nazwa</th>
		<th>Opcje</th>
	</tr>

<?php

	foreach( $tbl->fetchAll() as $value ) {
?>

	<tr>
		<td><?php echo $value['category'] ?></td>
		<td>
		<a href="deletecategory.php?id=<?php echo $value['id']; ?>" class="delete">Usuń</a>
		<a href="addeditcategory.php?id=<?php echo $value['id']; ?>" class="edit">Edytuj</a>
		</td>
	</tr>

<?php } ?>

</table>
</main>
<?php require_once( 'includes/footer.php' ); ?>

</body>
</html>