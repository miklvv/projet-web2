<?php
    session_start();
    include('fonctions.php');
    if (empty($_SESSION)) {
      redirection('connexion.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">PROJET WEB</a>
        <button
          class="navbar-toggler navbar-toggler-right"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <?php 
              if ($_SESSION['status'] == 'admin') {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="insertion.php">Insertion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="modification.php">Modification</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="suppression.php">Suppression</a>
            </li>
            <?php
              }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="connexion.php?status=deconnect">Se déconnecter</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <?php
            $tab_produits = request_produit('SELECT designation produit, intitule categorie, forfaitlivraison.description livraison, prixTTC FROM produit INNER JOIN categorieproduit ON produit.idCat = categorieproduit.idCat INNER JOIN forfaitlivraison ON produit.forfaitlivraison = forfaitlivraison.idForfait;');
            afficheTableauAssoc($tab_produits);
        ?>
    </div>
    <script src="js/js_personnel/navbar.js"></script>
</body>
</html>