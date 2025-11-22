<?php
// config.php — session + (optionnel) connexion DB
session_start();

// initialiser panier si inexistant
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// optionnel : connexion DB
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "vente_db";

// Décommenter si tu veux utiliser la DB
// $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
// if ($conn->connect_error) {
//     die("Erreur DB: " . $conn->connect_error);
// }
?>
