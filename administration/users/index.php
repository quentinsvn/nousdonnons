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
                    <button id="home" onclick="window.location.href='../index.php'"><i class="fas fa-home" aria-hidden="true"></i> Retour accueil</button>
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
                    <li class="active">
                        <a href="../index.php"><i class="fas fa-home" aria-hidden="true"></i> Tableau de bord</a>
                    </li>
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-cog" aria-hidden="true"></i> Configuration</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="../site"><i class="fas fa-sitemap" aria-hidden="true"></i> Site</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-users" aria-hidden="true"></i> Utilisateurs</a>
                        <ul class="collapse list-unstyled" id="usersSubmenu">
                            <li>
                                <a href="../users/see"><i class="fas fa-eye" aria-hidden="true"></i> Voir tout</a>
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
                <h2>Liste des membres</h2>
                <span><i class="fas fa-home"></i> <a href="#">Tableau de bord > Utilisateurs (Voir tout)</a></span>
            </div>

            <div class="content_dashboard">
              <div class="cards_dashboard mb-3">
                  <div class="row">
                      <div class="col-12 col-sm-4 cards_infos">
                          <div class="row">
                              <div class="col-12 col-sm-3 icon_card_col">
                                  <div class="icon_card_dashboard">
                                      <i class="fa-3x fas fa-users"></i>
                                  </div>
                              </div>
                              <div class="col-12 col-sm-8 desc_card_col">
                                  <div class="desc_card_dashboard">
                                      <h5>Membres</h5>
                                      <h2><?php echo $members; ?></h2>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-12 col-sm-6 card_last_members_col mb-3">
                      <div class="card_last_members">
                          <div class="title_last_members ml-2 mt-2 mb-3">
                              <h5>Liste des membres</h5>
                          </div>
                          <table class="table">
                              <tbody>
                                  <?php
                                      $query = $database->prepare("SELECT prenom, nom FROM users LIMIT 10");
                                      $query->execute();
                                      $last_member_prenom = array();
                                      $last_member_nom = array();

                                      while ($row = $query->fetch()) {
                                          $last_member_prenom = $row['prenom'];
                                          $last_member_nom = $row['nom'];
                                  ?>
                                  <tr>
                                      <td><i class="fas fa-user fa-2x" aria-hidden="true"></i></td>
                                      <td><span><?php echo $last_member_prenom. ' ' .$last_member_nom ?></span></td>
                                      <td><button id="see" style="background-color: #2ecc71;"><i class="fas fa-eye" aria-hidden="true"></i> Voir</button></td>
                                      <td><button id="see" style="background-color: #f1c40f;"><i class="fas fa-pen" aria-hidden="true"></i> Editer</button></td>
                                      <td><button style="background-color: #e67e22;" id="see" onclick="window.location.href='../account/'"><i class="fas fa-ban" aria-hidden="true"></i> Bannir</button></td>
                                      <td><button style="background-color: #e74c3c;" id="see" onclick="window.location.href='../account/'"><i class="fas fa-trash" aria-hidden="true"></i> Supprimer</button></td>
                                  </tr>
                                  <?php } ?>
                              </tbody>
                          </table>
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
