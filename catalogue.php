<?php
include "config.php";

// Vérifier session
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

// Exemple produits
$produits = [
    ['id'=>1,'nom'=>'Sac à dos','prix'=>49.99,'img'=>'sac1.jpg'],
    ['id'=>2,'nom'=>'Sac à main','prix'=>79.99,'img'=>'sac2.jpg'],
    ['id'=>3,'nom'=>'Sac de voyage','prix'=>129.99,'img'=>'sac3.jpg'],
];

// Ajouter au panier
if(isset($_GET['ajouter'])){
    $id = $_GET['ajouter'];
    if(isset($_SESSION['panier'][$id])){
        $_SESSION['panier'][$id] +=1;
    } else {
        $_SESSION['panier'][$id]=1;
    }
    header("Location: catalogue.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Catalogue - Mini Shop</title>
<style>
body{font-family:Arial; display:flex; margin:0;}
.catalogue{width:70%; padding:20px; display:flex; flex-wrap:wrap; gap:20px;}
.panier{width:30%; background:#f7f7f7; padding:20px; border-left:1px solid #ccc; height:100vh; overflow:auto;}
.card{width:200px; background:#fff; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.2); text-align:center; padding:10px; transition:0.3s;}
.card:hover{transform:translateY(-10px); box-shadow:0 15px 25px rgba(0,0,0,0.3);}
.card img{width:100%; border-radius:10px;}
.card button{margin-top:10px; padding:8px 12px; background:#28a745; color:#fff; border:none; cursor:pointer; border-radius:5px;}
.card button:hover{background:#218838;}
a.logout{display:inline-block;margin-bottom:10px;padding:8px 12px;background:#dc3545;color:#fff;text-decoration:none;border-radius:4px;}
a.logout:hover{background:#c82333;}
</style>
</head>
<body>

<div class="catalogue">
<?php foreach($produits as $p): ?>
<div class="card">
<img src="<?= $p['img'] ?>" alt="<?= $p['nom'] ?>">
<h3><?= $p['nom'] ?></h3>
<p>Prix: <?= $p['prix'] ?> €</p>
<a href="catalogue.php?ajouter=<?= $p['id'] ?>"><button>Ajouter au panier</button></a>
</div>
<?php endforeach; ?>
</div>

<div class="panier">
<h2>Panier</h2>
<a href="logout.php" class="logout">Déconnexion</a>
<?php
$total=0;
if(!empty($_SESSION['panier'])){
    foreach($_SESSION['panier'] as $id=>$qte){
        $nom=$produits[$id-1]['nom'];
        $prix=$produits[$id-1]['prix'];
        $subtotal=$prix*$qte;
        $total+=$subtotal;
        echo "$nom x $qte = $subtotal €<br>";
    }
    echo "<hr>Total: $total €";
}else{
    echo "Votre panier est vide";
}
?>
</div>

</body>
</html>
