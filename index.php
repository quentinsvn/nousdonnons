<?php
require_once('assets/php/core.php');
if(isset($_SESSION['id'])) {
    $requser = $database->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
}
$annonce = $database->query('SELECT * FROM annonces ORDER BY id');
$popular = $database->query('SELECT * FROM annonces ORDER BY id');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='assets/css/style.css' rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
    <title><?php echo htmlentities($name['nom_site']); ?> - Site de don d'objet..</title>
</head>

<body>

    <div class="main">
        <div class="header_content">
            <nav class="navbar navbar-dark nv_content">
                <a class="navbar-brand"><?php echo htmlentities($name['nom_site']); ?></a>
                <div class="form-inline login_post_buttons">
                    <div class="register_login">
                      <?php if(!isset($_SESSION['email'])){ ?>
                        <a href="account/login" id="login">Connexion</a><span> / </span><a id="register" href="account/register">Incription</a>
                      <?php } else { ?>
                    <a href="account/" id="login"><?php echo $user['prenom']; ?></a>
                  <?php } ?>
                    </div>
                    <button onclick="window.location.href='announcement/create'" id="add"><i class="fas fa-plus"></i> Créer une annonce</button>
                    <?php if (isset($_SESSION['id']) && $user['rank'] >= 1){ ?>
                      <button id="admin" onclick="window.location.href='administration/'"><i class="fas fa-users-cog"></i> Administration</button>
                    <?php } ?>
                </div>
            </nav>

            <div class="banner_content">
                <div class="para_banner">
                    <p>Le meilleur endroit pour donner ou trouver des objets qui ne servent plus !</p>
                </div>
                <div class="search_bar">
                    <form method="POST" action=" ">
                        <select name="dep" class="departements">
                            <option value="01">&#40;01&#41; Ain </option>
                            <option value="02">&#40;02&#41; Aisne </option>
                            <option value="03">&#40;03&#41; Allier </option>
                            <option value="04">&#40;04&#41; Alpes de Haute Provence </option>
                            <option value="05">&#40;05&#41; Hautes Alpes </option>
                            <option value="06">&#40;06&#41; Alpes Maritimes </option>
                            <option value="07">&#40;07&#41; Ardèche </option>
                            <option value="08">&#40;08&#41; Ardennes </option>
                            <option value="09">&#40;09&#41; Ariège </option>
                            <option value="10">&#40;10&#41; Aube </option>
                            <option value="11">&#40;11&#41; Aude </option>
                            <option value="12">&#40;12&#41; Aveyron </option>
                            <option value="13">&#40;13&#41; Bouches du Rhône </option>
                            <option value="14">&#40;14&#41; Calvados </option>
                            <option value="15">&#40;15&#41; Cantal </option>
                            <option value="16">&#40;16&#41; Charente </option>
                            <option value="2A">&#40;2A&#41; Corse du Sud </option>
                            <option value="41">&#40;41&#41; Loir et Cher </option>
                            <option value="51">&#40;51&#41; Marne </option>
                            <option value="17">&#40;17&#41; Charente Maritime </option>
                            <option value="18">&#40;18&#41; Cher </option>
                            <option value="19">&#40;19&#41; Corrèze </option>
                            <option value="21">&#40;21&#41; Côte d'Or </option>
                            <option value="22">&#40;22&#41; Côtes d'Armor </option>
                            <option value="23">&#40;23&#41; Creuse </option>
                            <option value="24">&#40;24&#41; Dordogne </option>
                            <option value="25">&#40;25&#41; Doubs </option>
                            <option value="26">&#40;26&#41; Drôme </option>
                            <option value="27">&#40;27&#41; Eure </option>
                            <option value="28">&#40;28&#41; Eure et Loir </option>
                            <option value="29">&#40;29&#41; Finistère </option>
                            <option value="2B">&#40;2B&#41; Haute-Corse </option>
                            <option value="30">&#40;30&#41; Gard </option>
                            <option value="31">&#40;31&#41; Haute Garonne </option>
                            <option value="53">&#40;53&#41; Mayenne </option>
                            <option value="60">&#40;60&#41; Oise </option>
                            <option value="61">&#40;61&#41; Orne </option>
                            <option value="32">&#40;32&#41; Gers </option>
                            <option value="33">&#40;33&#41; Gironde </option>
                            <option value="34">&#40;34&#41; Hérault </option>
                            <option value="35">&#40;35&#41; Ille et Vilaine </option>
                            <option value="36">&#40;36&#41; Indre </option>
                            <option value="37">&#40;37&#41; Indre et Loire </option>
                            <option value="38">&#40;38&#41; Isère </option>
                            <option value="39">&#40;39&#41; Jura </option>
                            <option value="40">&#40;40&#41; Landes </option>
                            <option value="42">&#40;42&#41; Loire </option>
                            <option value="43">&#40;43&#41; Haute Loire </option>
                            <option value="44">&#40;44&#41; Loire Atlantique </option>
                            <option value="45">&#40;45&#41; Loiret </option>
                            <option value="46">&#40;46&#41; Lot </option>
                            <option value="47">&#40;47&#41; Lot et Garonne </option>
                            <option value="63">&#40;63&#41; Puy de Dôme </option>
                            <option value="80">&#40;80&#41; Somme </option>
                            <option value="81">&#40;81&#41; Tarn </option>
                            <option value="48">&#40;48&#41; Lozère </option>
                            <option value="49">&#40;49&#41; Maine et Loire </option>
                            <option value="50">&#40;50&#41; Manche </option>
                            <option value="52">&#40;52&#41; Haute Marne </option>
                            <option value="54">&#40;54&#41; Meurthe et Moselle </option>
                            <option value="55">&#40;55&#41; Meuse </option>
                            <option value="56">&#40;56&#41; Morbihan </option>
                            <option value="57">&#40;57&#41; Moselle </option>
                            <option value="58">&#40;58&#41; Nièvre </option>
                            <option value="59">&#40;59&#41; Nord </option>
                            <option value="62">&#40;62&#41; Pas de Calais </option>
                            <option value="64">&#40;64&#41; Pyrénées Atlantiques </option>
                            <option value="65">&#40;65&#41; Hautes Pyrénées </option>
                            <option value="66">&#40;66&#41; Pyrénées Orientales </option>
                            <option value="67">&#40;67&#41; Bas Rhin </option>
                            <option value="68">&#40;68&#41; Haut Rhin </option>
                            <option value="70">&#40;70&#41; Haute Saône </option>
                            <option value="71">&#40;71&#41; Saône et Loire </option>
                            <option value="69">&#40;69&#41; Rhône </option>
                            <option value="72">&#40;72&#41; Sarthe </option>
                            <option value="73">&#40;73&#41; Savoie </option>
                            <option value="74">&#40;74&#41; Haute Savoie </option>
                            <option value="75">&#40;75&#41; Paris </option>
                            <option value="76">&#40;76&#41; Seine Maritime </option>
                            <option value="77">&#40;77&#41; Seine et Marne </option>
                            <option value="78">&#40;78&#41; Yvelines </option>
                            <option value="79">&#40;79&#41; Deux Sèvres </option>
                            <option value="82">&#40;82&#41; Tarn et Garonne </option>
                            <option value="83">&#40;83&#41; Var </option>
                            <option value="84">&#40;84&#41; Vaucluse </option>
                            <option value="85">&#40;85&#41; Vendée </option>
                            <option value="86">&#40;86&#41; Vienne </option>
                            <option value="87">&#40;87&#41; Haute Vienne </option>
                            <option value="88">&#40;88&#41; Vosges </option>
                            <option value="973">&#40;973&#41; Guyane </option>
                            <option value="976">&#40;976&#41; Mayotte </option>
                            <option value="89">&#40;89&#41; Yonne </option>
                            <option value="90">&#40;90&#41; Territoire de Belfort </option>
                            <option value="91">&#40;91&#41; Essonne </option>
                            <option value="92">&#40;92&#41; Hauts de Seine </option>
                            <option value="93">&#40;93&#41; Seine Saint Denis </option>
                            <option value="94">&#40;94&#41; Val de Marne </option>
                            <option value="95">&#40;95&#41; Val d'Oise </option>
                            <option value="971">&#40;971&#41; Guadeloupe </option>
                            <option value="972">&#40;972&#41; Martinique </option>
                            <option value="974">&#40;974&#41; Réunion </option>
                            <option value="975">&#40;975&#41; Saint Pierre et Miquelon </option>
                        </select>
                        <input class="search_announce" type="text" placeholder="Rechercher une annonce...">
                        <button class="valid_form" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="category_banner">
                    <ul class="category_list" style="padding-left: 0;">
                        <li id="active"><i class="fas fa-stream"></i> <a href="">Toutes les catégories</a></li>
                        <li>Maison</li>
                        <li>Mode</li>
                        <li>Véhicules</li>
                        <li>Multimédia</li>
                        <li>Loisirs</li>
                        <li>Materiel Professionnel</li>
                        <li>Autres</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">

            <h4 class="mt-3 mb-3" style="font-weight: 400;">Populaires</h4>
            <div class="row">
            <?php while ($an = $popular->fetch()) {
                if($an['publish'] == 1) {
                $phpdate = strtotime($an['date_publication']);
                $an['date_publication'] = date('d/m/Y', $phpdate);
            ?>
                <div class="col-12 col-sm-3 mb-3 announce_card_col">
                    <div class="announce_card">
                        <div class="img_announce_card">
                           <a href="announcement/index.php?id=<?php echo $an['id']; ?>"><img src="uploads/<?php echo $an['miniature']; ?>" alt=""></a> 
                        </div>
                        <div class="title_announce">
                            <a href="announcement/index.php?id=<?php echo $an['id']; ?>"><?php echo $an['name']; ?></a>
                        </div>
                        <div class="infos_announce">
                            <span id="status"><?php echo $an['localisation']; ?></span>
                            <span id="star"><i class="fas fa-star"></i></span>
                        </div>
                        <div class="punlish_infos_cards">
                            <span><?php echo $an['auteur']; ?></span>
                            <span id="date"><?php echo $an['date_publication']; ?></span>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
            <h4 class="mb-3" style="font-weight: 400;">Nouveautés</h4>
            <div class="row mb-4">
            <?php while ($an = $annonce->fetch()) {
                if($an['publish'] == 1) {
                $phpdate = strtotime($an['date_publication']);
                $an['date_publication'] = date('d/m/Y', $phpdate);
            ?>
                <div class="col-12 col-sm-3 mb-3 announce_card_col">
                    <div class="announce_card">
                        <div class="img_announce_card">
                           <a href="announcement/index.php?id=<?php echo $an['id']; ?>"><img src="uploads/<?php echo $an['miniature']; ?>" alt=""></a> 
                        </div>
                        <div class="title_announce">
                            <a href="announcement/index.php?id=<?php echo $an['id']; ?>"><?php echo $an['name']; ?></a>
                        </div>
                        <div class="infos_announce">
                            <span id="status"><?php echo $an['localisation']; ?></span>
                            <span id="star"><i class="fas fa-star"></i></span>
                        </div>
                        <div class="punlish_infos_cards">
                            <span><?php echo $an['auteur']; ?></span>
                            <span id="date"><?php echo $an['date_publication']; ?></span>
                        </div>
                    </div>
                </div>
            <?php }} ?>
            </div>
        </div>
    </div>
    <?php include 'assets/php/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
