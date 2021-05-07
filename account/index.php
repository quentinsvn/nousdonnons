<?php require_once('../assets/php/core.php');
if (isset($_SESSION['id'])) {
    $requser = $database->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    $prenom = $user['prenom'];
    $nom = $user['nom'];
    $email = $user['email'];
    $tel = $user['telephone'];
    $adresse = $user['adresse'];
    $adresse2 = $user['adresse2'];
    $ville = $user['ville'];
    $departement = $user['departement'];
    $code_postal = $user['code_postal'];
    if(isset($_POST['prenom']) AND !empty($_POST['prenom']) AND $_POST['prenom'] != $user['prenom']) {
        $prenom = htmlspecialchars($_POST['prenom']);
        $insertprenom = $database->prepare("UPDATE users SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['nom']) AND !empty($_POST['nom']) AND $_POST['nom'] != $user['nom']) {
        $prenom = htmlspecialchars($_POST['nom']);
        $insertprenom = $database->prepare("UPDATE users SET nom = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['email']) AND !empty($_POST['email']) AND $_POST['email'] != $user['email']) {
        $prenom = htmlspecialchars($_POST['email']);
        $insertprenom = $database->prepare("UPDATE users SET email = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['tel']) AND !empty($_POST['tel']) AND $_POST['tel'] != $user['tel']) {
        $prenom = htmlspecialchars($_POST['tel']);
        $insertprenom = $database->prepare("UPDATE users SET telephone = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['adresse']) AND !empty($_POST['adresse']) AND $_POST['adresse'] != $user['adresse']) {
        $prenom = htmlspecialchars($_POST['adresse']);
        $insertprenom = $database->prepare("UPDATE users SET adresse = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['adresse2']) AND !empty($_POST['adresse2']) AND $_POST['adresse2'] != $user['adresse2']) {
        $prenom = htmlspecialchars($_POST['adresse2']);
        $insertprenom = $database->prepare("UPDATE users SET adresse2 = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['ville']) AND !empty($_POST['ville']) AND $_POST['ville'] != $user['ville']) {
        $prenom = htmlspecialchars($_POST['ville']);
        $insertprenom = $database->prepare("UPDATE users SET ville = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['departements']) AND !empty($_POST['departements']) AND $_POST['departements'] != $user['departements']) {
        $prenom = htmlspecialchars($_POST['departements']);
        $insertprenom = $database->prepare("UPDATE users SET departement = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['zip']) AND !empty($_POST['zip']) AND $_POST['zip'] != $user['zip']) {
        $prenom = htmlspecialchars($_POST['zip']);
        $insertprenom = $database->prepare("UPDATE users SET code_postal = ? WHERE id = ?");
        $insertprenom->execute(array($prenom, $_SESSION['id']));
        header('Location: index.php');
    }

    if(isset($_POST['edit'])) {
        if(!empty($_POST["newsletter"])) { 
            $news = 1;
        } else {
            $news = 0;
        }
        $insertprenom = $database->prepare("UPDATE users SET newsletter = ? WHERE id = ?");
        $insertprenom->execute(array($news, $_SESSION['id']));
        header('Location: index.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
    <title><?php echo htmlentities($name['nom_site']); ?> - Mon profil</title>
</head>

<body>

    <div class="main">
        <div class="header_content">
            <nav class="navbar navbar-dark bg-dark nv_content">
                <a href="../index.php" class="navbar-brand"><?php echo htmlentities($name['nom_site']); ?></a>
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
                            <a href="index.php">
                                <li class="active"><i class="fas fa-user"></i> <span>Mon Compte</span></li>
                            </a>
                            <a href="security/">
                                <li><i class="fas fa-lock"></i> <span>Sécurité</span></li>
                            </a>
                            <a href="announcements/">
                                <li><i class="fas fa-file-alt"></i> <span>Mes Annonces</span></li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            Mon Compte
                        </div>
                        <div class="card-body">
                            <?php
                                if(isset($message)) {
                                    echo $message;
                                }
                            ?>
                            <form method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Prénom</label>
                                        <input name="prenom" type="text" value="<?php if(isset($prenom)) { echo $prenom; } ?>" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Nom</label>
                                        <input name="nom" type="text" value="<?php if(isset($nom)) { echo $nom; } ?>" class="form-control" id="inputPassword4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddressEmail">Adresse E-mail</label>
                                    <input name="email" type="email" value="<?php if(isset($email)) { echo $email; } ?>" class="form-control" id="inputAddressEmail">
                                </div>
                                <div class="form-group">
                                    <label for="inputTel">Numéro de téléphone</label>
                                    <input name="tel" type="number" value="<?php if(isset($tel)) { echo $tel; } ?>" class="form-control" id="inputTel">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Adresse Postale</label>
                                    <input name="adresse" value="<?php if(isset($adresse)) { echo $adresse; } ?>" type="text" class="form-control" id="inputAddress">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Complément d'adresse</label>
                                    <input name="adresse2" value="<?php if(isset($adresse2)) { echo $adresse2; } ?>" type="text" class="form-control" id="inputAddress2">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Ville</label>
                                        <input name="ville" value="<?php if(isset($ville)) { echo $ville; } ?>" type="text" class="form-control" id="inputCity">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Département</label>
                                        <select name="departements" id="inputState" class="form-control">
                                            <option value="<?php if(isset($departement)) { echo $departement; } ?>"><?php if(isset($departement)) { echo $departement; } ?></option>
                                            <option value="Ain">Ain</option>
                                            <option value="Aisne">Aisne</option>
                                            <option value="Allier">Allier</option>
                                            <option value="Alpes-de-Haute-Provence">Alpes-de-Haute-Provence</option>
                                            <option value="Alpes-Maritimes">Alpes-Maritimes</option>
                                            <option value="Ardèche">Ardèche</option>
                                            <option value="Ardennes">Ardennes</option>
                                            <option value="Ariège">Ariège</option>
                                            <option value="Aube">Aube</option>
                                            <option value="Aude">Aude</option>
                                            <option value="Aveyron">Aveyron</option>
                                            <option value="Bas-Rhin">Bas-Rhin</option>
                                            <option value="Bouches-du-Rhône">Bouches-du-Rhône</option>
                                            <option value="Calvados">Calvados</option>
                                            <option value="Cantal">Cantal</option>
                                            <option value="Charente">Charente</option>
                                            <option value="Charente-Maritime">Charente-Maritime</option>
                                            <option value="Cher">Cher</option>
                                            <option value="Corrèze">Corrèze</option>
                                            <option value="Corse-du-Sud">Corse-du-Sud</option>
                                            <option value="Côte-d'Or">Côte-d'Or</option>
                                            <option value="Côtes-d'Armor">Côtes-d'Armor</option>
                                            <option value="Creuse">Creuse</option>
                                            <option value="Deux-Sèvres">Deux-Sèvres</option>
                                            <option value="Dordogne">Dordogne</option>
                                            <option value="Doubs">Doubs</option>
                                            <option value="Drôme">Drôme</option>
                                            <option value="Essonne">Essonne</option>
                                            <option value="Eure">Eure</option>
                                            <option value="Eure-et-Loir">Eure-et-Loir</option>
                                            <option value="Finistère">Finistère</option>
                                            <option value="Gard">Gard</option>
                                            <option value="Gers">Gers</option>
                                            <option value="Gironde">Gironde</option>
                                            <option value="Haut-Rhin">Haut-Rhin</option>
                                            <option value="Haute-Corse">Haute-Corse</option>
                                            <option value="Haute-Garonne">Haute-Garonne</option>
                                            <option value="Haute-Loire">Haute-Loire</option>
                                            <option value="Haute-Marne">Haute-Marne</option>
                                            <option value="Haute-Saône">Haute-Saône</option>
                                            <option value="Haute-Savoie">Haute-Savoie</option>
                                            <option value="Haute-Vienne">Haute-Vienne</option>
                                            <option value="Hautes-Alpes">Hautes-Alpes</option>
                                            <option value="Hautes-Pyrénées">Hautes-Pyrénées</option>
                                            <option value="Hauts-de-Seine">Hauts-de-Seine</option>
                                            <option value="Hérault">Hérault</option>
                                            <option value="Ille-et-Vilaine">Ille-et-Vilaine</option>
                                            <option value="Indre">Indre</option>
                                            <option value="Indre-et-Loire">Indre-et-Loire</option>
                                            <option value="Isère">Isère</option>
                                            <option value="Jura">Jura</option>
                                            <option value="Landes">Landes</option>
                                            <option value="Loir-et-Cher">Loir-et-Cher</option>
                                            <option value="Loire">Loire</option>
                                            <option value="Loire-Atlantique">Loire-Atlantique</option>
                                            <option value="Loiret">Loiret</option>
                                            <option value="Lot">Lot</option>
                                            <option value="Lot-et-Garonne">Lot-et-Garonne</option>
                                            <option value="Lozère">Lozère</option>
                                            <option value="Maine-et-Loire">Maine-et-Loire</option>
                                            <option value="Manche">Manche</option>
                                            <option value="Marne">Marne</option>
                                            <option value="Mayenne">Mayenne</option>
                                            <option value="Meurthe-et-Moselle">Meurthe-et-Moselle</option>
                                            <option value="Meuse">Meuse</option>
                                            <option value="Morbihan">Morbihan</option>
                                            <option value="Moselle">Moselle</option>
                                            <option value="Nièvre">Nièvre</option>
                                            <option value="Nord">Nord</option>
                                            <option value="Oise">Oise</option>
                                            <option value="Orne">Orne</option>
                                            <option value="Paris">Paris</option>
                                            <option value="Pas-de-Calais">Pas-de-Calais</option>
                                            <option value="Puy-de-Dôme">Puy-de-Dôme</option>
                                            <option value="Pyrénées-Atlantiques">Pyrénées-Atlantiques</option>
                                            <option value="Pyrénées-Orientales">Pyrénées-Orientales</option>
                                            <option value="Rhône">Rhône</option>
                                            <option value="Saône-et-Loire">Saône-et-Loire</option>
                                            <option value="Sarthe">Sarthe</option>
                                            <option value="Savoie">Savoie</option>
                                            <option value="Seine-et-Marne">Seine-et-Marne</option>
                                            <option value="Seine-Maritime">Seine-Maritime</option>
                                            <option value="Seine-Saint-Denis">Seine-Saint-Denis</option>
                                            <option value="Somme">Somme</option>
                                            <option value="Tarn">Tarn</option>
                                            <option value="Tarn-et-Garonne">Tarn-et-Garonne</option>
                                            <option value="Territoire de Belfort">Territoire de Belfort</option>
                                            <option value="Val-d'Oise">Val-d'Oise</option>
                                            <option value="Val-de-Marne">Val-de-Marne</option>
                                            <option value="Var">Var</option>
                                            <option value="Vaucluse">Vaucluse</option>
                                            <option value="Vendée">Vendée</option>
                                            <option value="Vienne">Vienne</option>
                                            <option value="Vosges">Vosges</option>
                                            <option value="Yonne">Yonne</option>
                                            <option value="Yvelines">Yvelines</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guyane">Guyane</option>
                                            <option value="La Réunion">La Réunion</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mayotte">Mayotte</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">Code Postal</label>
                                        <input value="<?php if(isset($code_postal)) { echo $code_postal; } ?>" name="zip" type="text" class="form-control" id="inputZip">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input <?php if($user['newsletter'] == 1) { echo "checked"; } ?> name="newsletter" class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            S'abonner à la newsletter
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" name="edit" class="btn btn-primary">Modifier</button>
                            </form>
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