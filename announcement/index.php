<?php
require_once('../assets/php/core.php');
if(isset($_SESSION['id'])) {
    $requser = $database->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    if(isset($_GET['id']) AND !empty($_GET['id'])) {
        $get_id = htmlspecialchars($_GET['id']);

        $annonce = $database->prepare("SELECT * FROM annonces WHERE id = ?");
        $annonce->execute(array($get_id));

        if($annonce->rowCount() == 1) {
            $annonce = $annonce->fetch();
            $titre = $annonce['name'];
            $image1 = $annonce['image1'];
            $image2 = $annonce['image2'];
            $image3 = $annonce['image3'];
            $category = $annonce['category'];
            $contenu = $annonce['description'];
            $date = $annonce['date_publication'];
            $type = $annonce['localisation'];
            $auteur = $annonce['auteur'];
        } else {
            header('Location: ../index.php');
        }

    } else {
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../assets/css/style.css' rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title><?php echo htmlentities($name['nom_site']); ?></title>
</head>

<body>

    <div class="main">
        <div class="header_content">
            <nav class="navbar navbar-dark bg-dark pt-3 pb-3" style="padding-left: 100px; padding-right: 100px;">
                <a href="../" class="navbar-brand"><?php echo htmlentities($name['nom_site']); ?></a>
                <div class="form-inline login_post_buttons">
                    <div class="register_login">
                      <?php if(!isset($_SESSION['email'])){ ?>
                        <a href="account/login" id="login">Connexion</a><span> / </span><a id="register" href="account/register">Incription</a>
                      <?php } else { ?>
                    <a href="../account" id="login"><?php echo $user['prenom']; ?></a>
                  <?php } ?>
                    </div>
                        <button onclick="window.location.href='../announcement/create'" id="add"><i class="fas fa-plus"></i> Créer une annonce</button>
                </div>
            </nav>
        </div>

        <div class="container mt-3 mb-3">
            <div class="announce_content">
                <div class="row">
                    <div class="col-12 col-sm-8 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $titre ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Publié le <?php echo date('d/m/Y'. ' à ' .'H:m', strtotime($date)); ?> Par <?php echo $auteur ?></h6>
                                <div class="carousel_img_announce mb-3">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php if($image1 != NULL) { ?>
                                                <div class="carousel-item active">
                                                    <img style="height: 400px;" src="../uploads/<?php echo $image1; ?>" class="d-block w-100">
                                                </div>
                                            <?php } if($image2 != NULL) { ?>
                                            <div class="carousel-item">
                                                <img style="height: 400px;" src="../uploads/<?php echo $image2; ?>" class="d-block w-100">
                                            </div>
                                            <?php } if($image3 != NULL) { ?>
                                            <div class="carousel-item">
                                                <img style="height: 400px;" src="../uploads/<?php echo $image3; ?>" class="d-block w-100">
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>

                                <p class="card-text"><?php echo $contenu; ?></p>

                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Localisation</h5>
                                <div style="width: 100%"><iframe width="100%" height="200" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=49.4404591, 1.0939658&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="http://www.gps.ie/">Google Maps GPS</a></iframe></div><br />
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Contact</h5>
                                <button type="button" class="btn btn-primary btn-lg btn-block"><i class="fas fa-envelope"></i> Envoyer un message</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"><i class="fas fa-phone-alt"></i> Afficher le numéro</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../assets/php/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
<?php
} else {
    header('Location: ../index.php');
}
?>