<?php
require_once('../assets/php/core.php');

if (isset($_SESSION['id'])) {
    $requser = $database->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
}

$annonce = $database->query('SELECT * FROM annonces ORDER BY id');
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
                <a href="../index.php" class="navbar-brand"><?php echo htmlentities($name['nom_site']); ?></a>
                <div class="form-inline login_post_buttons">
                    <div class="register_login">
                        <?php if (!isset($_SESSION['email'])) { ?>
                            <a href="account/login" id="login">Connexion</a><span> / </span><a id="register" href="account/register">Incription</a>
                        <?php } else { ?>
                            <a href="../account" id="login"><?php echo $user['prenom']; ?></a>
                        <?php } ?>
                    </div>
                    <button onclick="window.location.href='../announcement/create'" id="add"><i class="fas fa-plus"></i> Créer une annonce</button>
                </div>
            </nav>
        </div>

        <div class="search_content mr-5 ml-5 mt-3 mb-3">
            <div class="row">
                <div class="col-12 col-sm-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Rechercher</h5>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Rechercher une annonce...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Trier</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Trier par</h6>
                            <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Nouveautés</option>
                                    <option>Popularités</option>
                                    <option>Date</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Départements</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Liste des départements</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Ain
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    Aisne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">
                                    Allier
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                <label class="form-check-label" for="defaultCheck4">
                                    Alpes-de-Haute-Provence
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck5">
                                <label class="form-check-label" for="defaultCheck5">
                                    Hautes-alpes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck6">
                                <label class="form-check-label" for="defaultCheck6">
                                    Alpes-maritimes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck7">
                                <label class="form-check-label" for="defaultCheck7">
                                    Ardèche
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck8">
                                <label class="form-check-label" for="defaultCheck8">
                                    Ardèche
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck9">
                                <label class="form-check-label" for="defaultCheck9">
                                    Ardennes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck10">
                                <label class="form-check-label" for="defaultCheck10">
                                    Ariège
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck11">
                                <label class="form-check-label" for="defaultCheck11">
                                    Aube
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck12">
                                <label class="form-check-label" for="defaultCheck12">
                                    Aude
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck13">
                                <label class="form-check-label" for="defaultCheck13">
                                    Aveyron
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck14">
                                <label class="form-check-label" for="defaultCheck14">
                                    Bouches-du-Rhône
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck15">
                                <label class="form-check-label" for="defaultCheck15">
                                    Cantal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck16">
                                <label class="form-check-label" for="defaultCheck16">
                                    Charente
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck17">
                                <label class="form-check-label" for="defaultCheck17">
                                    Charente-maritime
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck18">
                                <label class="form-check-label" for="defaultCheck18">
                                    Cher
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck19">
                                <label class="form-check-label" for="defaultCheck19">
                                    Cher
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck20">
                                <label class="form-check-label" for="defaultCheck20">
                                    Corrèze
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck21">
                                <label class="form-check-label" for="defaultCheck21">
                                    Corse-du-sud
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck22">
                                <label class="form-check-label" for="defaultCheck22">
                                    Haute-Corse
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck23">
                                <label class="form-check-label" for="defaultCheck23">
                                    Côte-d'Or
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck24">
                                <label class="form-check-label" for="defaultCheck24">
                                    Côtes-d'Armor
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck25">
                                <label class="form-check-label" for="defaultCheck25">
                                    Creuse
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck26">
                                <label class="form-check-label" for="defaultCheck26">
                                    Dordogne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck27">
                                <label class="form-check-label" for="defaultCheck27">
                                    Doubs
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck28">
                                <label class="form-check-label" for="defaultCheck28">
                                    Drôme
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck29">
                                <label class="form-check-label" for="defaultCheck29">
                                    Eure
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck30">
                                <label class="form-check-label" for="defaultCheck30">
                                    Finistère
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck31">
                                <label class="form-check-label" for="defaultCheck31">
                                    Gard
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck32">
                                <label class="form-check-label" for="defaultCheck32">
                                    Haute-garonne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck33">
                                <label class="form-check-label" for="defaultCheck33">
                                    Gers
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck34">
                                <label class="form-check-label" for="defaultCheck34">
                                    Gironde
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck35">
                                <label class="form-check-label" for="defaultCheck35">
                                    Hérault
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck36">
                                <label class="form-check-label" for="defaultCheck36">
                                    Ille-et-vilaine
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck37">
                                <label class="form-check-label" for="defaultCheck37">
                                    Indre
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck38">
                                <label class="form-check-label" for="defaultCheck38">
                                    Indre-et-loire
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck39">
                                <label class="form-check-label" for="defaultCheck39">
                                    Isère
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck40">
                                <label class="form-check-label" for="defaultCheck40">
                                    Jura
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck41">
                                <label class="form-check-label" for="defaultCheck41">
                                    Landes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck42">
                                <label class="form-check-label" for="defaultCheck42">
                                    Loir-et-cher
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck43">
                                <label class="form-check-label" for="defaultCheck43">
                                    Loire
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck44">
                                <label class="form-check-label" for="defaultCheck44">
                                    Haute-loire
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck45">
                                <label class="form-check-label" for="defaultCheck45">
                                    Loire-atlantique
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck46">
                                <label class="form-check-label" for="defaultCheck46">
                                    Loiret
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck47">
                                <label class="form-check-label" for="defaultCheck47">
                                    Lot
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck48">
                                <label class="form-check-label" for="defaultCheck48">
                                    Lot-et-garonne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck49">
                                <label class="form-check-label" for="defaultCheck49">
                                    Lozère
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck50">
                                <label class="form-check-label" for="defaultCheck50">
                                    Maine-et-loire
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck51">
                                <label class="form-check-label" for="defaultCheck51">
                                    Manche
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck52">
                                <label class="form-check-label" for="defaultCheck52">
                                    Marne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck53">
                                <label class="form-check-label" for="defaultCheck53">
                                    Haute-marne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck54">
                                <label class="form-check-label" for="defaultCheck54">
                                    Mayenne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck55">
                                <label class="form-check-label" for="defaultCheck55">
                                    Meurthe-et-moselle
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck56">
                                <label class="form-check-label" for="defaultCheck56">
                                    Meuse
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck57">
                                <label class="form-check-label" for="defaultCheck57">
                                    Morbihan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck58">
                                <label class="form-check-label" for="defaultCheck58">
                                    Moselle
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck59">
                                <label class="form-check-label" for="defaultCheck59">
                                    Nièvre
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck60">
                                <label class="form-check-label" for="defaultCheck61">
                                    Nord
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck62">
                                <label class="form-check-label" for="defaultCheck62">
                                    Oise
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck63">
                                <label class="form-check-label" for="defaultCheck63">
                                    Orne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck64">
                                <label class="form-check-label" for="defaultCheck64">
                                    Pas-de-calais
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck65">
                                <label class="form-check-label" for="defaultCheck65">
                                    Puy-de-dôme
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck66">
                                <label class="form-check-label" for="defaultCheck66">
                                    Pyrénées-atlantiques
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck67">
                                <label class="form-check-label" for="defaultCheck67">
                                    Hautes-Pyrénées
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck68">
                                <label class="form-check-label" for="defaultCheck68">
                                    Pyrénées-orientales
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck69">
                                <label class="form-check-label" for="defaultCheck69">
                                    Bas-rhin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck70">
                                <label class="form-check-label" for="defaultCheck70">
                                    Haut-rhin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck71">
                                <label class="form-check-label" for="defaultCheck71">
                                    Rhône
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck72">
                                <label class="form-check-label" for="defaultCheck72">
                                    Haute-saône
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck73">
                                <label class="form-check-label" for="defaultCheck73">
                                    Saône-et-loire
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck74">
                                <label class="form-check-label" for="defaultCheck74">
                                    Sarthe
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck75">
                                <label class="form-check-label" for="defaultCheck75">
                                    Savoie
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck76">
                                <label class="form-check-label" for="defaultCheck76">
                                    Haute-savoie
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck77">
                                <label class="form-check-label" for="defaultCheck77">
                                    Paris
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck78">
                                <label class="form-check-label" for="defaultCheck78">
                                    Seine-maritime
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck79">
                                <label class="form-check-label" for="defaultCheck79">
                                    Seine-et-marne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck80">
                                <label class="form-check-label" for="defaultCheck80">
                                    Yvelines
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck80">
                                <label class="form-check-label" for="defaultCheck80">
                                    Deux-sèvres
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck81">
                                <label class="form-check-label" for="defaultCheck81">
                                    Somme
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck82">
                                <label class="form-check-label" for="defaultCheck82">
                                    Tarn
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck83">
                                <label class="form-check-label" for="defaultCheck83">
                                    Tarn-et-Garonne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck84">
                                <label class="form-check-label" for="defaultCheck84">
                                    Var
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck85">
                                <label class="form-check-label" for="defaultCheck85">
                                    Vaucluse
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck86">
                                <label class="form-check-label" for="defaultCheck86">
                                    Vendée
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck87">
                                <label class="form-check-label" for="defaultCheck87">
                                    Vienne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck88">
                                <label class="form-check-label" for="defaultCheck88">
                                    Haute-vienne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck89">
                                <label class="form-check-label" for="defaultCheck89">
                                    Vosges
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck90">
                                <label class="form-check-label" for="defaultCheck90">
                                    Yonne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck91">
                                <label class="form-check-label" for="defaultCheck91">
                                    Territoire de belfort
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="92">
                                <label class="form-check-label" for="defaultCheck92">
                                    Essonne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck93">
                                <label class="form-check-label" for="defaultCheck93">
                                    Hauts-de-seine
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck94">
                                <label class="form-check-label" for="defaultCheck94">
                                    Seine-Saint-Denis
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck95">
                                <label class="form-check-label" for="defaultCheck95">
                                    Val-de-marne
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck96">
                                <label class="form-check-label" for="defaultCheck96">
                                    Val-d'Oise
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck97">
                                <label class="form-check-label" for="defaultCheck97">
                                    Guadeloupe
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck98">
                                <label class="form-check-label" for="defaultCheck98">
                                    Martinique
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck99">
                                <label class="form-check-label" for="defaultCheck99">
                                    Guyane
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck100">
                                <label class="form-check-label" for="defaultCheck100">
                                    La réunion
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck101">
                                <label class="form-check-label" for="defaultCheck101">
                                    Mayotte
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Catégories</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Liste des catégories</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Maison
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    Mode
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">
                                    Véhicules
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                <label class="form-check-label" for="defaultCheck4">
                                    Multimédia
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck5">
                                <label class="form-check-label" for="defaultCheck5">
                                    Loisirs
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck6">
                                <label class="form-check-label" for="defaultCheck6">
                                    Matériel Professionnel
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck7">
                                <label class="form-check-label" for="defaultCheck7">
                                    Autres
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-sm-9">
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
                                                <a href="../announcement/index.php?id=<?php echo $an['id']; ?>"><img style="width:100%;" src="../uploads/<?php echo $an['miniature']; ?>" alt=""></a> 
                                            </div>
                                            <div class="col-12 col-sm-8">
                                                <div class="infos_announce">
                                                <a style="text-decoration: none; color: black;" href="../announcement/index.php?id=<?php echo $an['id']; ?>"><h2><?php echo $an['name']; ?></h2></a>
                                                    <div class="infos_auteur">
                                                        <ul class="list_infos_announce">
                                                            <li><i class="fas fa-user"></i><span><?php echo $an['auteur']; ?></span></li>
                                                            <li><i class="fas fa-calendar-day"></i><span><?php echo $an['date_publication'] ?></span></li>
                                                            <li><i class="fas fa-map-marker"></i><span>Normandie, Rouen</span></li>
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

    <?php include '../assets/php/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>