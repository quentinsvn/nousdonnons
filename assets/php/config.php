<?php
  $name = $database->prepare('SELECT * FROM configuration WHERE id = ?');
  $name->execute(array(1));
  $name = $name->fetch();
?>
