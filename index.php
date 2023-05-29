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

    <link rel="stylesheet" href="css/css_personnel/css_global.css">
    <link rel="stylesheet" href="css/css_bootstrap/bootstrap.min.css">
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

    <div class="accueil-resp" id="top">
        <img src="media/images/bg_image2.jpg" alt="Background" id="bg_image" style="width: 100%;">
        <article class="text-home">
          <div class="container px-4 px-lg-5 d-flex h-100 justify-content-center">
            <div class="text-box">
              <h1>Bienvenue sur notre site !</h1>
            </div>
          </div>
        </article>
      </div>

      <div class="contenu-page">
      <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h1>Nos produits</h1>
            <div class="container_produits">
              <?php
                $tab_produits = request_produit('SELECT designation produit, intitule categorie, forfaitlivraison.description livraison, prixTTC, images FROM produit INNER JOIN categorieproduit ON produit.idCat = categorieproduit.idCat INNER JOIN forfaitlivraison ON produit.forfaitlivraison = forfaitlivraison.idForfait;');
                foreach ($tab_produits as $ligne_produits) {
                ?>
                  <article class="article_produit">
                    <h2><?php echo $ligne_produits["produit"]; ?></h2>
                    <img src="<?php echo $ligne_produits['images']; ?>" alt="Image de <?php echo $ligne['designation']; ?>" style="width:30%">
                    <h5>Prix : <?php echo $ligne_produits["prixTTC"] ?>€</h5>
                  </article>
                  <?php
                }
              ?>
            </div>
            <?php
              $tab_produits = request_produit('SELECT designation produit, intitule categorie, forfaitlivraison.description livraison, prixTTC, images FROM produit INNER JOIN categorieproduit ON produit.idCat = categorieproduit.idCat INNER JOIN forfaitlivraison ON produit.forfaitlivraison = forfaitlivraison.idForfait;');
              echo '<table>';
              foreach($tab_produits as $ligne_produits) {
                echo '<tr>';
                foreach ($ligne_produits as $case_produits) {
                  if (strpos($case_produits, 'media') === 0 || strpos($case_produits, 'media/') === 0) {
                    echo '<td><img src="'.$case_produits.'" alt="Image de '.$ligne_produits['designation'].'" style="width:50px"></td>';
                  } else {
                    echo "<td>$case_produits</td>";
                  }
                }
                echo '</tr>';
              }
              echo '</table>';
            ?>
            
                <p>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-linkedin"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"
                    />
                  </svg>
                  <a
                    href="https://fr.linkedin.com/in/levan-martin-a83091254"
                    target="_blank"
                    class="text-reset text-decoration-none"
                    >Linkedin</a
                  >
                </p>
              </article>
            </div>
          </div>
        </div>

        <div class="container">
          <footer
            class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top"
          >
            <p class="col-md-4 mb-0 text-muted">&copy; 2022 Company, Inc</p>

            <a
              href="/"
              class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none"
            >
              <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
              </svg>
            </a>

            <ul class="nav col-md-4 justify-content-end">
              <li class="nav-item">
                <a href="#top" class="nav-link px-2 text-muted">Accueil</a>
              </li>
              <li class="nav-item">
                <a href="competences.html" class="nav-link px-2 text-muted">Compétences</a>
              </li>
              <li class="nav-item">
                <a href="interets.html" class="nav-link px-2 text-muted">Intérêts</a>
              </li>
              <li class="nav-item">
                <a href="projetprofessionnel.html" class="nav-link px-2 text-muted">Projet Professionnel</a>
              </li>
              <li class="nav-item">
                <a href="liensutiles.html" class="nav-link px-2 text-muted">Liens utiles</a>
              </li>
            </ul>
          </footer>
        </div>
      </div>
    </div>
    <script src="js/js_personnel/navbar.js"></script>
</body>
</html>