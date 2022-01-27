<?php
require_once('session.php');
	
$idGet = isSet( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

if( isSet( $_POST['title'] ) ) {
	$id = isSet( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
	if( $id > 0 ) {

		$sth = $pdo->prepare( 'UPDATE `articles` SET `title`=:title, `publishdate`=:publishdate, `robots`=:robots, `description`=:description, `category_id`=:category_id WHERE id = :id' );
		$sth->bindParam( ':id', $id );

	} else {

		$sth = $pdo->prepare( 'INSERT INTO `articles`(`title`, `publishdate`, `robots`, `description`, `category_id`) VALUES ( :title, :publishdate, :robots, :description, :category_id )' );
	
	}
	$sth->bindParam( ':title', $_POST['title'] );
	$sth->bindParam( ':publishdate', $_POST['publishdate'] );
	$sth->bindParam( ':robots', $_POST['robots'] );
	$sth->bindParam( ':description', $_POST['description'] );
	$sth->bindParam( ':category_id', $_POST['category_id'] );
    $sth->execute();
    header( 'location: loop.php' );
	ob_end_flush();
}

if( $idGet > 0 ) {
    $sth = $pdo->prepare( 'SELECT * FROM articles WHERE id = :id' );
	$sth->bindParam( ':id', $idGet );
    $sth->execute();
    $result = $sth->fetch();
}

$sth2 = $pdo->prepare( 'SELECT * FROM categories' );
$sth2->bindParam( ':id', $idGet );
$sth2->execute();

$category = $sth2->fetchAll();

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

<form method="post" action="addedit.php">

<?php
	if( $idGet > 0 ) {
		echo '<input type="hidden" name="id" value="' . $idGet . '">';
	}
?>
        <ul class="form-style-1">
            <li>
                <label>Tytuł strony, nagłówek <span class="required">*</span></label>
                <input type="text" name="title" class="field-long" <?php if( isSet( $result['title'] ) ) { echo 'value="' . $result['title'] . '"'; } ?>/>
            </li>
			<li>
                <label>Data publikacji <span class="required">*</span></label>
                <input type="date" name="publishdate" class="field-long" <?php if( isSet( $result['publishdate'] ) ) { echo 'value="' . $result['publishdate'] . '"'; } ?>/>
            </li>
            <li>
                <label>Treść strony<span class="required">*</span></label>
                <textarea name="description" class="field-long field-textarea"><?php if( isSet( $result['description'] ) ) { echo $result['description'] . ''; } ?></textarea>
            </li>
			<li>
                <label>Kategoria</label>
                <select name="category_id" class="field-select">
				<?php
				foreach ( $category as $value ) {
					$selected = ( $value['id']  == $result['category_id'] ) ? 'selected="selected"' : '';
					echo '<option ' . $selected . ' value="' . $value['id'] . '">' . $value['category'] . '</option>';
				}
				?>
                </select><a href="addeditcategory.php"></br>Dodaj brakującą kategorię</a>
            </li>
			<li>
                <label>Robots</label>
                <select name="robots" class="field-select">
				<option value="index, follow" <?php if( isSet( $result['robots'] ) ) { if($result['robots'] == 'index, follow') { echo 'selected';} else { echo ''; } } ?>>index, follow</option>
  				<option value="index, nofollow" <?php if( isSet( $result['robots'] ) ) { if($result['robots'] == 'index, nofollow') { echo 'selected';} else { echo ''; } } ?>>index, nofollow</option>
  				<option value="noindex, follow" <?php if( isSet( $result['robots'] ) ) { if($result['robots'] == 'noindex, follow') { echo 'selected';} else { echo ''; } } ?>>noindex, follow</option>
				<option value="noindex, nofollow" <?php if( isSet( $result['robots'] ) ) { if($result['robots'] == 'noindex, nofollow') { echo 'selected';} else { echo ''; } } ?>>noindex, nofollow</option>
                </select>
            </li>
            <li>
                <input type="submit" value="Dodaj" /><a href="loopmenu.php">Cofnij</a>
            </li>
        </ul>
        </form>

</body>
</html>