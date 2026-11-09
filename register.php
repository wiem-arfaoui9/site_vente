<?php

include "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = trim($_POST["nom"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $motdepasse = trim($_POST["motdepasse"] ?? "");

    if ($nom == "" || $email == "" || $motdepasse == "") {

        $message = "Remplissez tous les champs.";

    } else {

        $check = mysqli_query(
            $conn,
            "SELECT * FROM users WHERE email='$email'"
        );

        if (mysqli_num_rows($check) > 0) {

            $message = "Cet email existe déjà.";

        } else {

            $motdepasseHash = password_hash(
                $motdepasse,
                PASSWORD_DEFAULT
            );

            mysqli_query(
                $conn,
                "INSERT INTO users(nom,email,motdepasse)
                 VALUES('$nom','$email','$motdepasseHash')"
            );

            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title>Fibra - Inscription</title>

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
    width:350px;
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
    color:white;
    border:none;
    width:100%;
    padding:10px;
    border-radius:8px;
    cursor:pointer;
}

.btn-primary:hover{
    background:#8e44ad;
}

.error{
    color:#c0392b;
    background:#fdecea;
    padding:10px;
    border-radius:6px;
    margin-bottom:10px;
}

.note{
    text-align:center;
    margin-top:15px;
}
</style>

</head>

<body>

<main class="login-wrap">

<form method="POST" class="login-card">

<h2>Inscription Fibra</h2>

<?php if($message != ""): ?>
<div class="error">
    <?= htmlspecialchars($message) ?>
</div>
<?php endif; ?>

<label>Nom</label>
<input
type="text"
name="nom"
placeholder="Votre nom"
required>

<label>Email</label>
<input
type="email"
name="email"
placeholder="Votre email"
required>

<label>Mot de passe</label>
<input
type="password"
name="motdepasse"
placeholder="Votre mot de passe"
required>

<button type="submit" class="btn-primary">
S'inscrire
</button>

<p class="note">
Déjà inscrit ?
<a href="login.php">Se connecter</a>
</p>

</form>

</main>

</body>
</html>
