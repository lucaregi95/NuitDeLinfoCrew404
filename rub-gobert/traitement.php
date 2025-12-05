<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Requête invalide.");
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if (!$email) {
    die("<p>Adresse email invalide. <a href='index.html'>Retour</a></p>");
}

$file = __DIR__ . '/emails.txt';
file_put_contents($file, $email . PHP_EOL, FILE_APPEND | LOCK_EX);

$mail = new PHPMailer(true);
$status = '';
$message = '';

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    $mail->Username   = 'nuitinforobertschuman@gmail.com'; 
    $mail->Password   = 'xsiyzxgaqfskmfkd'; 

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($mail->Username, 'Crew 404');
    $mail->addAddress($email);

    $mail->isHTML(true);
$mail->Subject = 'Vérification d\'email';
$mail->Body = "
<html>
<head>
  <meta charset='UTF-8'>
</head>
<body style='font-family: Arial, sans-serif; background-color:#f6f8fb; padding:20px;'>
  <div style='max-width:600px; margin:auto; background:#ffffff; padding:20px; border-radius:10px; box-shadow:0 3px 10px rgba(0,0,0,0.1);'>
    <h2 style='color:#2563eb;'>Bonjour !</h2>
    <p style='color:#333; font-size:16px;'>
      Votre adresse <b>$email</b> a bien été enregistrée sur notre serveur.
    </p>
    <p style='color:#555; font-size:14px;'>
      Ce message a été envoyé automatiquement via SMTP Gmail.
    </p>
    <a href='https://ton-domaine.com/mon-fichier.php' 
       style='display:inline-block; padding:12px 20px; margin:15px 0; background-color:#2563eb; color:#fff; text-decoration:none; border-radius:8px; font-weight:bold;'>
      Vérifier
    </a>
    <p style='color:#333; font-size:14px; margin-top:20px;'>
      Cordialement,<br>
      Serveur Ubuntu
    </p>
  </div>
</body>
</html>
";

    $mail->send();
    $status = 'success';
    $message = "Vous devriez regarder votre boîte mail";

} catch (Exception $e) {
    $status = 'error';
    $message = "Adresse enregistrée mais erreur SMTP : " . $mail->ErrorInfo;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Confirmation d'envoi</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

:root {
    --bg-gradient: linear-gradient(135deg, #a8edea, #fed6e3);
    --card-bg: #ffffff;
    --accent: #2563eb;
    --success: #22c55e;
    --error: #ef4444;
    --text: #111827;
}

* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: var(--bg-gradient);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background: var(--card-bg);
    padding: 40px 30px;
    border-radius: 20px;
    width: 420px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    position: relative;
    overflow: hidden;
    animation: fadeIn 0.6s ease forwards;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px);}
    100% { opacity: 1; transform: translateY(0);}
}

h1 {
    font-size: 26px;
    margin-bottom: 20px;
    color: var(--text);
}

.message {
    font-size: 16px;
    margin-bottom: 30px;
    color: var(--text);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-weight: 500;
}

.message svg { width: 24px; height: 24px; }

.success svg { fill: var(--success); }
.error svg { fill: var(--error); }

a.button {
    text-decoration: none;
    display: inline-block;
    background: var(--accent);
    color: #fff;
    padding: 12px 25px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}
a.button:hover {
    background: #1e40af;
    transform: translateY(-2px);
}

</style>
</head>
<body>

<div class="card">
    <h1>Vous avez reçus avec succes l'email de confirmation</h1>
    <p class="message <?= $status ?>">
        <?php if($status === 'success'): ?>
        <!-- Icône check -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.285 6.709a1 1 0 0 0-1.414-1.418l-9.192 9.197-4.192-4.193a1 1 0 0 0-1.414 1.414l4.899 4.899a1 1 0 0 0 1.414 0l9.899-9.899z"/></svg>
        <?php else: ?>
        <!-- Icône erreur -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.371 0 0 5.371 0 12s5.371 12 12 12 12-5.371 12-12S18.629 0 12 0zm0 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10zm1-5h-2v-2h2v2zm0-4h-2V6h2v7z"/></svg>
        <?php endif; ?>
        <?= $message ?>
    </p>
    <a class="button" href="index.html">Retour au formulaire</a>
</div>

</body>
</html>
