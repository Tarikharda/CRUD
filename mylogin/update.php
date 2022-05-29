<?php require_once 'config.php' ?>
<?php
$id_per = $_GET['id_per'];


$statement = $pdo->prepare('SELECT * FROM personne WHERE id_per = :id_per');
$statement->bindValue(':id_per', $id_per);
$statement->execute();
$members = $statement->fetch();

$errors = [];
$success = [];
$nom = $members['nom'];
$prenom = $members['prenom'];
$mail = $members['mail'];
$date_n = $members['date_n'];
$adresse = $members['adresse'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $pw = md5($_POST['pw']);
    $date_n = $_POST['date_n'];
    $adresse = $_POST['adresse'];


    if (!$nom or !$prenom or !$mail or !$pw or !$date_n or !$adresse) {
        $errors[] = "Your forget something";
    } else {
        $success[] = "updated successfully";
    }
    if (empty($errors)) {
        $query = $pdo->prepare("UPDATE personne SET nom = :nom,prenom = :prenom, mail = :mail,pw=:pw,date_n=:date_n,adresse=:adresse 
                WHERE id_per = :id_per;UPDATE users SET  login = :mail ,pw=:pw WHERE id= :id_per");
        $query->bindValue(':nom', $nom);
        $query->bindValue(':prenom', $prenom);
        $query->bindValue(':mail', $mail);
        $query->bindValue(':pw', $pw);
        $query->bindValue(':date_n', $date_n);
        $query->bindValue(':adresse', $adresse);
        $query->bindValue(':id_per', $id_per);
        $query->execute();
        header('Location: index.php');
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Update members</title>
    <style>
        body {
            overflow-x: hidden;
            height: 100%;
            background-image: url("https://i.imgur.com/GMmCQHC.png");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            font-family: cursive;
            font-weight: bold;
        }

        .card {
            padding: 30px 40px;
            margin-top: 60px;
            margin-bottom: 60px;
            border: none !important;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
        }

        input, button {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 18px !important;
            font-weight: 300
        }

        a {
            text-decoration: none;
        }

    </style>
</head>
<body>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <?php echo $error . "<br/>"; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert alert-success">
        <?php foreach ($success as $suc): ?>
            <?php echo $suc . "<br/>"; ?>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Update Your Account : <b><?php echo $members['nom'] ?></b></h3>
            <div class="card">
                <form class="form-card" method="post" action="">
                    <div class="row justify-content-between text-left">

                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">First name<span class="text-danger"> *</span></label>
                            <input type="text" id="fname" name="prenom" placeholder="Enter your first name"
                                   onblur="validate(1)" value="<?php echo $prenom ?>">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Last name<span class="text-danger"> *</span></label>
                            <input type="text" id="lname" name="nom" placeholder="Enter your last name"
                                   onblur="validate(2)" value="<?php echo $nom ?>">
                        </div>

                    </div>

                    <div class="row justify-content-between text-left">

                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Email<span class="text-danger"> *</span></label>
                            <input type="email" id="email" name="mail" placeholder="Enter your Email"
                                   onblur="validate(3)" value="<?php echo $mail ?>">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Password <span class="text-danger"> *</span></label>
                            <input type="Password" id="mob" name="pw" placeholder="Enter your Password"
                                   onblur="validate(4)">
                        </div>

                    </div>

                    <div class="row justify-content-between text-left">

                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Birthday<span class="text-danger"> *</span></label>
                            <input type="date" id="date" name="date_n" onblur="validate(5)"
                                   value="<?php echo $date_n ?>">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">Address<span class="text-danger"> *</span></label>
                            <input type="text" id="adresse" name="adresse" placeholder="Enter your address"
                                   onblur="validate(2)" value="<?php echo $adresse ?>">
                        </div>

                    </div>


                    <div class="row justify-content-end">
                        <center>
                            <div class="form-group col-sm-6">

                                <button type="submit" class="btn-block btn-success">Update</button>
                                <button type="submit" class="btn btn-outline-secondary"><a href="index.php">Go back</a>
                                </button>

                            </div>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

