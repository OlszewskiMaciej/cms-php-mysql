<?php
$orderby = $pdo->query('SELECT * FROM menu ORDER BY ordermenuid ASC');
?>

<nav id="primary_nav_wrap">
<ul>
  <li><a href="loop.php">Panel admina</a></li>
  <li><a href="index.php">Strona główna</a></li>
  <?php foreach( $orderby->fetchAll() as $value ) { ?>
  <li><a href="navmenu.php?id=<?php echo $value['id'] ?>" class="nav-link"><?php echo $value['namemenu'] ?></a></li>
  <?php } ?>
</ul>
</nav>