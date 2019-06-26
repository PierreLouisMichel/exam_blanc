<?php

require 'database.php'; // Connexion à la bdd

$request = "SELECT * FROM patients WHERE id='$_GET[id]'";
$response = $bdd->query($request);
$posts = $response->fetchAll(PDO::FETCH_ASSOC);
var_dump($posts);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Project: Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/blog.css">

</head>

<body>
    <a href="listepatient.php">retour</a>
    <?php foreach ($posts as $post) :

        echo "
                <div class='container'>
                    <div class='row mt-3'>
                        <div class='col-12'>
                        numéro de patient: " . $post['id'] . "<br/> 
                        Nom : " . $post['lastname'] . "<br/> 
                        Prenom: " . $post['firstname'] . "<br/> 
                        date de naissance: " . $post['birthdate'] . "<br/> 
                        numéro de téléphone: " . $post['phone'] . "<br/> 
                        adresse mail: " . $post['mail'] . "<br/> 
                        </div>
                    </div>
                </div>
                ";
        var_dump($post['id']);
        echo "
        <div class='form col-12'>
        <fieldset>
            <form action='profilpatient.php?id=" . $post['id'] . " method='post'>
                <input type='hidden' name='id' value='" . $post['id'] . "'>
                <input type='text' placeholder='" . $post['firstname'] . "' name='prenom'><br/>
                <input type='text' placeholder='" . $post['lastname'] . "' name='nom'><br/>
                <input type='text' placeholder='" . $post['birthdate'] . "' name='date'><br/>
                <input type='phone' placeholder='" . $post['phone'] . "' name='phone'><br/>
                <input type='mail' placeholder='" . $post['mail'] . "' name='mail'><br/>
                <input type='submit' value='Modifier' name='valid'>
            </form>
        </fieldset>
        </div>
        ";

    endforeach; ?>

    <?php

    if (isset($_GET['valid'])) {
        $request = "UPDATE patients SET firstname='$_GET[prenom]', lastname='$_GET[nom]', birthdate='$_GET[date]', phone='$_GET[phone]', mail='$_GET[mail]' WHERE id='$_GET[id]'";
        $bdd->query($request);
        $select = "SELECT * FROM patients WHERE id='$_GET[id]'";
        $bdd->query($select);
        $posts = $response->fetchAll(PDO::FETCH_ASSOC);
    }

    ?>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>