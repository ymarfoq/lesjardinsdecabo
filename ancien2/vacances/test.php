<?php session_start();

echo $_SESSION['admin'];

$db = new PDO('sqlite:../bases/base.db');

$db->query('INSERT INTO photos (id, pre_id, post_id, album, photo) VALUES (1, 2, 3, "Alentours", "test");');

// fermeture de la base
$db = null;
?>
