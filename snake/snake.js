const canvas = document.getElementById("game"); //recupere les elements depuis le html grace a l'id game
const ctx = canvas.getContext("2d");
const replayBtn = document.getElementById("replayBtn");//recupere les elements depuis le html grace a l'id replayBtn
const scoreDisplay = document.getElementById("score");//recupere les elements depuis le html grace a l'id score
const gameOverMsg = document.getElementById("gameOverMsg");//recupere les elements depuis le html grace a l'id gameOverMsg

const box = 20;
const MAX_POMMES = 3; // definit le nombre max de pommes dans la partie simultanement

let snake, direction, game, pommes, score, serpentColor, isGameOver;

// Initialisation du jeu
function initGame() {
    snake = [{x: 9 * box, y: 10 * box}];
    direction = null; //lance le jeu sans direction afin que le snake ne parte pas directement
    pommes = [];

    for (let i = 0; i < MAX_POMMES; i++) {
        pommes.push(randomFood()); //appel la fonction qui fais apparaitre de facon aleatoire les pommes
    }

    score = 0; //met le score du debut a 0
    serpentColor = "#009933"; //definit la couleur du serp
    scoreDisplay.textContent = "Score : " + score; //affiche le score
    replayBtn.style.display = "none"; //cache le bouton pour rejouer
    gameOverMsg.style.display = "none"; //cache le message de gameOver
    isGameOver = false; //met la variable gameOver a faux

    if (game) clearInterval(game);
    game = null;

    draw(); // message d'attente
}

// Placement aléatoire d’une pomme
function randomFood() {
    let x, y;
    let collisionWithSnake = true; //definit la collision avec le serpent a vrai

    while (collisionWithSnake) {
        x = Math.floor(Math.random() * 20) * box;
        y = Math.floor(Math.random() * 20) * box;

        collisionWithSnake = snake.some(s => s.x === x && s.y === y);

        if (!collisionWithSnake) {
            for (let f of pommes || []) {
                if (f.x === x && f.y === y) {
                    collisionWithSnake = true;
                    break;
                }
            }
        }
    }
    return {x, y};
}

// Détection des touches
document.addEventListener("keydown", event => { //"ecoute" les touches presses du clavier
    if (isGameOver) return;

    if (event.key === "ArrowUp" && direction !== "DOWN") direction = "UP"; //gere les directions en fonction des touches presse
    if (event.key === "ArrowDown" && direction !== "UP") direction = "DOWN"; //gere les directions en fonction des touches presse
    if (event.key === "ArrowLeft" && direction !== "RIGHT") direction = "LEFT";//gere les directions en fonction des touches presse
    if (event.key === "ArrowRight" && direction !== "LEFT") direction = "RIGHT";//gere les directions en fonction des touches presse

    if (!game && ["ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].includes(event.key)) { //fais en sorte de commenceer la game quand une fleche est presses
        startGame();
    }
});

// Démarrage du jeu (vitesse fixe)
function startGame() {
    replayBtn.style.display = "none"; //cache le bouton pour rejouer
    gameOverMsg.style.display = "none"; //cache le message de game over
    isGameOver = false; //met a false la variable de game over

    game = setInterval(draw, 120);
}

// Dessin principal
function draw() {
    ctx.fillStyle = "#000";
    ctx.fillRect(0, 0, 400, 400);

    if (!direction) {
        ctx.fillStyle = "#0f0";
        ctx.font = "20px Arial";
        ctx.fillText("Appuie sur une flèche pour jouer", 30, 200); //affiche le texte pour dire qu'on doit appuyer sur une touche pour start la game
        return;
    }

    // Dessiner serpent
    for (let i = 0; i < snake.length; i++) {
        ctx.fillStyle = i === 0 ? "#00ff55" : serpentColor;
        ctx.fillRect(snake[i].x, snake[i].y, box, box);
    }

    // Dessiner pommes
    ctx.fillStyle = "red";
    for (let f of pommes) ctx.fillRect(f.x, f.y, box, box);

    // Position tête
    let headX = snake[0].x;
    let headY = snake[0].y;

    if (direction === "LEFT") headX -= box;
    if (direction === "RIGHT") headX += box;
    if (direction === "UP") headY -= box;
    if (direction === "DOWN") headY += box;

    // Manger pomme
    let ate = false;
    for (let i = 0; i < pommes.length; i++) {
        if (headX === pommes[i].x && headY === pommes[i].y) {
            pommes.splice(i, 1);
            pommes.push(randomFood());
            score++;
            scoreDisplay.textContent = "Score : " + score;
            serpentColor = getRandomColor();
            sendScore(score);
            ate = true;
            break;
        }
    }

    if (!ate) snake.pop();

    let newHead = {x: headX, y: headY};

    // Collision mur ou soi-même
    if (headX < 0 || headX >= 400 || headY < 0 || headY >= 400 || collision(newHead, snake)) {
        clearInterval(game);
        game = null;
        isGameOver = true;

        gameOverMsg.style.display = "block";
        replayBtn.style.display = "block";

        sendScore(score);

        return;
    }

    snake.unshift(newHead);
}

// Collision avec corps
function collision(head, array) {
    return array.some(part => part.x === head.x && part.y === head.y);
}

// Bouton rejouer
replayBtn.addEventListener("click", () => {
    initGame();
});

// Couleur aléatoire du corps
function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i=0; i<6; i++) color += letters[Math.floor(Math.random() * 16)];
    return color;
}

// Envoi du score au PHP
function sendScore(score) {
    fetch('save_score.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'score=' + score
    })
        .then(res => res.json())
        .then(data => {
            console.log("Score envoyé :", data.score);

            if (data.redirect && data.redirect !== "") {
                window.location.href = data.redirect;
            }
        })
        .catch(err => console.error('Erreur:', err));
}

initGame();
