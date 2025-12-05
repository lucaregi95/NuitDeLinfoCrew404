<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu de mots cachés interactif</title> //j
    <style>
        :root {
            --pastel-yellow: #fff9e6;
            --pastel-purple: #f3ebff;
            --accent-yellow: #ffd966;
            --accent-purple: #c4a3e8;
            --deep-purple: #7c5ba6;
        }

        body {
            font-family: monospace;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            background: var(--pastel-yellow);
            min-height: 100vh;
        }

        h1 {
            color: var(--deep-purple);
        }

        table {
            border-collapse: collapse;
            user-select: none;
            background-color: white;
            box-shadow: 0 4px 6px rgba(124, 91, 166, 0.1);
        }

        td {
            width: 30px;
            height: 30px;
            text-align: center;
            border: 1px solid var(--accent-purple);
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.2s;
            color: var(--deep-purple);
        }

        td.selected {
            background-color: var(--accent-yellow);
        }

        td.found {
            background-color: var(--accent-purple);
            color: white;
        }

        #mots {
            margin-top: 20px;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(124, 91, 166, 0.1);
        }

        #mots span {
            color: var(--deep-purple);
            font-weight: bold;
        }

        #mots span.found {
            text-decoration: line-through;
            color: var(--accent-purple);
        }

        button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(124, 91, 166, 0.2);
        }

        #precedent {
            background-color: var(--accent-purple);
            color: white;
        }

        #recommencer {
            background-color: var(--deep-purple);
            color: white;
        }
    </style>
</head>
<body>

<h1>--- Trouvez les mots cachés ! ---</h1>
<table id="grille"></table>
<div id="mots"></div>

<div>
<form method="post" action="../../../public/pages/Mini-jeux.html">
    <button id="precedent" type="submit">Précédent</button>
    <button id="recommencer">Recommencer</button>
</form>
</div>

<script>
    const mots = ["SOBRIÉTÉ", "NUMÉRIQUE", "RÉEMPLOI", "LINUX", "NIRD", "DURABLE", "RESPONSABLE", "GRATUIT"];
    const taille = 15;
    let grille = [];
    let startCell = null;
    let selecting = false;
    let lastSelection = [];

    function initGrille() {
        grille = Array.from({ length: taille }, () => Array(taille).fill(' '));
        mots.forEach(m => placerMot(grille, m));
        remplirGrille(grille);
        afficherGrille();
        afficherMots();
    }

    function peutPlacer(grille, mot, x, y, a, b) {
        for (let i = 0; i < mot.length; i++) {
            const mb = x + a * i;
            const mc = y + b * i;
            if (mb < 0 || mb >= taille || mc < 0 || mc >= taille) return false;
            if (grille[mb][mc] !== ' ' && grille[mb][mc] !== mot[i]) return false;
        }
        return true;
    }

    function placerMot(grille, mot) {
        const directions = [[1,0],[0,1],[1,1],[-1,1]];
        while (true) {
            const x = Math.floor(Math.random() * taille);
            const y = Math.floor(Math.random() * taille);
            const d = directions[Math.floor(Math.random() * directions.length)];
            if (peutPlacer(grille, mot, x, y, d[0], d[1])) {
                for (let i = 0; i < mot.length; i++) {
                    grille[x + d[0]*i][y + d[1]*i] = mot[i];
                }
                break;
            }
        }
    }

    function remplirGrille(grille) {
        for (let i = 0; i < taille; i++) {
            for (let j = 0; j < taille; j++) {
                if (grille[i][j] === ' ') {
                    grille[i][j] = String.fromCharCode(65 + Math.floor(Math.random()*26));
                }
            }
        }
    }

    function afficherGrille() {
        const table = document.getElementById("grille");
        table.innerHTML = "";
        for (let i = 0; i < taille; i++) {
            const tr = document.createElement("tr");
            for (let j = 0; j < taille; j++) {
                const td = document.createElement("td");
                td.textContent = grille[i][j];
                td.dataset.row = i;
                td.dataset.col = j;

                td.addEventListener('mousedown', e => {
                    selecting = true;
                    startCell = td;
                    td.classList.add('selected');
                });

                td.addEventListener('mouseenter', e => {
                    if (selecting && td !== startCell) {
                        clearSelection();
                        selectCells(startCell, td);
                    }
                });

                td.addEventListener('mouseup', e => {
                    if (selecting) {
                        selecting = false;
                        lastSelection = Array.from(document.querySelectorAll('td.selected'));
                        checkSelection();
                        clearSelection();
                    }
                });

                tr.appendChild(td);
            }
            table.appendChild(tr);
        }
    }

    function afficherMots() {
        const div = document.getElementById("mots");
        div.innerHTML = mots.map(m => `<span>${m}</span>`).join(', ');
    }

    function clearSelection() {
        document.querySelectorAll('td.selected').forEach(td => td.classList.remove('selected'));
    }

    function selectCells(start, end) {
        const r1 = parseInt(start.dataset.row);
        const c1 = parseInt(start.dataset.col);
        const r2 = parseInt(end.dataset.row);
        const c2 = parseInt(end.dataset.col);

        const dr = Math.sign(r2 - r1);
        const dc = Math.sign(c2 - c1);
        const len = Math.max(Math.abs(r2 - r1), Math.abs(c2 - c1));

        for (let i = 0; i <= len; i++) {
            const r = r1 + dr*i;
            const c = c1 + dc*i;
            const td = document.querySelector(`td[data-row='${r}'][data-col='${c}']`);
            if (td) td.classList.add('selected');
        }
    }

    function checkSelection() {
        const selectedCells = Array.from(document.querySelectorAll('td.selected'));
        const word = selectedCells.map(td => td.textContent).join('');
        const reverseWord = word.split('').reverse().join('');

        const motsSpans = document.querySelectorAll('#mots span');

        for (let mot of mots) {
            if (word === mot || reverseWord === mot) {
                selectedCells.forEach(td => td.classList.add('found'));
                motsSpans.forEach(span => {
                    if (span.textContent === mot) span.classList.add('found');
                });
                break;
            }
        }
    }

    // Boutons
    document.getElementById('recommencer').addEventListener('click', initGrille);

    document.getElementById('precedent').addEventListener('click', () => {
        clearSelection();
        lastSelection.forEach(td => td.classList.add('selected'));
        setTimeout(clearSelection, 500);
    });

    // Initialisation
    initGrille();
    document.body.addEventListener('mouseup', () => { selecting = false; clearSelection(); });
</script>
</body>
</html>