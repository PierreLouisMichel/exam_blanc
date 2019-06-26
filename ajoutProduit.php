<?php require 'database.php'; ?>


<!doctype html>
<html lang="en">

<head>
    <title>Ajout Produit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <a href='ListeProduit.php'>liste des Produit</a>
    <div class='form col-12'>
        <fieldset>
            <form action="ajoutProduit.php" method="$_GET" enctype="multipart/form-data">
                <input type='text' placeholder='Titre' name='titre'><br/>
                <input type='text' placeholder='Adresse' name='adr'><br/>
                <input type='text' placeholder='Ville' name='ville'><br/>
                <input type='text' placeholder='Code Postal' name='cp'><br/>
                <input type='int' placeholder='Prix' name='prix'><br/>
                <input type="file" name="photo"><br/>
                <input type='text' placeholder='Type' name='type'><br/>
                <input type='text' placeholder='Description' name='desc'><br/>
                <input type="submit" value="Ajouter" name="valid">
            </form>
        </fieldset>
    </div>
    <?php


    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur

    if (isset($_FILES['photo']) and $_FILES['photo']['error'] == 0) {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['photo']['size'] <= 1000000) {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees)) {
                //  On peut valider le fichier et le stocker définitivement
                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($_FILES['photo']['name']));
                echo "L'envoi a bien été effectué !";
            }
        }
    }


    if (isset($_GET['valid'])) 
    {
        $request = "INSERT INTO produit (titre, adresse_vendeur, ville_vendeur, cp_vendeur, prix, photo, type, description) 
                    VALUES ('$_GET[titre]','$_GET[adr]','$_GET[ville]','$_GET[cp]','$_GET[prix]', '$_GET[photo]', '$_GET[type]', '$_GET[desc]')";
        $bdd->query($request);
        echo "ajout éffectué";
    }

    ?>

    <!--Optional JavaScript -->
    <!--jQuery first, then Po p per.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous ">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
