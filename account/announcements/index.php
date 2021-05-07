<?php require_once('../../assets/php/core.php');
if (isset($_SESSION['id'])) {
    $requser = $database->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    $id_user = $user['id']; 
    $annonce = $database->query("SELECT * FROM annonces WHERE id_user = '$id_user'");
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
                            <a href="../security">
                                <li><i class="fas fa-lock"></i> <span>Sécurité</span></li>
                            </a>
                            <a href="index.php">
                                <li class="active"><i class="fas fa-file-alt"></i> <span>Mes Annonces</span></li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            Mes annonces
                        </div>
                        <div class="card-body">
                        <?php while ($an = $annonce->fetch()) {
                        if ($an['publish'] == 1) { ?>
                            <?php
                            $phpdate = strtotime($an['date_publication']);
                            $an['date_publication'] = date('d/m/Y' . ' à ' . 'H:m', $phpdate);
                            ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                           <div class="row">
                                            <div class="col-12 col-sm-3">
                                                <a href="../../announcement/index.php?id=<?php echo $an['id']; ?>"><img style="width:100%;" src="../../uploads/<?php echo $an['miniature']; ?>" alt=""></a> 
                                            </div>
                                            <div class="col-12 col-sm-8">
                                                <div class="infos_announce">
                                                <a style="text-decoration: none; color: black;" href="../../announcement/index.php?id=<?php echo $an['id']; ?>"><h2><?php echo $an['name']; ?></h2></a>
                                                    <div class="infos_auteur">
                                                        <ul class="list_infos_announce">
                                                            <li><i class="fas fa-calendar-day"></i><span><?php echo $an['date_publication'] ?></span></li>
                                                        </ul>
                                                    </div>
                                                    <p><?php echo $an['description']; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-1 d-none d-lg-block d-print-block" style="margin-top: auto; margin-bottom: auto; text-align: center;">
                                                <a href="../announcement/index.php?id=<?php echo $an['id']; ?>" style="color: black;"><i style="font-size: 3em;" class="fas fa-angle-right"></i></a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                        <?php }
                    } ?>
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