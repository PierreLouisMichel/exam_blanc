<?php
$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8;port=3306', 'root', '');
$request = 'SELECT * FROM patients';
$response = $bdd->query($request);
$posts = $response->fetchAll(PDO::FETCH_ASSOC);
/*$request = 'INSERT INTO patients(lastname, firstname, birthdate, phone, mail)
                VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
    $response = $bdd->prepare($request);
    $response->execute([
        'lastname'  => $_POST['lastname'],
        'firstname' => $_POST['firstname'],
        'birthdate' => $_POST['birthdate'],
        'phone'     => $_POST['phone'],
        'mail'      => $_POST['mail']
    ]);*/
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">

                <form action='ajout_rdv.php' method='POST' class='form'>
                    <div class='form-group'>
                        <label for=''>Patient</label>
                        <select name='idPatient'>
                            <?php foreach ($posts as $patient) {
                                echo "
                            <option value=" . $patient['id'] . ">
                            " . $patient['firstname'] . " " . $patient['lastname'] . "
                            </option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date et Horaire</label>
                        <input name="dateH" type="date" class="form-control">
                    </div>

                    <button class="btn btn-success float-right">Ajouter le rdv</button>
                </form>

            </div>
        </div>
    </div>
    <?php
    if (!empty($_POST)) 
    {
    $request = 'INSERT INTO appointments(idPatients, dateHour) VALUES (:idPatient, :dateH)';
    $response = $bdd->prepare($request);
    $response->execute([
        ':idPatient'  => $_POST['idPatient'],
        ':dateH' => $_POST['dateH']
    ]);
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>