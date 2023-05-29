<?php
    session_start();
    include('fonctions.php');
    if ($_SESSION['status'] != 'admin') {
        redirection('index.php');
    }
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
    <form action="" method="post">
        <select name="value_produit">
            <?php
                $produits = request_produit('SELECT DISTINCT idPdt, designation FROM produit ;');
                foreach ($produits as $ligne_produit) {
                    echo '<option value='.$ligne_produit['idPdt'].'>'.$ligne_produit['designation'].'</option>';
                }
            ?>
        </select>
        <input type="submit" name="connect" value="Choisir" />
        <?php
            if (!empty($_POST) && isset($_POST['connect']) && $_POST['connect'] == 'Choisir') {
                $designation = firstTabVal(request_produit("SELECT designation FROM produit WHERE idPdt=".$_POST['value_produit'].";"));
                $prixTTC = firstTabVal(request_produit("SELECT prixTTC from produit WHERE idPdt = ".$_POST['value_produit'].";"));
                $idForfait = firstTabVal(request_produit("SELECT idForfait FROM produit INNER JOIN forfaitlivraison ON produit.forfaitlivraison = forfaitlivraison.idForfait WHERE idPdt = ".$_POST['value_produit'].";"));
                ?>

                    <form action="" method="post">
                        <fieldset>
                            <legend>Modifier les éléments de <?php echo $designation ?>. </legend>
                            <label for="id_input_designation">Désignation : </label><input type="text" name="designation" id="id_texterea_designation" size="15" value="<?php echo $designation ?>" placeholder="Designation"><br>
                            <label for="id_input_prix">Prix : </label><input type="text" name="prix" id="id_texterea_prix" size="15" value="<?php echo $prixTTC ?>" placeholder="Prix"><br>
                            <label for="id_input_password">Forfait de livraison : </label>
                            <input type="hidden" name="value_produit" value="<?php echo $_POST['value_produit']; ?>">
                            <select name="forfait_livraison">
                                <?php
                                    $tab_produit = request_produit('SELECT description, idForfait FROM forfaitlivraison ;');
                                    foreach ($tab_produit as $ligne) {
                                        $selected = ($ligne['idForfait'] == $idForfait) ? 'selected' : '';
                                        echo '<option value="'.$ligne['idForfait'].'" '.$selected.'>'.$ligne['description'].'</option>';
                                    }
                                ?>
                            </select>
                            <br>
                            <input type="submit" name="connect" value="Modifier" />
                        </fieldset>
                    </form>

                <?php
            }
            if (!empty($_POST) && isset($_POST['connect']) && $_POST['connect'] == 'Modifier') {
                $designation = $_POST['designation']; $prixTTC = $_POST['prix']; $idForfait = $_POST['forfait_livraison'];
                $modifications = request_produit("UPDATE produit SET prixTTC='$prixTTC', designation='$designation', forfaitlivraison='$idForfait' WHERE idPdt=".$_POST['value_produit'].";");
                afficheTableauAssoc(request_produit("SELECT * FROM produit;"));
                echo "<p>Vos informations ont bien étés modifiées.</p>";
            }
        ?>
    </form>
</body>
</html>