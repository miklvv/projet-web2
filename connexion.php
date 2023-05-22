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
        if (!empty($_POST) && isset($_POST['login'])) {
            if (login($_POST['login'], $_POST['password'])) {
                $_SESSION['ouverture'] = 'Connected';
                $_SESSION['login'] = $_POST['login'];
                $tab_status = request_login("SELECT status_session FROM table_login WHERE login='".$_POST['login']."';");
                if (firstTabVal($tab_status) == 'admin') {
                    $_SESSION['status'] = 'admin';
                } else {
                    $_SESSION['status'] = 'etu';
                }
                header('location: index.php');
            } else {
                echo '<p>Mauvaise paire Login / Mot de passe</p>';
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
    <script src="js/connexion.js" type="text/javascript"></script>
</body>
</html>