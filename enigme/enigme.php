<?php
// Bonne réponse attendue
$bonneReponse = [
        "le numérique inclusif responsable et durable",
        "numérique inclusif responsable et durable",
        "numerique inclusif responsable et durable",
        "nird",
        "projet nird",
        "outil nird"
];

// Lecture de la réponse
$reponse = isset($_POST["reponse"]) ? strtolower(trim($_POST["reponse"])) : null;

// Lecture du compteur d'erreurs
$erreurs = isset($_POST["erreurs"]) ? (int)$_POST["erreurs"] : 0;

// Vérification
$isCorrect = $reponse !== null && in_array($reponse, $bonneReponse);

// Si la réponse est incorrecte, on incrémente le compteur
if ($reponse !== null && !$isCorrect) {
    $erreurs++;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Énigme NIRD</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2c2f33; /* fond sombre global */
            color: #f8f9fa; /* texte clair */
        }
        .card {
            background-color: #f5f5f5; /* carte lumineuse */
            color: #2c2f33; /* texte sombre pour contraste */
            border-radius: 20px; /* arrondis prononcés */
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4); /* ombre subtile pour relief */
        }
        .indice {
            display: none;
            margin-top: 10px;
        }
        .btn-link {
            color: #1abc9c;
        }
        input.form-control {
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
        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
        }
        .btn-success:hover {
            background-color: #1e8449;
            border-color: #1e8449;
        }
        .alert-info {
            background-color: #d1ecf1; /* indice lumineux */
            color: #0c5460;
            border: none;
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
                <h2 class="card-title text-center mb-4">Résous cette énigme :</h2>
                <p class="card-text text-center">
                    Je rends les sites accessibles à tous,<br>
                    je réduis l’énergie dépensée par les flux,<br>
                    je protège les données sans les céder au plus offrant.<br>
                    <strong>Qui suis-je ?</strong>
                </p>

                <form method="post" class="d-flex flex-column align-items-center">
                    <?php if (!$isCorrect): ?>
                        <input type="text" name="reponse" required placeholder="Ta réponse ici" class="form-control mb-3">
                        <input type="hidden" name="erreurs" value="<?= $erreurs ?>">
                        <button type="submit" class="btn btn-primary w-50">Valider</button>
                    <?php endif; ?>
                </form>

                <?php if ($reponse !== null): ?>
                    <?php if ($isCorrect): ?>
                        <div class="alert alert-success mt-4 text-center" role="alert">
                            ✔ Bravo ! La bonne réponse est bien : <strong>Numérique inclusif, responsable et durable (NIRD)</strong>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-success" onclick="window.location.href='calcul.php'">Passer à la page suivante</button>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger mt-4 text-center" role="alert">
                            ✖ Mauvaise réponse… essaie encore !
                        </div>

                        <div class="d-flex flex-column align-items-start mt-2">
                            <!-- Indice 1 toujours disponible -->
                            <button class="btn btn-link p-0 mb-2" onclick="toggleIndice('indice1')">Afficher l'indice 1</button>
                            <div id="indice1" class="indice alert alert-info w-100">
                                J'aide les personnes en situation de handicap à utiliser le service.
                            </div>

                            <!-- Indice 2 disponible seulement après 3 erreurs -->
                            <?php if ($erreurs >= 3): ?>
                                <button class="btn btn-link p-0 mb-2" onclick="toggleIndice('indice2')">Afficher l'indice 2</button>
                                <div id="indice2" class="indice alert alert-info w-100">
                                    Je pense à l’empreinte carbone, à la vie privée et à l’équité d’accès.
                                </div>
                            <?php endif; ?>
                        </div>

                        <p class="mt-3 text-center"><strong>Nombre d'erreurs :</strong> <?= $erreurs ?></p>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleIndice(id) {
        const element = document.getElementById(id);
        if (element.style.display === "none" || element.style.display === "") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>
</body>
</html>
