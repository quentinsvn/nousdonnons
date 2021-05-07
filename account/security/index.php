<?php require_once('../../assets/php/core.php');
if (isset($_SESSION['id'])) {
    $requser = $database->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['edit'])) {
        $mdp = sha1($_POST['mdp']);
        $mdpconfirm = sha1($_POST['mdpconfirm']);

        if(!empty($_POST['mdp']) AND !empty($_POST['mdpconfirm'])) {
            if($mdp === $mdpconfirm) {
                $insertmdp = $database->prepare("UPDATE users SET password = ? WHERE id = ?");
                $insertmdp->execute(array($mdp, $_SESSION['id']));
                header('Location: index.php');
            } else {
                $message = "<div style='text-align: center;' class='alert alert-danger'>Les mots de passe ne correspondent pas !</div>";
            }
        } else {
            $message = "<div style='text-align: center;' class='alert alert-danger'>Veuillez remplir tous les champs !</div>";
        }
    }
} else {
    header('Location: ../../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../../assets/css/style.css' rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
    <title><?php echo htmlentities($name['nom_site']); ?> - Mon profil</title>
</head>

<body>

    <div class="main">
        <div class="header_content">
            <nav class="navbar navbar-dark bg-dark nv_content">
                <a href="../../index.php" class="navbar-brand"><?php echo htmlentities($name['nom_site']); ?></a>
                <div class="form-inline login_post_buttons">
                    <div class="register_login">
                        <a href="disconnect.php" id="login">Se déconnecter</a>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container mt-4">
            <div class="row mb-4">
                <div class="col-sm-4 col-12">
                    <div class="tabs_profile">
                        <ul class="tabs_profile_ul">
                            <a href="../index.php">
                                <li><i class="fas fa-user"></i> <span>Mon Compte</span></li>
                            </a>
                            <a href="index.php">
                                <li class="active"><i class="fas fa-lock"></i> <span>Sécurité</span></li>
                            </a>
                            <a href="../announcements">
                                <li><i class="fas fa-file-alt"></i> <span>Mes Annonces</span></li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            Sécurité
                        </div>
                        <div class="card-body">
                            <?php 
                                if(isset($message)) {
                                    echo $message;
                                }
                            ?>
                            <form method="post">
                                <div class="form-group">
                                    <label for="inputAddressEmail">Mot de passe</label>
                                    <input name="mdp" type="password" class="form-control" id="inputAddressEmail">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Confirmer le mot de passe</label>
                                    <input name="mdpconfirm" type="password" class="form-control" id="inputAddress">
                                </div>
                                <button type="submit" name="edit" class="btn btn-primary">Modifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include '../../assets/php/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>