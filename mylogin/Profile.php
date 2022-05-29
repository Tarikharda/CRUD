<?php require_once 'config.php' ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("LOCATION:user.php");
}

?>
<?php

$id = $_GET['id'];
$stm = $pdo->prepare("SELECT * From personne WHERE id_per =$id");
$stm->execute();
$result = $stm->fetch();


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            margin-top: 8%;
            padding: 10px;
        }

        form {
            border: 1px solid #eee;
            background-color: #eee;
            width: 600px;
            border-radius: 10px;
            text-align: center;
            padding: 10px;

        }

        a {
            text-decoration: none;
            color: white;
        }

        .img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        #btn {
            width: 100px
        }
    </style>
</head>

<body>
    <center>
        <form>
            <img src="profil.png" alt="" class="img">
            <p><b>First Name :</b><?php echo $result['prenom']; ?></p>
            <p><b>Last Name :</b><?php echo $result['nom']; ?></p>
            <p><b>Email :</b><?php echo $result['mail']; ?></p>
            <p><b>Birthday :</b><?php echo $result['date_n']; ?></p>
            <p><b>Address :</b><?php echo $result['adresse']; ?></p>

            <button type="button" class="btn btn-primary" id="btn" name="update"><a href="update.php?id_per=<?php echo $id ?>">Update</a></button>
            <button type="button" class="btn btn-danger"><a href="logout.php">logout</a></button>
        </form>

    </center>
</body>

</html>