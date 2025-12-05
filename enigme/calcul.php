<?php

// --- Fonction pour comparer les nombres décimaux de manière fiable ---
function compareNombre($a, $b) {
    return abs((float)$a - (float)$b) < 0.0001;
}

// --- Résultats des calculs ---
$resultat1 = 7 + 7 - 7 * 7 / 7;
$resultat2 = ((20 + 5) * 3 - 12) / 4 + pow(6, 2); // Nouveau calcul

// --- Lecture des réponses utilisateur (si envoyées) ---
$rep1 = isset($_POST["rep1"]) ? str_replace(",", ".", $_POST["rep1"]) : null;
$rep2 = isset($_POST["rep2"]) ? str_replace(",", ".", $_POST["rep2"]) : null;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calculs</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2c2f33;
            color: #f8f9fa;
        }
        .card {
            background-color: #f5f5f5;
            color: #2c2f33;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #1abc9c;
            border-color: #1abc9c;
        }
        .btn-primary:hover {
            background-color: #16a085;
            border-color: #16a085;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">

                <?php if ($rep1 === null) : ?>

                    <form method="post">
                        <h3 class="text-center mb-3">Calcule :</h3>
                        <p class="text-center">7 + 7 - 7 * 7 / 7 = ?</p>
                        <input type="text" name="rep1" class="form-control mb-3" required>
                        <button type="submit" class="btn btn-primary w-50 d-block mx-auto">Valider</button>
                    </form>

                <?php elseif (!compareNombre($rep1, $resultat1)) : ?>

                    <div class="alert alert-danger text-center">Mauvaise réponse ! Essaie encore.</div>

                    <form method="post">
                        <h3 class="text-center mb-3">Calcule :</h3>
                        <p class="text-center">7 + 7 - 7 * 7 / 7 = ?</p>
                        <input type="text" name="rep1" class="form-control mb-3" required>
                        <button type="submit" class="btn btn-primary w-50 d-block mx-auto">Valider</button>
                    </form>

                <?php elseif ($rep2 === null) : ?>

                    <div class="alert alert-success text-center">Bravo ! Correct.</div>

                    <form method="post">
                        <h3 class="text-center mb-3">Très bien ! Maintenant un calcul un peu plus complexe :</h3>
                        <p class="text-center">((20 + 5) × 3 - 12) ÷ 4 + 6² = ?</p>
                        <input type="hidden" name="rep1" value="<?= htmlspecialchars($rep1) ?>">
                        <input type="text" name="rep2" class="form-control mb-3" required>
                        <button type="submit" class="btn btn-primary w-50 d-block mx-auto">Valider</button>
                    </form>

                <?php elseif (!compareNombre($rep2, $resultat2)) : ?>

                    <div class="alert alert-danger text-center">Mauvaise réponse ! Essaie encore.</div>

                    <form method="post">
                        <p class="text-center">((20 + 5) × 3 - 12) ÷ 4 + 6² = ?</p>
                        <input type="hidden" name="rep1" value="<?= htmlspecialchars($rep1) ?>">
                        <input type="text" name="rep2" class="form-control mb-3" required>
                        <button type="submit" class="btn btn-primary w-50 d-block mx-auto">Valider</button>
                    </form>

                <?php else : ?>

                    <div class="alert alert-success text-center">
                        Excellent ! Tu as réussi les deux calculs !<br>
                        Ton adresse email n'a pas été vérifiée ! Bonne continuation :)
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>