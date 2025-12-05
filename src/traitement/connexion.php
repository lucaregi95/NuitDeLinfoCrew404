<?php
$bdd = null;
require_once('../bdd/connexion.php');


$email=$_POST["email"];
$mdp=$_POST["mdp"];

$sql2= "SELECT nom,prenom,mdp,email FROM inscrit WHERE email=:email AND mdp=:mdp";
$query = $bdd->prepare($sql2);

$query->execute(array(
        "email"=>$email,
        "mdp"=>$mdp
));
$result = $query->fetch();

if ($result==false) {
    header("Location: ../public/connexion2.php?erreur=unknown");
}
else{

    session_start();
    $_SESSION['id']=$result["id"];
    $_SESSION['nom'] = $result["nom"];
    $_SESSION['prenom'] = $result["prenom"];
    $_SESSION['email'] = $result["email"];
    header('location:../public/pages/home.html');
    ?>
<!DOCTYPE html>

<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Connexion en Cours</title>
</head>
<body>
</body>
    </html>
<?php } ?>


