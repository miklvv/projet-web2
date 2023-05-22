function verifierFormulaire() {
    var entree = document.getElementById('id_input_login').value;
    const listeMajuscules = /[A-Z]/;
    const listeSpecialChars = /[!@#$%&*()_+\-={};:|,.?]/;
  
    if (!listeMajuscules.test(entree) || !listeSpecialChars.test(entree)) {
        // alert("La donnée doit contenir au moins une majuscule et un caractère spécial.");
        var res = false;
    } else {
        var res = true;
    }
    return res
}

function test_login() {
    var car_et_maj = verifierFormulaire();
    if (car_et_maj) {
        insertion = 'Login conforme.';
    } else {
        insertion = 'Login non conforme.';
    }
    document.getElementById('check_login').innerHTML=insertion;
}

const formulaire = document.querySelector("form");
formulaire.addEventListener("submit", function(event) {
    event.preventDefault();
    const estValide = verifierFormulaire();

    if (estValide) {
        formulaire.submit();
    } else {
        alert('Le login n\'est pas conforme.')
    }
});

setInterval(test_login, 500)