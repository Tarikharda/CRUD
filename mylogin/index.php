<?php require_once 'config.php' ?>
<?php
Session_start();

if (!isset($_SESSION['admin'])) {
    header("LOCATION:user.php");
}

?>

<?php
$search = $_GET['search'] ?? null;
$attribute = $_GET['attribute'] ?? 'nom';

if ($search) {

    $statement = $pdo->prepare("SELECT * FROM personne WHERE $attribute like :search ORDER BY id_per");
    $statement->bindValue(':search', "%$search%");
} else {
    $statement = $pdo->prepare("SELECT * FROM personne ORDER BY id_per");
}
$statement->execute();
$members = $statement->fetchAll();


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>list</title>
    <style>
        table {
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            font-family: cursive;
            text-decoration: underline
        }

        body {
            background-color: #eee;
            font-family: cursive;
        }

        #a {
            margin-bottom: 12px;
        }
    </style>
</head>

<body>


    <div class="container">
        <h1>list for membres</h1>
        <a href="create.php" class="btn btn-success" id="a">Create New Person</a>
        <a href="logout.php" class="btn btn-danger" id="a">logout</a>
        <form method="GET">
            <div>
                <select name="attribute" class="form-select" aria-label="Default select example">
                    <option <?php if ($attribute === "prenom") : ?> selected <?php endif; ?> value="prenom">First Name</option>
                    <option <?php if ($attribute === "nom") : ?> selected <?php endif; ?> value="nom">Last Name</option>
                    <option <?php if ($attribute === "mail") : ?> selected <?php endif; ?> value="mail">Email</option>
                    <option <?php if ($attribute === "date_n") : ?> selected <?php endif; ?> value="date_n">Birthday</option>
                    <option <?php if ($attribute === "adresse") : ?> selected <?php endif; ?> value="adresse">Address</option>

                </select>
            </div>
            <br>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="search" name="search" value="<?php echo $search ?>" />
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">lastname</th>
                    <th scope="col">firstname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Address</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $i => $member) : ?>
                    <tr>
                        <th scope="row"><?php echo $member['id_per'] ?></th>
                        <td> <?php echo $member['nom'] ?></td>
                        <td> <?php echo $member['prenom'] ?></td>
                        <td> <?php echo $member['mail'] ?></td>
                        <td> <?php echo $member['date_n'] ?></td>
                        <td> <?php echo $member['adresse'] ?></td>
                        <td>
                            <a href="update.php?id_per=<?php echo $member['id_per'] ?>" class="btn btn-sm btn-outline-primary">Update</a>
                            <form style="display: inline-block" method="post" action="delete.php">
                                <input type="hidden" name="id_per" value="<?php echo $member['id_per'] ?>" />
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>