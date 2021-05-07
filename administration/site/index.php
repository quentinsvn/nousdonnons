<?php
require_once('../../assets/php/core.php');

if (isset($_SESSION['id'])) {

  // Récupération données de l'utilisateur
  $requser = $database->prepare("SELECT * FROM users WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();

  // Récupération nombre des membres
  $members = $database->query("SELECT COUNT(id) FROM users")->fetchColumn();
} else {
    header('Location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../../assets/css/admin.css' rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
    <title><?php echo htmlentities($name['nom_site']); ?> - Administration</title>
</head>

<body>

            <nav class="navbar navbar-dark bg-dark pl-5 pr-5 pt-3 pb-3 nv_content" style="color: #f3f3f3;">
                <a class="navbar-brand" href="#">Administration</a>
                <form class="form-inline login_post_buttons">
                    <button id="home" onclick="window.location.href='../../index.php'"><i class="fas fa-home" aria-hidden="true"></i> Retour accueil</button>
                    <button id="profil" onclick="window.location.href='../../account/'"><i class="fas fa-user" aria-hidden="true"></i> <?php echo $user['prenom']; ?></button>
                    <button id="admin" onclick="window.location.href='../../account/'"><i class="fas fa-sign-out-alt"></i> Quitter</button>
                </form>
            </nav>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-user"></i><br>
                <span><?php echo $user['prenom']; ?></span><br>
                <span class="badge badge-danger">Administrateur</span>
            </div>
            <div class="content_menu_sidenav">
                <ul class="list-unstyled components">
                    <span class="nav pl-3 mb-2">Navigation</span>
                    <li>
                        <a href="../index.php"><i class="fas fa-home" aria-hidden="true"></i> Tableau de bord</a>
                    </li>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog" aria-hidden="true"></i> Configuration</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li class="active">
                                <a href="../site"><i class="fas fa-sitemap" aria-hidden="true"></i> Site</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-users" aria-hidden="true"></i> Utilisateurs</a>
                        <ul class="collapse list-unstyled" id="usersSubmenu">
                            <li>
                                <a href="../users"><i class="fas fa-eye" aria-hidden="true"></i> Voir tout</a>
                            </li>
                            <li>
                                <a href="../users/banlist"><i class="fas fa-list" aria-hidden="true"></i> Liste des bans</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-list" aria-hidden="true"></i> Annonces</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="../announcements"><i class="fas fa-eye" aria-hidden="true"></i> Voir tout</a>
                            </li>
                            <li>
                                <a href="../announcements/wait"><i class="fas fa-pause" aria-hidden="true"></i> En attentes</a>
                            </li>
                            <li>
                                <a href="../announcements/valid"><i class="fas fa-check-circle" aria-hidden="true"></i> Acceptées</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <div class="title_content mb-3">
                <h2>Site</h2>
                <span><i class="fas fa-home"></i> <a href="#">Tableau de bord > Configuration (Site)</a></span>
            </div>

            <div class="content_dashboard">
                <div class="row">
                    <div class="col-12 col-sm-6 card_last_members_col mb-3">
                        <div class="card_last_members" style="padding-bottom: 2%;">
                            <div class="title_last_members ml-2 mt-2 mb-3">
                                <h5>Paramètrage du site</h5>
                            </div>
                            <div class="card_last_members_header"></div>
                            <?php
                                // Mise à jour nom du site
                                if (isset($_POST['valider'])) {
                                  $name = $_POST['update_name'];

                                  if (!empty($_POST['update_name'])) {
                                    $update_name = $database->prepare("UPDATE configuration SET nom_site= ?");
                                    $update_name->execute(array($name));
                                    $message = "<div style='text-align: center;' class='alert alert-success'>Nom du site mis à jour.</div>";
                                  } else {
                                    $message = "<div style='text-align: center;' class='alert alert-danger'>Veuillez renseigner tout les champs.</div>";
                                  }
                                }

                                // Message d'alerte
                                if(isset($message)) {
                                  echo $message;
                                }
                               ?>
                              <p>Nom du site</p>
                            <form method="POST">
                                <input name="update_name" type="textarea" value="<?php echo htmlentities($name['nom_site']); ?>">
                                <button id="see" name="valider" type="submit" style="margin-top: 20px;">Mettre à jour</button>
                              </form>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 card_last_members_col mb-3">
                        <div class="card_last_members" style="border-color: #e74c3c;">
                            <div class="title_last_members ml-2 mt-2 mb-3">
                                <h5>Paramètrage de la maintenance</h5>
                            </div>
                            <div class="card_last_members_header"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
