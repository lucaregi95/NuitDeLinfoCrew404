<?php
header('Content-Type: application/json; charset=utf-8');

if(isset($_POST['score'])) {
    $score = intval($_POST['score']);

    // Stockage
    file_put_contents("scores.txt", $score . PHP_EOL, FILE_APPEND);

    // Préparer redirection (conserve ton chemin)
    $redirect = $score > 10 ? "../enigme/enigme.php" : "";

    echo json_encode([
        "score" => $score,
        "redirect" => $redirect
    ]);
    exit;
}

echo json_encode(["error" => "score manquant"]);
?>
