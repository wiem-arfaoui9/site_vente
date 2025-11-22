<?php
include "config.php";

// Vérifier session
if (!isset($_SESSION['user']) || !$_SESSION['user']) {
    header("Location: login.php");
    exit;
}

// Produits (tu peux remplacer par DB plus tard)
$produits = [
    ['id'=>1,'nom'=>'Sac à dos','prix'=>49.99,'img'=>'images/sac1.jpg','desc'=>'Sac confortable, tressé à la main.'],
    ['id'=>2,'nom'=>'Sac à main','prix'=>79.99,'img'=>'images/sac2.jpg','desc'=>'Élégant et durable, parfait pour la ville.'],
    ['id'=>3,'nom'=>'Sac de voyage','prix'=>129.99,'img'=>'images/sac3.jpg','desc'=>'Grand format, idéal pour les week-ends.'],
];

// Gérer ajout par GET (optionnel si tu veux bouton PHP)
// Ici on laisse tout côté JS, mais on garde cette logique si tu veux utiliser liens PHP
if (isset($_GET['ajouter'])) {
    $id = (int)$_GET['ajouter'];
    $_SESSION['panier'][$id] = ($_SESSION['panier'][$id] ?? 0) + 1;
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Fibra — Catalogue</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <!-- NAVBAR -->
  <header class="site-header">
    <div class="brand-left">
      <img src="images/logo-placeholder.png" alt="Fibra" class="logo" />
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

  <!-- MAIN -->
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
      <div id="productsGrid" class="grid">
        <!-- Les cartes produits seront injectées par app.js -->
      </div>
    </section>

    <section id="about" class="about">
      <h2>À propos</h2>
      <p>
        Chez <strong>Fibra</strong>, nous travaillons avec des artisans tunisiens pour créer
        des sacs tressés à la main. Chaque pièce est unique, durable et fabriquée avec soin.
      </p>
    </section>
  </main>

  <!-- PANIER (panel) -->
  <aside id="cartPanel" class="cart-panel" aria-hidden="true">
    <div class="cart-head">
      <h3>Votre panier</h3>
      <button id="cartClose" class="close-btn" aria-label="Fermer">×</button>
    </div>
    <div id="cartItems" class="cart-items"></div>
    <div class="cart-footer">
      <div class="cart-total">Total: <strong id="cartTotal">0 TND</strong></div>
      <button id="checkoutBtn" class="btn-primary">Procéder au paiement</button>
      <p class="small">Paiement simulé (démo)</p>
    </div>
  </aside>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="footer-left">
      <small>© <span id="year"></span> Fibra</small>
    </div>
    <div class="footer-right">
      <a href="https://wa.me/21600000000" target="_blank" class="social">WhatsApp</a>
      <a href="https://instagram.com" target="_blank" class="social">Instagram</a>
      <a href="https://facebook.com" target="_blank" class="social">Facebook</a>
    </div>
  </footer>

  <!-- template -->
  <template id="productCardTemplate">
    <article class="card">
      <img class="card-image" alt="produit" loading="lazy" />
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
