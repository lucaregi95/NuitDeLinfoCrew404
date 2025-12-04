<?php
try {
    $bdd = new PDO("mysql:host=isp.seblemoine.fr:3306;dbname=bdd_nird_crew404", "bdd_nird_crew404", "tkGPdd9Y_");
}catch (PDOException $e){
    echo "Erreur : ".$e->getMessage();
}?>
