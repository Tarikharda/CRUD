<?php require_once 'config.php'?>
<?php

$id = $_POST['id_per'] ?? null;
if (!$id) {
    header("LOCATION:index.php");
    exit();
}

$query = $pdo->prepare("DELETE FROM personne WHERE id_per=:id_per;DELETE FROM users WHERE id=:id_per");
$query->bindValue(':id_per', $id);
$query->execute();

header('Location: index.php');