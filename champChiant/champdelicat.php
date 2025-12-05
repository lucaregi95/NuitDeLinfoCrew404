<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Age Selection Animée</title>
    <style>
        :root {
            --pastel-yellow: #fff9e6;
            --pastel-purple: #f3ebff;
            --accent-yellow: #ffd966;
            --accent-purple: #c4a3e8;
            --deep-purple: #7c5ba6;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            position: relative;
            height: 100vh;
            overflow: hidden;
            background: var(--pastel-yellow);
            margin: 0;
        }

        select {
            font-size: 16px;
            position: absolute;
            transition: top 0.5s ease, left 0.5s ease, transform 0.5s ease, color 0.5s ease;
            background-color: white;
            border: 2px solid var(--accent-purple);
            border-radius: 8px;
            padding: 8px 12px;
            color: var(--deep-purple);
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(124, 91, 166, 0.1);
        }

        select:hover {
            transform: rotate(10deg) scale(1.05);
            color: var(--accent-purple);
            border-color: var(--deep-purple);
        }

        .flipped {
            transform: rotate(180deg);
            display: block;
        }

        #validate-btn {
            background-color: var(--deep-purple);
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            position: absolute;
            transition: top 0.5s ease, left 0.5s ease, transform 0.3s, background-color 0.3s;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(124, 91, 166, 0.2);
        }

        #validate-btn:hover {
            background-color: var(--accent-purple);
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<select id="age-select" name="nombre">
    <option disabled selected>-- Choisissez votre âge --</option>
</select>
//x
<a href="../snake/snake.html" id="validate-btn">Valider</a>

<script>
    const select = document.getElementById('age-select');
    const button = document.getElementById('validate-btn');

    // Générer et mélanger les nombres
    const numbers = Array.from({length: 100}, (_, i) => i + 1);
    for (let i = numbers.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [numbers[i], numbers[j]] = [numbers[j], numbers[i]];
    }

    // mettre desoptions
    numbers.forEach(n => {
        const option = document.createElement('option');
        option.value = n;
        option.textContent = n;
        select.appendChild(option);
    });

    // Fonction pour inverser aléatoirement certaines options
    function flipOptions() {
        const options = select.querySelectorAll('option');
        options.forEach(option => {
            if (Math.random() < 0.5) { // 50% de chance
                option.classList.toggle('flipped');
            }
        });
    }

    // Fonction pour déplacer le select et le bouton
    function moveSelectRandomly() {
        const bodyWidth = window.innerWidth;
        const bodyHeight = window.innerHeight;
        const selectWidth = select.offsetWidth;
        const selectHeight = select.offsetHeight;
        const btnWidth = button.offsetWidth;
        const btnHeight = button.offsetHeight;

        const randomLeft = Math.random() * (bodyWidth - Math.max(selectWidth, btnWidth));
        const randomTop = Math.random() * (bodyHeight - Math.max(selectHeight, btnHeight));

        select.style.left = randomLeft + 'px';
        select.style.top = randomTop + 'px';

        // Déplacer le bouton juste en dessous du select
        button.style.left = randomLeft + 'px';
        button.style.top = (randomTop + selectHeight + 10) + 'px';
    }

    window.addEventListener('load', () => {
        flipOptions();
        moveSelectRandomly(); // position initiale

        let moves = 0;
        const maxMoves = 7;

        const interval = setInterval(() => {
            moveSelectRandomly();
            moves++;
            if (moves >= maxMoves) clearInterval(interval);
        }, 1000);
    });
</script>

</body>
</html>