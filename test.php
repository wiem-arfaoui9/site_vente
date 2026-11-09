<?php

$conn = new mysqli(
    "127.0.0.1",
    "root",
    "",
    "vente_db",
    3308
);

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

echo "Connexion réussie";

?>