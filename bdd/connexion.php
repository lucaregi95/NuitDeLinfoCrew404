<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=nird", "lregi", "lucaregi");
}catch (PDOException $e){
    echo "Erreur : ".$e->getMessage();
}?>
