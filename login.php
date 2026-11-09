<?php

include "config.php";

if (isset($_SESSION['user']) && $_SESSION['user']) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');
    $mdp   = trim($_POST['motdepasse'] ?? '');

    if (empty($email) || empty($mdp)) {

        $error = "Remplissez tous les champs.";

    } else {

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            $user = mysqli_fetch_assoc($result);

            if (password_verify($mdp, $user['motdepasse'])) {

                $_SESSION['user'] = $user['nom'];

                header("Location: index.php");
                exit;

            } else {

                $error = "Mot de passe incorrect.";

            }

        } else {

            $error = "Utilisateur introuvable.";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Zenvy — Connexion</title>

<link rel="stylesheet" href="assets/styles.css">

<style>
.login-wrap{
    display:flex;
    height:100vh;
    align-items:center;
    justify-content:center;
    background:#fffafc;
}

.login-card{
    background:#fff;
    padding:24px;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    width:320px;
}

input{
    width:100%;
    padding:10px;
    margin:8px 0;
    border-radius:6px;
    border:1px solid #ddd;
}

.btn-primary{
    background:#9b59b6;
    color:#fff;
    padding:10px;
    border:none;
    border-radius:8px;
    width:100%;
    cursor:pointer;
}

.error{
    color:#c0392b;
    background:#fdecea;
    padding:8px;
    border-radius:6px;
    margin-bottom:10px;
}

.note{
    font-size:0.85rem;
    color:#666;
    margin-top:8px;
    text-align:center;
}
</style>

</head>

<body>

<main class="login-wrap">

<form method="post" class="login-card">

<h2>Connexion Zenvy</h2>

<?php if ($error): ?>
<div class="error">
<?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<label>Email</label>
<input
type="email"
name="email"
required
placeholder="Votre email">

<label>Mot de passe</label>
<input
type="password"
name="motdepasse"
required
placeholder="Votre mot de passe">

<button type="submit" class="btn-primary">
Se connecter
</button>

<p class="note">
Pas encore inscrit ?
<a href="register.php">Créer un compte</a>
</p>

</form>

</main>

</body>
</html>