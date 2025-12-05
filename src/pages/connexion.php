<?php
try {
    $bdd = new PDO("mysql:host=isp.seblemoine.fr:3306;dbname=bdd_nird_crew404", "bdd_nird_crew404", "tkGPdd9Y_");
}catch (PDOException $e){
    echo "Erreur : ".$e->getMessage();
}?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - VotreMarque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/connexion.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">VotreMarque</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.html">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="main-container">
        <div class="login-card">
            <!-- Login Header -->
            <div class="login-header">
                <div class="brand-icon">
                    <i class="bi bi-book-fill"></i>
                </div>
                <h1>NIRD</h1>
                <p>Connectez-vous à votre compte</p>
            </div>

            <!-- Login Body -->
            <div class="login-body">
                <?php if($erreur): ?>
                <div class="alert-custom">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong><?=$erreur?></strong>
                </div>
                <?php endif; ?>

                <form method="POST" action="../traitement/connexion.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope me-1"></i> Adresse e-mail
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="<?=$email?>" 
                                   placeholder="votre@email.com"
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="mdp" class="form-label">
                            <i class="bi bi-lock me-1"></i> Mot de passe
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" 
                                   class="form-control" 
                                   id="mdp" 
                                   name="mdp" 
                                   placeholder="••••••••"
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Se connecter
                    </button>
                </form>

                <?php if($inscription): ?>
                <div class="signup-link">
                    <p class="mb-0" style="color: #666;">
                        <?=$inscription?> 
                        <a href="inscription.php">
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>