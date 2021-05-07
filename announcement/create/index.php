<?php
require_once('../../assets/php/core.php');

if (isset($_SESSION['id'])) {
    $requser = $database->prepare("SELECT * FROM users WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if (isset($_POST['send'])) {
        if (!empty($_POST['name']) and !empty($_POST['category']) and !empty($_POST['description']) and !empty($_POST['cgu'])) {
            if (isset($_FILES['miniature']) and !empty($_FILES['miniature']['name'])) {
                        $title = htmlspecialchars($_POST['name']);
                        $category = htmlspecialchars($_POST['category']);
                        $description = htmlspecialchars($_POST['description']);
                        $prenom = $user['prenom'];
                        $id_user = $user['id'];
                        $insert = $database->prepare('INSERT INTO annonces(id_user, auteur, name, category, description) VALUES (?, ?, ?, ?, ?)');
                        $insert->execute(array($id_user, $prenom, $title, $category, $description));
                        $lastid = $database->lastInsertId();
                        /* Miniature */
                        if (exif_imagetype($_FILES['miniature']['tmp_name']) == 2) {
                                $chemin = '../../uploads/' . $lastid . '.jpg';
                                $filename = $lastid . '.jpg';
                                $size = filesize($filename);
                                if ($size < 0) {
                                    move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                                }             
                        } else {
                            $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                        }
                
                        if (exif_imagetype($_FILES['miniature']['tmp_name']) == 3) {
                            $chemin = '../../uploads/' . $lastid . '.png';
                            $filename = $lastid . '.png';
                            move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
                        } else {
                            $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                        }

                        /* Image 1*/
                        if (exif_imagetype($_FILES['image1']['tmp_name']) == 2) {
                            $chemin = '../../uploads/' . $lastid . '_image1.jpg';
                            $image1 = $lastid . '_image1.jpg';
                            move_uploaded_file($_FILES['image1']['tmp_name'], $chemin);
                        } else {
                            $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                        }
                        if (exif_imagetype($_FILES['image1']['tmp_name']) == 3) {
                            $chemin = '../../uploads/' . $lastid . '_image1.png';
                            $image1 = $lastid . '_image1.png';
                            move_uploaded_file($_FILES['image1']['tmp_name'], $chemin);
                        } else {
                            $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                        }

                        /* Image 2*/
                        if (exif_imagetype($_FILES['image2']['tmp_name']) == 2) {
                            $chemin = '../../uploads/' . $lastid . '_image2.jpg';
                            $image2 = $lastid . '_image2.jpg';
                            move_uploaded_file($_FILES['image2']['tmp_name'], $chemin);
                        } else {
                            $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                        }
                        if (exif_imagetype($_FILES['image2']['tmp_name']) == 3) {
                            $chemin = '../../uploads/' . $lastid . '_image2.png';
                            $image2 = $lastid . '_image2.png';
                            move_uploaded_file($_FILES['image2']['tmp_name'], $chemin);
                        } else {
                            $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                        }

                        /* Image 3*/
                        if (exif_imagetype($_FILES['image3']['tmp_name']) == 2) {
                            $chemin = '../../uploads/' . $lastid . '_image3.jpg';
                            $image3 = $lastid . '_image3.jpg';
                            move_uploaded_file($_FILES['image3']['tmp_name'], $chemin);
                        } else {
                            $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                        }
                        if (exif_imagetype($_FILES['image3']['tmp_name']) == 3) {
                            $chemin = '../../uploads/' . $lastid . '_image3.png';
                            $image3 = $lastid . '_image3.png';
                            move_uploaded_file($_FILES['image3']['tmp_name'], $chemin);
                        } else {
                            $message = '<div class="alert alert-danger">Votre image doit être au format jpg ou png</div>';
                        }

                        $update = $database->prepare('UPDATE annonces SET miniature = ?, image1 = ?, image2 = ?, image3 = ? WHERE id= ?');
                        $update->execute(array($filename, $image1, $image2, $image3, $lastid));
                        $message = "<div class='alert alert-success'>Annonce publiée avec succès!</div>";
            } else {
                $message = '<div class="alert alert-danger" role="alert">
            Veuillez choisir une image de présentation !
          </div>';
            }
        } else {
            $message = '<div class="alert alert-danger" role="alert">
            Veuillez remplir tous les champs !
          </div>';
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='../../assets/css/style.css' rel="stylesheet" type="text/css"  media="screen" />
        <script src="https://kit.fontawesome.com/7a293f3dad.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title><?php echo htmlentities($name['nom_site']); ?></title>
    </head>

    <body>

        <div class="main">
            <div class="header_content">
                <nav class="navbar navbar-dark bg-dark pt-3 pb-3" style="padding-left: 100px; padding-right: 100px;">
                    <a href="../../" class="navbar-brand"><?php echo htmlentities($name['nom_site']); ?></a>
                    <div class="form-inline login_post_buttons">
                        <div class="register_login">
                            <?php if (!isset($_SESSION['email'])) { ?>
                                <a href="account/login" id="login">Connexion</a><span> / </span><a id="register" href="account/register">Incription</a>
                            <?php } else { ?>
                                <a href="../../account" id="login"><?php echo $user['prenom']; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="container mt-3 mb-3">
                <div class="announce_content">
                    <div class="row">
                        <div class="col-12 col-sm-8 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    if (isset($message)) {
                                        echo $message;
                                    }
                                    ?>
                                    <h5 class="card-title">Créer une annonce</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Détails de votre annonce</h6>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image de présentation</label>
                                            <div class="input-group mb-3">
                                                <input type="file" name="miniature" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Catégories</label>
                                            <select name="category" class="form-control" id="exampleFormControlSelect1">
                                                <option value="Maison">Maison</option>
                                                <option value="Mode">Mode</option>
                                                <option value="Véhicules">Véhicules</option>
                                                <option value="Multimédia">Multimédia</option>
                                                <option value="Loisirs">Loisirs</option>
                                                <option value="Matériel Professionnel">Matériel Professionnel</option>
                                                <option value="Autres">Autres</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom</label>
                                            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">Il s'agit du nom de votre donation (objet, vêtement, alimentation...)</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Images</label>
                                            <div class="row" style="margin-bottom: -20px;">
                                                <div class="col">
                                                    <div class="form-group inputDnD">
                                                        <label class="sr-only" for="inputFile">Envoyer un fichier</label>
                                                        <input type="file" name="image1" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Sélectionner une image">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group inputDnD">
                                                        <label class="sr-only" for="inputFile">Envoyer un fichier</label>
                                                        <input type="file" name="image2" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Sélectionner une image">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group inputDnD">
                                                        <label class="sr-only" for="inputFile">Envoyer un fichier</label>
                                                        <input type="file" name="image3" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Sélectionner une image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-check">
                                            <input name="cgu" type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">J'accepte les conditions générales d'utilisations concernant la publication de mon annonce.</label>
                                        </div>
                                        <button type="submit" name="send" class="btn btn-primary">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Règles</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Veuillez vérifier avant la publication, que vous respectez ces conditions.</h6>
                                    <ul class="rules_check_list">
                                        <li><i class="fas fa-check check"></i> Vous avez renseigné vos informations de contacts et de localisation dans les paramètres de votre profil.</li>
                                        <li><i class="fas fa-check check"></i> Vous avez sélectionné la bonne catégorie.</li>
                                        <li><i class="fas fa-check check"></i> La donation est dans un état correct</li>
                                        <li><i class="fas fa-check check"></i> Vous disposez d'images de la donation</li>
                                    </ul>
                                </div>
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
        <script>
            function readUrl(input) {

                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        let imgData = e.target.result;
                        let imgName = input.files[0].name;
                        input.setAttribute("data-title", imgName);
                        console.log(e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }

            }
        </script>
    </body>

    </html>
<?php
} else {
    header('Location: ../../account/login');
}
?>