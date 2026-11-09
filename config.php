<?php

session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$conn = new mysqli(
    "127.0.0.1",
    "root",
    "",
    "vente_db",
    3308
);

if ($conn->connect_error) {
    die("Erreur DB : " . $conn->connect_error);
}

?>