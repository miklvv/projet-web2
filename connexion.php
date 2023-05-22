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
    <title>Connexion</title>
</head>
<body>
    <?php
        $redirect = false;
        if (!empty($_POST) && isset($_POST['login'])) {
            // Récupérer le login et l'adresse IP
            $login = $_POST['login'];
            $ip = $_SERVER['REMOTE_ADDR'];

            // Informations par défaut.
            $statut_connexion = false; // statut de connexion (false = échec, true = réussite)
            $statut_personne = ''; // statut de la personne (vide si la connexion a échoué)
            
            if (login($_POST['login'], $_POST['password'])) {
                $statut_connexion = true;
                $_SESSION['ouverture'] = 'Connected';
                $_SESSION['login'] = $_POST['login'];
                $tab_status = request_login("SELECT status_session FROM login WHERE login='".$_POST['login']."';");
                if (firstTabVal($tab_status) == 'admin') {
                    $statut_personne = 'admin';
                    $_SESSION['status'] = $statut_personne;
                } else {
                    $statut_personne = 'etu';
                    $_SESSION['status'] = $statut_personne;
                }
                $redirect = true;

            } else {
                echo '<p>Mauvaise paire Login / Mot de passe</p>';
            }

            // Enregistrer les informations dans le fichier de log
            $log = fopen('logs/connexion', 'a'); // Ouverture en mode ajout
            if ($log) {
                $heure = date('Y-m-d H:i:s');
                $statut = ($statut_connexion) ? 'réussie' : 'échouée';
                $message = "$heure - Tentative de connexion $statut - Login: $login - IP: $ip - Statut de la personne: $statut_personne\n";
                fwrite($log, $message);
                fclose($log);
            }
        }
    ?>
    <form action="" method="post">
        <fieldset>
            <legend>Formulaire de Connexion</legend>
            <label for="id_input_login">Login : </label><input type="text" name="login" id="id_input_login" size="15" required placeholder="@login"><br>
            <label for="id_input_password">Mot de passe : </label><input type="password" name="password" id="id_input_password" size="15" required placeholder="@passwrod"><br>
            <input type="submit" name="connect" value="Connexion" />
        </fieldset>
        <p id="check_login"></p>
    </form>
    <script src="js/js_personnel/connexion.js" type="text/javascript"></script>
</body>
</html>

<?php
    if ($redirect == true) {
        redirection('index.php');
    }

    if (!empty($_GET) && isset($_GET) && $_GET['status'] == 'deconnect') {
        $_SESSION = array();
        session_destroy();
    }
?>