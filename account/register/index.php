<?php

require_once('../../assets/php/core.php');

// Inscription

if(isset($_POST['envoyer'])) {
    if (!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['passwordverif'])) {

    $prenom        = htmlspecialchars($_POST['prenom']);
    $nom           = htmlspecialchars($_POST['nom']);
    $email         = htmlspecialchars($_POST['email']);
    $password      = htmlspecialchars($_POST['password']);
    $passwordverif = htmlspecialchars($_POST['passwordverif']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

      $message = "<div style='text-align: center;' class='alert alert-danger'>E-mail incorrect !</div>";
      return;
    } else {

      if ($passwordverif == $password) {

        $password = sha1($passwordverif);

        $emailexist = $database->prepare('SELECT * FROM users WHERE email = ?');
        $emailexist->execute(array($email));

        $countemail = $emailexist->RowCount();
        if ($countemail == 0) {

          $insert = $database->prepare('INSERT INTO users(prenom, nom, email, password) VALUES (?, ?, ?, ?)');
          $insert->execute(array($prenom, $nom, $email, $password));

          $message = "<div style='text-align: center;' class='alert alert-success'>Compte créer avec succès!</div>";

        } else {

          $message = "<div style='text-align: center;' class='alert alert-danger'>E-mail déjà enregistré !</div>";

        }
      } else {

        $message = "<div style='text-align: center;' class='alert alert-danger'>Les mots de passes ne correspondent pas !</div>";

      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo htmlentities($name['nom_site']); ?> - Inscription</title>
  <link rel="stylesheet" href="../../assets/css/login.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      $('.account').click(function() {
        window.location.href = '/account/';
      });
    });
  </script>

</head>

<body>
  <div class="row">
    <div class="col-md-4 no-float">
      <div class="form_content">
        <div class="login_content">
          <?php
          if(isset($message)) {
            echo $message;
          }
          ?>
          <h3 id="login">Inscription</h3>

          <form method="POST">
            <div class="forms">
              <div class="form-group relative">
                <input type="text" name="prenom" placeholder="Prénom">
                <i id="alt_icon" class="fas fa-user"></i>
              </div>

              <div class="form-group relative">
                <input type="text" name="nom" placeholder="Nom">
                <i id="alt_icon" class="fas fa-user"></i>
              </div>

              <div class="form-group relative">
                <input type="email" name="email" placeholder="Adresse e-mail">
                <i id="alt_icon" class="fas fa-at"></i>
              </div>

              <div class="form-group relative">
                <input type="password" name="password" placeholder="Mot de passe">
                <i id="alt_icon" class="fas fa-lock"></i>
              </div>

              <div class="form-group relative">
                <input type="password" name="passwordverif" placeholder="Confirmez le mot de passe">
                <i id="alt_icon" class="fas fa-lock"></i>
              </div>
            </div>
        </div>

        <div class="buttons">
          <div class="login_button">
            <button type="submit" name="envoyer">S'inscrire</button>
          </div>
        </div>
        </form>
        <div class="create_account">
          <p>Déjà un compte ? <a href="../login">Se connecter</a></p>
        </div>

        <div class="copyright">
          <p>2020 <?php echo htmlentities($name['nom_site']); ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-8 no-float hidden-xs">
      <div class="bg_text">

      </div>
    </div>
  </div>

</body>

</html>
