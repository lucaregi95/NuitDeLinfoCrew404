<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Age Selection Animée</title>
    <link rel="stylesheet" href="champChiant.css">
</head>
<body>

<?php
$numbers = range(1, 100);
shuffle($numbers);
?>

<form action="../snake/snake.html" method="get">
    <select id="age-select" name="age">
        <option disabled selected>-- Choisissez votre âge --</option>
        <?php foreach ($numbers as $n): ?>
            <option value="<?= $n ?>"><?= $n ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" id="validate-btn" value="Valider">
</form>

<script>
    const select = document.getElementById('age-select');
    const button = document.getElementById('validate-btn');

    function flipOptions() {
        const options = select.querySelectorAll('option');
        options.forEach(option => {
            if (Math.random() < 0.5) {
                option.classList.toggle('flipped');
            }
        });
    }

    function moveSelectRandomly() {
        const bodyWidth = window.innerWidth;
        const bodyHeight = window.innerHeight;

        const randomLeft = Math.random() * (bodyWidth - 200);
        const randomTop = Math.random() * (bodyHeight - 200);

        select.style.position = 'absolute';
        button.style.position = 'absolute';

        select.style.left = randomLeft + 'px';
        select.style.top = randomTop + 'px';

        button.style.left = randomLeft + 'px';
        button.style.top = (randomTop + select.offsetHeight + 10) + 'px';
    }

    window.onload = () => {
        flipOptions();
        moveSelectRandomly();

        let moves = 0;
        const interval = setInterval(() => {
            moveSelectRandomly();
            moves++;
            if (moves >= 7) clearInterval(interval);
        }, 1000);
    };
</script>

</body>
</html>
