<?php

$bdd = null;
require_once('../bdd/connexion.php');

$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$email=$_POST["email"];
$mdp=$_POST["mdp"];
$acteur=$_POST["acteur"];


$sql2= "INSERT INTO inscrit(nom,prenom,mdp,email,ref_acteur) VALUES (:nom,:prenom,:mdp,:email,:ref_acteur)";
$query = $bdd->prepare($sql2);
$query->execute(array(
        "nom"=>$nom,
        "prenom"=>$prenom,
        "email"=>$email,
        "mdp"=>$mdp,
    "ref_acteur"=>$acteur
));
$result = $query->fetchAll();

?>

<!DOCTYPE html>

<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Validé !</title>
</head>

<body>
<h2>Inscription réussie !</h2>
<form method="POST" action="../public/connexion2.php">
    <input type="hidden" name="prenom" value="<?=$prenom?>">
    <input type="hidden" name="nom" value="<?=$nom?>">
    <input type="hidden" name="mdp" value="<?=$mdp?>">
    <input type="hidden" name="email" value="<?=$email?>">
    <button type="submit">Connectez-Vous !</button>
</form>
