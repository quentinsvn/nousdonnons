<?php

  require_once('../../assets/php/core.php');

      //Connexion

      if(isset($_SESSION['email'])){
          header('Location: ../index.php');
      }

      if(isset($_POST['envoyer'])) {
        $id = htmlspecialchars($_POST['email']);
        $password = sha1($_POST['password']);
        if(!empty($id) AND !empty($password)) {
            $requser = $database->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $requser->execute(array($id,$password));
            $userexist = $requser->rowCount();
            if ($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['email'] = $userinfo['email'];
                header("Location: ../../index.php");
            }
            else {
                $message = "<div style='text-align: center;' class='alert alert-danger'>Identifiants incorrects !</div>";
            }
        }
        else {
            $message = "<div style='text-align: center;' class='alert alert-danger'>Tous les champs doivent être complétés !</div>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlentities($name['nom_site']); ?> - Connexion</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
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
                    <h3 id="login">Connexion</h3>
                    <form method="POST">
                        <div class="forms">
                            <div class="form-group" style="position: relative;">
                                <input type="email" name="email" placeholder="Adresse e-mail">
                                <i id="alt_icon" class="fas fa-at"></i>
                            </div>

                            <div class="form-group" style="position: relative;">
                                <input type="password" name="password" placeholder="Mot de passe">
                                <i id="alt_icon" class="far fa-eye"></i>
                                <div class="forgot">
                                    <a href="">Mot de passe oublié ?</a>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="buttons">
                    <div class="login_button">
                        <button type="submit" name="envoyer">Se connecter</button>
                    </div>
                </div>
                </form>
                <div class="create_account">
                    <p>Nouveau ? <a href="../register">Créer un compte</a></p>
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
