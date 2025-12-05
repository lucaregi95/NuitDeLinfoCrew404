<?php
$bdd = null;
require_once('../src/bdd/connexion.php');



$sql2 = "SELECT * FROM acteurs";


$query2 = $bdd->query($sql2);
$query2->execute();
$result2 = $query2->fetchAll();?>

<!DOCTYPE html>

<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Inscription au site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Inscription</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="connexion2.php">Connexion</a></li>

            </ul>
        </div>
    </div>


</nav>
<div class="container mt-3 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-dark"><i class="bi bi-book-fill text-success"></i>NIRD</h1>
    </div>

    <div class="card border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
<form method="POST" action="../traitement/inscription.php" class="container mt-3">
    <label for="nom">Nom :</label><br>
    <input type="text" id="nom" name="nom" required><br><br>

    <label for="prenom">Prenom :</label><br>
    <input type="text" id="prenom" name="prenom" required><br><br>

    <label for="mdp">Mot de Passe :</label><br>
    <input type="password" id="mdp" name="mdp" required><br><br>

    <label for="email">Adresse E-mail :</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label>Type d'acteur :<br>
            <select name="acteur" id="acteur">
                <?php foreach($result2 as $acteur){
                            ?><option name="acteur" value="<?=$acteur['id_acteur'];?>"><?=$acteur['nom_acteur'] ?></option>
                <?php } ?>
            </select>
    </label><br><br>

    <button type="submit" class="btn btn-primary">Valider</button><br><br>
</form>
                <div class="mb-3">
<a href="connexion2.php" class="container">Deja inscrit ? Connectez-vous</a>
                    </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>