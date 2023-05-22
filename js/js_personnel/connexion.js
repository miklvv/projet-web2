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
    var car_et_maj = verifierFormulaire(); // car_et_maj prend true ou false
    if (car_et_maj) {
        insertion = 'Login conforme.';
    } else {
        insertion = 'Login non conforme.';
    }
    document.getElementById('check_login').innerHTML=insertion; // Ecrit un message ou l'autre dans le champ de texte 'check_login'
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