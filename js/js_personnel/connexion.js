function verifierFormulaire() {
    var entree = document.getElementById('id_input_login').value; // Récupère la valeur entrée dans le champ
    const listeMajuscules = /[A-Z]/; // Liste majs
    const listeSpecialChars = /[!@#$%&*()_+\-={};:|,.?]/; // Liste caractères spéciaxu
  
    // Test si il y a des majuscules et des caractères spéciaux.
    if (!listeMajuscules.test(entree) || !listeSpecialChars.test(entree)) {
        var res = false;
    } else {
        var res = true;
    }
    return res
}

function test_login() {
    var car_et_maj = verifierFormulaire();
    if (!car_et_maj) {
        login_input_class = 'border_red';
    } else {
        login_input_class = 'border_green';
    }
    value_login_actuelle = document.getElementById('id_input_login').classList.value;
    if (value_login_actuelle != login_input_class) {
        document.getElementById('id_input_login').classList.replace(value_login_actuelle, login_input_class)
    }
}

function test_password() {
    var entree_password = document.getElementById('id_input_password').value;
    if (entree_password == '') {
        password_input_class = 'border_red';
    } else {
        password_input_class = 'border_green';
    }
    value_password_actuelle = document.getElementById('id_input_password').classList.value;
    if (value_password_actuelle != password_input_class) {
        document.getElementById('id_input_password').classList.replace(value_password_actuelle, password_input_class)
    }
}

const formulaire = document.querySelector("form");
formulaire.addEventListener("submit", function(event) { // Quand l'utilisateur envoi le formulaire
    event.preventDefault();
    const estValide = verifierFormulaire(); // Vérifie si le login est valide

    if (estValide) {
        formulaire.submit(); // Envoi le formulaire
    } else {
        alert("Le login doit contenir au moins une majuscule et un caractère spécial.") // Bloque l'envoi
    }
});

setInterval(test_login, 500) // Effectue la fonction test_login toutes les 500ms
setInterval(test_password, 500) // Effectue la fonction test_password toutes les 500ms