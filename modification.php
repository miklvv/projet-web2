<?php
    session_start();
    include('fonctions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (!($_SESSION['status'] = 'admin')) {
            header('location: index.php');
        }
    ?>
    <form action="" method="get">
        <select name="value_produit">
            <?php
                $produits = request_produit('SELECT DISTINCT designation FROM produit ;');
                foreach ($produits as $ligne_produit) {
                    foreach($ligne_produit as $produit) {
                        echo '<option value='.$produit.'>'.$produit.'</option>';
                    }
                }
            ?>
        </select>
        <input type="submit" name="connect" value="Connexion" />
    </form>
</body>
</html>