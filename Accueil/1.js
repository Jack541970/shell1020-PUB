// <!-- _________________________deconexion menu automatique_______________________________ -->

// Fonction pour rediriger vers la page de déconnexion après un certain temps d'inactivité
function setLogoutTimeout() {
  const timeout = 300000; // 5 minutes en millisecondes
  setTimeout(function () {
      window.location.href = '../Connex_inscription/deconnexion.php';
  }, timeout);
}

// Appeler la fonction au chargement de la page
window.onload = function () {
  setLogoutTimeout();

  // Réinitialiser le timeout à chaque interaction utilisateur
  document.addEventListener('mousemove', function () {
      setLogoutTimeout();
  });

  document.addEventListener('keydown', function () {
      setLogoutTimeout();
  });
};

// <!-- _________________________Burger_______________________________ -->

const burger = document.querySelector("#burger");
const pop = document.querySelector("#pop");

let isPopUpVisible = false;

burger.addEventListener('click', () => {
// Vérifier l'état actuel de la pop-up
if (isPopUpVisible) {
// Si la pop-up est visible, la masquer en définissant le transform à sa valeur initiale (par exemple translateX(-100%))
pop.style.transform = 'translateX(100%)';
// Mettre à jour l'état de la pop-up
isPopUpVisible = false;

// Rendre invisible et ne pas occuper d'espace à droite lorsque la pop-up est fermée
setTimeout(() => {
pop.style.visibility = 'hidden';
pop.style.display = 'none';
}, 700); // ajustez le délai pour correspondre à la transition
} else {
// Si la pop-up est cachée, la rendre visible en définissant le transform à 'translateX(0)'
pop.style.transform = 'translateX(0)';
// Mettre à jour l'état de la pop-up
isPopUpVisible = true;

// Rendre visible lorsque la pop-up est ouverte
pop.style.visibility = 'visible';
pop.style.display = 'block';
}      
});

const burgerButton = document.querySelector('.burger-icon');

burgerButton.addEventListener('click', () => {
const menuPop = document.querySelector('.menupop');
menuPop.classList.toggle('hidden');
});


// <!-- _________________________Compteur jours sans accident_______________________________ -->


function enregistrerDate() {
var selectedDate = document.getElementById("selectedDate").value;

var xhrEnregistrer = new XMLHttpRequest();
xhrEnregistrer.onreadystatechange = function() {
if (xhrEnregistrer.readyState == 4 && xhrEnregistrer.status == 200) {
    alert(xhrEnregistrer.responseText);
    // Actualiser seulement les données nécessaires après un changement
    actualiserDonnees();
}
};
xhrEnregistrer.open("POST", "enregistrerDate.php", true);
xhrEnregistrer.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhrEnregistrer.send("selectedDate=" + selectedDate);
}

function actualiserDonnees() {
recupererDerniereDate();
visualiserRecordTable();
}




function recupererDerniereDate() {
var xhrRecuperer = new XMLHttpRequest();
xhrRecuperer.onreadystatechange = function() {
  if (xhrRecuperer.readyState == 4 && xhrRecuperer.status == 200) {
      var derniereDate = new Date(xhrRecuperer.responseText);
      document.getElementById("resultatDate").innerHTML = "Date du dernier accident : " + derniereDate.toLocaleDateString();
      
      // Calculer le nombre de jours entre la date actuelle et la dernière date enregistrée
      var currentDate = new Date();
      var difference = Math.floor((currentDate - derniereDate) / (1000 * 60 * 60 * 24));
      document.getElementById("compteurJours").innerHTML = "Jours sans accident : " + difference + "";
      
      // Envoyer le nombre de jours écoulés à la base de données
      var xhrEnregistrerRecord = new XMLHttpRequest();
      xhrEnregistrerRecord.open("POST", "enregistrerRecord.php", true);
      xhrEnregistrerRecord.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhrEnregistrerRecord.send("nombreJoursEcoulés=" + difference);
  }
};
xhrRecuperer.open("GET", "recupererDerniereDate.php", true);
xhrRecuperer.send();
}





function visualiserRecordTable() {
// Envoie une requête HTTP GET à visualiserRecordTable.php
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
if (xhr.readyState == 4 && xhr.status == 200) {
    var recordJours = xhr.responseText;
    document.getElementById("recordJours").innerHTML = "Record sans accidents : " + recordJours + "";
}
};
xhr.open("GET", "visualiserRecord.php", true);
xhr.send();
}

// Actualiser toutes les données toutes les 5 secondes (par exemple)
setInterval(actualiserDonnees, 1000);


// <!-- _________________________Bouton accueil_______________________________ -->


document.addEventListener("DOMContentLoaded", function () {
var button = document.getElementById("bt2");

button.addEventListener("click", function () {
window.location.href = "../Accidents/view_files.php"; //URL pour le lien
});
});




document.addEventListener("DOMContentLoaded", function () {
var button = document.getElementById("bt3");

button.addEventListener("click", function () {
window.location.href =
"../Ressources_humaines/view_files.php"; //URL pour le lien
});
});


document.addEventListener("DOMContentLoaded", function () {
var button = document.getElementById("bt4");

button.addEventListener("click", function () {
window.location.href = "../Entreprise/view_files.php"; //URL pour le lien
});
});

document.addEventListener("DOMContentLoaded", function () {
var button = document.getElementById("bt5");

button.addEventListener("click", function () {
window.location.href =
"../Sante_et_securite/view_files.php"; //URL pour le lien
});
});


document.addEventListener("DOMContentLoaded", function () {
var button = document.getElementById("bt6");

button.addEventListener("click", function () {
window.location.href =
"../Produits_chimiques/view_files.php"; //URL pour le lien
});
});


document.addEventListener("DOMContentLoaded", function () {
var button = document.getElementById("bt7");

button.addEventListener("click", function () {
window.location.href = "../Materiels/view_files.php"; //URL pour le lien
});
});

document.addEventListener("DOMContentLoaded", function () {
var button = document.getElementById("bt8");

button.addEventListener("click", function () {
window.location.href =
"../Rapports_mensuels/view_files.php"; //URL pour le lien
});
});


document.addEventListener("DOMContentLoaded", function () {
var button = document.getElementById("bt9");

button.addEventListener("click", function () {
window.location.href = "../Divers/view_files.php"; //URL pour le lien
});
});