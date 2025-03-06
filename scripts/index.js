// const apikey = "AIzaSyAIpFFILMeSTegVWB5jvw-f8VYPDHdz5zA"
// let url = `https://www.googleapis.com/books/v1/volumes?q=intitle:${input.value}&key=${apiKey}`
// Partie pour les options de profil
var logoutButton = document.getElementById("logout");
var profileButton = document.querySelector(".profile-button");
var passwordButton = document.querySelector(".password-button");
var mailbutton = document.querySelector(".mail-button");
var ppButton = document.querySelector(".pp-button");
var profileTitle = document.querySelector(".profile-title");
var profileContainer = document.querySelector(".profile-container");
profileButton === null || profileButton === void 0 ? void 0 : profileButton.addEventListener("click", function () {
    profileContainer.innerHTML = "";
    var text1 = document.createElement("p");
    text1.textContent = "Ici vous pouvez modifier votre Pseudonyme. \n Attention le nom d'utilisateur doit: \n- Ne pas contenir de mot choquant\n- Contenir au moins 4 caractères";
    var subDiv = document.createElement("div");
    subDiv.classList.add("gap-x-2", "flex");
    var input1 = document.createElement("input");
    input1.placeholder = "Nouveau pseudonyme";
    input1.classList.add("rounded-md", "px-2", "py-1", "min-w-20");
    var submit1 = document.createElement("button");
    submit1.textContent = "Enregistrer";
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white");
    subDiv.appendChild(input1);
    subDiv.appendChild(submit1);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text1);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(subDiv);
});
logoutButton === null || logoutButton === void 0 ? void 0 : logoutButton.addEventListener("click", function () {
    fetch('../utils/logout.php', {
        method: 'GET',
        credentials: 'same-origin', // Assure que la session est envoyée avec la requête
    })
        .then(function (response) {
        if (response.ok) {
            window.location.href = "../index.php"; // Redirige vers la page d'accueil après la déconnexion
        }
    })
        .catch(function (error) {
        console.error('Erreur de déconnexion:', error);
    });
});
