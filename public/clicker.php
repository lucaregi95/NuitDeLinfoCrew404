<?php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Menu Circulaire 4 Boutons Alignés</title>

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
            width: 500px;
            height: 400px;
        }

        .center-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            padding: 10px 25px;
            white-space: nowrap;
        }

        .item-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: 0.6s ease;
        }

        /* Position des boutons */
        .show .item-top { transform: translate(-50%, -50%) translate(0, -160px); opacity: 1; }
        .show .item-right { transform: translate(-50%, -50%) translate(220px, 0); opacity: 1; }
        .show .item-bottom { transform: translate(-50%, -50%) translate(0, 160px); opacity: 1; }
        .show .item-left { transform: translate(-50%, -50%) translate(-220px, 0); opacity: 1; }

        .item-btn button {
            min-width: 120px;
            text-align: center;
            padding: 10px 14px;
            font-size: 15px;
            transition: transform 0.2s;
        }

        .item-btn button:hover {
            transform: scale(1.15);
        }

        .floating-card {
            position: absolute;
            width: 220px;
            opacity: 0;
            transform: scale(0.9);
            transition: 0.25s ease;
            pointer-events: none;
        }

        .floating-card.show {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>

<body>

<div class="circle-menu" id="menu">

    <button class="btn btn-primary btn-lg center-btn" onclick="toggleMenu()">Appuie-moi dessus !</button>

    <!-- Boutons -->
    <div class="item-btn item-top"><button id="btn-top" onclick="toggleButton('top')" class="btn btn-outline-primary">Exécuter</button></div>
    <div class="item-btn item-right"><button id="btn-right" onclick="toggleButton('right')" class="btn btn-outline-primary">Copier</button></div>
    <div class="item-btn item-bottom"><button id="btn-bottom" onclick="toggleButton('bottom')" class="btn btn-outline-primary">Modifier</button></div>
    <div class="item-btn item-left"><button id="btn-left" onclick="toggleButton('left')" class="btn btn-outline-primary">Distribuer</button></div>

    <!-- Cartes -->
    <div id="card-top" class="floating-card card shadow">
        <div class="p-2"><strong>Exécuter</strong><br>Utiliser un logiciel sans restriction commerciale, abonnement ou traçage</div>
    </div>

    <div id="card-right" class="floating-card card shadow">
        <div class="p-2"><strong>Copier</strong><br>Dupliquer et redistribuer les logiciels gratuitement,<br>cela permet d'equiper les familles et les ecoles</div>
    </div>

    <div id="card-bottom" class="floating-card card shadow">
        <div class="p-2"><strong>Modifier</strong><br>Adapter les logiciels aux besoins (PrimTux customisé par cycle, Linux NIRD par établissement) et ne pas dépendre des fournisseurs propriétaires</div>
    </div>

    <div id="card-left" class="floating-card card shadow">
        <div class="p-2"><strong>Distribuer</strong><br>Partager les versions modifiées.<br>Cela permet la solidarité numérique</div>
    </div>

</div>

<script>
    function toggleMenu() {
        document.getElementById("menu").classList.toggle("show");
    }

    const originalText = {
        top: "Exécuter",
        right: "Copier",
        bottom: "Modifier",
        left: "Distribuer"
    };

    let isOpen = {top:false, right:false, bottom:false, left:false};

    function toggleButton(dir) {
        const btn = document.getElementById("btn-" + dir);
        const card = document.getElementById("card-" + dir);

        if (isOpen[dir]) {
            btn.innerText = originalText[dir];
            card.classList.remove("show");
            isOpen[dir] = false;
            return;
        }

        // Fermer les autres cartes
        for (let d of ["top","right","bottom","left"]) {
            if(d!==dir) {
                document.getElementById("btn-"+d).innerText = originalText[d];
                document.getElementById("card-"+d).classList.remove("show");
                isOpen[d] = false;
            }
        }

        btn.innerText = "Ouvert !";
        isOpen[dir] = true;

        // Position carte alignée avec le bouton
        const btnRect = btn.getBoundingClientRect();
        const menuRect = document.getElementById("menu").getBoundingClientRect();

        let left = btnRect.left - menuRect.left;
        let top = btnRect.top - menuRect.top;

        switch(dir) {
            case "top":
                left += btn.offsetWidth/2 - card.offsetWidth/2; // centre horizontal
                top -= card.offsetHeight + 10; // au-dessus du bouton
                break;
            case "right":
                left += btn.offsetWidth + 10; // à droite du bouton
                top += btn.offsetHeight/2 - card.offsetHeight/2; // centre vertical
                break;
            case "bottom":
                left += btn.offsetWidth/2 - card.offsetWidth/2; // centre horizontal
                top += btn.offsetHeight + 10; // en dessous du bouton
                break;
            case "left":
                left -= card.offsetWidth + 10; // à gauche du bouton
                top += btn.offsetHeight/2 - card.offsetHeight/2; // centre vertical
                break;
        }

        card.style.left = left + "px";
        card.style.top  = top + "px";
        card.classList.add("show");
    }
</script>

</body>
</html>
