<?php
// Vous pouvez ajouter du code PHP ici si nécessaire.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Menu Circulaire Animé</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f5f5;
        }

        .circle-menu {
            position: relative;
            width: 200px;
            height: 200px;
        }

        .center-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .item-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: 0.5s ease;
        }

        /* Positions finales des 6 boutons autour */
        .show .item1 { transform: translate(-50%, -50%) translate(0, -80px); opacity: 1; }
        .show .item2 { transform: translate(-50%, -50%) translate(70px, -40px); opacity: 1; }
        .show .item3 { transform: translate(-50%, -50%) translate(70px, 40px); opacity: 1; }
        .show .item4 { transform: translate(-50%, -50%) translate(0, 80px); opacity: 1; }
        .show .item5 { transform: translate(-50%, -50%) translate(-70px, 40px); opacity: 1; }
        .show .item6 { transform: translate(-50%, -50%) translate(-70px, -40px); opacity: 1; }

        .item-btn button {
            transition: transform .3s;
        }
        .item-btn button:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>

<div class="circle-menu" id="menu">
    <button class="btn btn-primary btn-lg center-btn" onclick="toggleMenu()">
        Appuie-moi dessus !
    </button>

    <!-- 6 boutons autour -->
    <div class="item-btn item1"><button class="btn btn-outline-primary">1</button></div>
    <div class="item-btn item2"><button class="btn btn-outline-primary">2</button></div>
    <div class="item-btn item3"><button class="btn btn-outline-primary">3</button></div>
    <div class="item-btn item4"><button class="btn btn-outline-primary">4</button></div>
    <div class="item-btn item5"><button class="btn btn-outline-primary">5</button></div>
    <div class="item-btn item6"><button class="btn btn-outline-primary">6</button></div>
</div>

<script>
    function toggleMenu() {
        document.getElementById("menu").classList.toggle("show");
    }
</script>

</body>
</html>