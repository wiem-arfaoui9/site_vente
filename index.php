<?php
include "config.php";

if (!isset($_SESSION['user']) || !$_SESSION['user']) {
    header("Location: login.php");
    exit;
}

$produits = [
    ['id'=>1,'nom'=>'Sac a main','prix'=>150.99,'img'=>'images/sac1.jpg','desc'=>'l élegence qui parle .'],
    ['id'=>2,'nom'=>'Sac à main','prix'=>79.99,'img'=>'images/sac2.jpg','desc'=>'Élégant et durable, parfait pour la ville.'],
    ['id'=>3,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac3.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>4,'nom'=>'Sac à main','prix'=>85.99,'img'=>'images/sac4.jpg','desc'=>'Sac rouge chic et intemporel, alliant style moderne et touche de sophistication.'],
    ['id'=>5,'nom'=>'Sac à main','prix'=>111.99,'img'=>'images/sac5.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>6,'nom'=>'Sac à main','prix'=>169.99,'img'=>'images/sac6.jpg','desc'=>'Sac élégant, conçu pour apporter une touche de classe à chaque occasion.'],
    ['id'=>7,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac7.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>8,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac8.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>9,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac9.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>10,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac10.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>11,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac11.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>12,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac12.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>13,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac13.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>14,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac14.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>15,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac15.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
    ['id'=>16,'nom'=>'Sac à main','prix'=>129.99,'img'=>'images/sac16.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Fibra — Catalogue</title>
<link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<header class="site-header">
  <div class="brand-left">
    <img src="images/logo-placeholder.png" alt="Fibra" class="logo">
    <div class="brand-text">
      <span class="brand-name">Fibra</span>
      <small class="brand-sub">Sacs artisanaux</small>
    </div>
  </div>
  <nav class="nav-right">
    <a href="#about" class="nav-link">À propos</a>
    <button id="cartToggle" class="cart-btn">Panier (<span id="cartCount">0</span>)</button>
    <a href="logout.php" class="nav-link logout-link">Déconnexion</a>
  </nav>
</header>

<main class="site-main">
  <section class="hero">
    <div class="hero-inner">
      <h1>Sacs artisanaux en fibres naturelles</h1>
      <p>Fabriqués en Tunisie avec passion — pièces uniques et durables.</p>
      <a href="#catalogue" class="btn-primary">Voir le catalogue</a>
    </div>
  </section>

  <section id="catalogue" class="catalogue">
    <h2>Catalogue</h2>
    <div id="productsGrid" class="grid"></div>
  </section>

  <section id="about" class="about">
    <h2>À propos</h2>
    <p>
      Chez <strong>Fibra</strong>Chaque pièce est unique, durable et fabriquée avec soin.
    </p>
  </section>
</main>

<aside id="cartPanel" class="cart-panel" aria-hidden="true">
  <div class="cart-head">
    <h3>Votre panier</h3>
    <button id="cartClose" class="close-btn">×</button>
  </div>
  <div id="cartItems" class="cart-items"></div>
  <div class="cart-footer">
    <div class="cart-total">Total: <strong id="cartTotal">0 TND</strong></div>
    <button id="checkoutBtn" class="btn-primary">Procéder au paiement</button>
    <p class="small">Paiement simulé (démo)</p>
  </div>
</aside>

<footer class="site-footer">
  <div class="footer-left">
    <small>© <span id="year"></span> Fibra</small>
  </div>
  <div class="footer-right">
    <a href="https://wa.me/21600000000" target="_blank">WhatsApp</a>
    <a href="https://instagram.com" target="_blank">Instagram</a>
    <a href="https://facebook.com" target="_blank">Facebook</a>
  </div>
</footer>

<template id="productCardTemplate">
  <article class="card">
    <img class="card-image" alt="produit" loading="lazy">
    <div class="card-body">
      <h3 class="card-title"></h3>
      <p class="card-desc"></p>
      <div class="card-meta">
        <span class="price"></span>
        <button class="add-btn">Ajouter</button>
      </div>
    </div>
  </article>
</template>

<script src="app.js"></script>
</body>
</html>
