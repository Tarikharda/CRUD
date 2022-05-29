<?php require_once 'config.php' ?>
<?php
Session_start();
$login = '';
$pw = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $pw = md5($_POST['pw']);


    $query = $pdo->prepare("SELECT * FROM `personne` WHERE mail=:login and pw=:pw");
    $query->bindValue(':login', $login);
    $query->bindValue(':pw', $pw);
    $query->execute();
    $st = $query->rowCount();
    $stm = $query->fetch();

    if ($st == 1) {
        $query = $pdo->prepare("SELECT * FROM `users` WHERE login=:login and `pw`=:pw");
        $query->bindValue(':login', $login);
        $query->bindValue(':pw', $pw);
        $query->execute();
        $s = $query->fetch();
        $ss = $s['id'];
        if ($s['usertype'] == 1) {
            $_SESSION['admin'] = $ss;
            header("Location:index.php");
        } else {
            $_SESSION['user'] = $ss;
            header("Location:profile.php?id=$ss");
        }
    } else {
        echo "Your Email or password is not correct";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Personne Creat</title>
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

        input {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 18px !important;
            font-weight: 300
        }

        a,
        button {
            text-decoration: none;
            height: 41px;
        }

        .btn-outline-primary:hover {
            background-color: white;
        }

        h3 {
            text-decoration: underline;
            text-shadow: 1px 1px 1px green;
            font-weight: bold;
            letter-spacing: 2px;
        }
    </style>

</head>

<body>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <h3>Enter Your Account</h3>
                <div class="card">
                    <form class="form-card" method="post" action="">

                        <div class="row justify-content-between text-left">

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Email<span class="text-danger"> *</span></label>
                                <input type="email" id="email" name="login" placeholder="Enter your Email" onblur="validate(3)" value="<?php echo $login ?>">
                            </div>

                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Password <span class="text-danger"> *</span></label>
                                <input type="Password" id="mob" name="pw" placeholder="Enter your Password" onblur="validate(4)">
                            </div>

                        </div>
                        <div class="row justify-content-end">
                            <center>
                                <div class="form-group col-sm-6">
                                    <a href="create.php" class="btn btn-primary">Create</a>
                                    <button type="submit" class="btn btn-success">login</button>
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