<?php
$bdd = null;
require_once('../bdd/connexion.php');

$nom=null;
$prenom=null;
$email=null;
if(isset($_POST['email'])){
    $email=$_POST['email'];
}
$erreur=null;
$inscription=null;
if(isset($_GET['erreur'])){
    if ($_GET['erreur']=='unknown'){
        $erreur="Identifiants inexistants ou incorrects";
        $inscription="Pas de compte ? Inscrivez-vous";
    }

}


?>

<!DOCTYPE html>

<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Connectez-vous</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>

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
<form class="container mt-3" method="POST" action="../traitement/connexion.php">
    <label for="email">Adresse e-mail :</label><br>
    <input type="email" id="email" name="email" value="<?=$email?>" required><br><br>

    <label for="mdp">Mot de Passe :</label><br>
    <input type="password" id="mdp" name="mdp" required><br>

    <h6 class="text-danger pt-3 pb-3"><?=$erreur?></h6>

    <button type="submit" class="btn btn-primary">Connectez-vous !</button><br><br>
</form>
                <div class="mb-3">
<a class="container" href="inscription.php"><?=$inscription?></a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
