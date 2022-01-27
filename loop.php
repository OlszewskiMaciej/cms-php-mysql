<?php

require_once( 'session.php' );

$count = $pdo->query('SELECT COUNT( id ) as cnt FROM articles')->fetch()['cnt'];
$sql = 'SELECT n.*, cm.category FROM articles n LEFT JOIN categories cm ON n.category_id = cm.id ORDER BY n.id';
$tbl = $pdo->query( $sql );

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
<h1>Liczba artykułów: <?php echo $count ?></h1>

<table>
	<tr>
		<th>Tytuł artykułu</th>
		<th>Data publikacji</th>
		<th>Opcje</th>
	</tr>

<?php

	foreach( $tbl->fetchAll() as $value ) {
?>

	<tr>
		<td><?php echo $value['title']; ?></td>
		<td><?php echo $value['publishdate']; ?></td>
		<td>
		<a href="delete.php?id=<?php echo $value['id']; ?>" class="delete">Usuń</a>
		<a href="addedit.php?id=<?php echo $value['id']; ?>" class="edit">Edytuj</a>
		<a href="view.php?id=<?php echo $value['id']; ?>" class="view">Podgląd strony</a>
		</td>
	</tr>

<?php } ?>

</table>
</main>
<?php require_once( 'includes/footer.php' ); ?>

</body>
</html>