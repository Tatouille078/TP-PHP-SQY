// const apikey = "AIzaSyAIpFFILMeSTegVWB5jvw-f8VYPDHdz5zA"
// let url = `https://www.googleapis.com/books/v1/volumes?q=intitle:${input.value}&key=${apiKey}`
// Partie pour les options de profil
var logoutButton = document.getElementById("logout");
var profileButton = document.querySelector(".profile-button");
var passwordButton = document.querySelector(".password-button");
var mailButton = document.querySelector(".mail-button");
var ppButton = document.querySelector(".pp-button");
var profileTitle = document.querySelector(".profile-title");
var profileContainer = document.querySelector(".profile-container");
profileButton === null || profileButton === void 0 ? void 0 : profileButton.addEventListener("click", function () {
    profileContainer.innerHTML = "";
    var text1 = document.createElement("p");
    text1.textContent = "Ici vous pouvez modifier votre Pseudonyme. Attention le nom d'utilisateur doit:";
    var text2 = document.createElement("p");
    text2.textContent = "- Ne pas contenir de mot choquant";
    var text3 = document.createElement("p");
    text3.textContent = "- Contenir doit être compris entre 4 et 24 caractères";
    var text4 = document.createElement("p");
    text4.textContent = "- Contenir que des minuscules, majuscules, chiffres ou un/des underscores";
    var subDiv = document.createElement("div");
    subDiv.classList.add("gap-x-2", "flex", "mt-6");
    var input1 = document.createElement("input");
    input1.placeholder = "Nouveau pseudonyme";
    input1.classList.add("rounded-md", "px-2", "py-1", "min-w-20", "border", "border-zinc-400", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none");
    var submit1 = document.createElement("button");
    submit1.textContent = "Enregistrer";
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white", "transition-all");
    subDiv.appendChild(input1);
    subDiv.appendChild(submit1);
    submit1.addEventListener("click", function () {
        var newUsername = input1.value.trim();
        if (newUsername.length < 4 && newUsername.length > 24) {
            alert("Le pseudonyme doit contenir au moins 4 caractères.");
            return;
        }
        fetch("../utils/update_profile.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ username: newUsername }),
            credentials: "same-origin",
        })
            .then(function (response) { return response.json(); })
            .then(function (data) {
            if (data.success) {
                alert("Nom d'utilisateur mis à jour !");
                location.reload();
            }
            else {
                alert(data.message);
            }
        })
            .catch(function (error) { return console.error("Erreur:", error); });
    });
    profileTitle.textContent = "Pseudonyme";
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text1);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text2);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text3);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text4);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(subDiv);
});
passwordButton === null || passwordButton === void 0 ? void 0 : passwordButton.addEventListener("click", function () {
    profileContainer.innerHTML = "";
    var text1 = document.createElement("p");
    text1.textContent = "Ici vous pouvez modifier votre Mot de passe. Attention, votre nouveau mot de passe doit respecter ces critères:";
    var text2 = document.createElement("p");
    text2.textContent = "- Contenir au moins 1 caractère spécial";
    var text3 = document.createElement("p");
    text3.textContent = "- Contenir au moins 1 chiffre";
    var text4 = document.createElement("p");
    text4.textContent = "- Contenir au moins 8 caractères";
    var text5 = document.createElement("p");
    text5.classList.add("font-bold", "mt-6");
    text5.textContent = "Confirmation:";
    var text6 = document.createElement("p");
    text6.classList.add("font-bold", "mt-6");
    text6.textContent = "Nouveau mot de passe:";
    var subDiv = document.createElement("div");
    subDiv.classList.add("gap-x-2", "flex", "mt-2");
    var input1 = document.createElement("input");
    input1.placeholder = "Nouveau mdp...";
    input1.type = "password";
    input1.classList.add("rounded-md", "px-2", "py-1", "w-[219px]", "border", "border-zinc-400", "mt-2", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none");
    var input2 = document.createElement("input");
    input2.placeholder = "Confirmation mdp...";
    input2.type = "password";
    input2.classList.add("rounded-md", "px-2", "py-1", "min-w-20", "border", "border-zinc-400", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none");
    var submit1 = document.createElement("button");
    submit1.textContent = "Enregistrer";
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white", "transition-all");
    subDiv.appendChild(input2);
    subDiv.appendChild(submit1);
    submit1.addEventListener("click", function () {
        if (input1.value === input2.value) {
            var newPassword = input1.value.trim();
            fetch("../utils/update_profile.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ password_hash: newPassword }),
                credentials: "same-origin",
            })
                .then(function (response) { return response.json(); })
                .then(function (data) {
                if (data.success) {
                    alert("Mot de passe mis à jour !");
                    location.reload();
                }
                else {
                    alert(data.message);
                }
            })
                .catch(function (error) { return console.error("Erreur:", error); });
        }
        else {
            alert("Les mots de passe ne sont pas identiques.");
        }
    });
    profileTitle.textContent = "Mot de passe";
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text1);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text2);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text3);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text4);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text6);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(input1);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text5);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(subDiv);
});
mailButton === null || mailButton === void 0 ? void 0 : mailButton.addEventListener("click", function () {
    profileContainer.innerHTML = "";
    var text1 = document.createElement("p");
    text1.textContent = "Ici vous pouvez modifier votre Mail:";
    var subDiv = document.createElement("div");
    subDiv.classList.add("gap-x-2", "flex", "mt-6");
    var input1 = document.createElement("input");
    input1.placeholder = "Nouveau mail:";
    input1.classList.add("rounded-md", "px-2", "py-1", "min-w-20", "border", "border-zinc-400", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none");
    var submit1 = document.createElement("button");
    submit1.textContent = "Enregistrer";
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white", "transition-all");
    subDiv.appendChild(input1);
    subDiv.appendChild(submit1);
    submit1.addEventListener("click", function () {
        var newEmail = input1.value.trim();
        fetch("../utils/update_profile.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ email: newEmail }),
            credentials: "same-origin",
        })
            .then(function (response) { return response.json(); })
            .then(function (data) {
            if (data.success) {
                alert("Email mis à jour !");
                location.reload();
            }
            else {
                alert(data.message);
            }
        })
            .catch(function (error) { return console.error("Erreur:", error); });
    });
    profileTitle.textContent = "Mail";
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text1);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(subDiv);
});
ppButton === null || ppButton === void 0 ? void 0 : ppButton.addEventListener("click", function () {
    profileContainer.innerHTML = "";
    var text1 = document.createElement("p");
    text1.textContent = "Ici vous pouvez modifier votre photo de profil:";
    var subDiv = document.createElement("div");
    subDiv.classList.add("gap-x-2", "flex", "mt-6");
    var input1 = document.createElement("input");
    input1.placeholder = "Nouvelle url...";
    input1.classList.add("rounded-md", "px-2", "py-1", "min-w-20", "border", "border-zinc-400", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none");
    var submit1 = document.createElement("button");
    submit1.textContent = "Enregistrer";
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white", "transition-all");
    subDiv.appendChild(input1);
    subDiv.appendChild(submit1);
    submit1.addEventListener("click", function () {
        var newPP = input1.value.trim();
        fetch("../utils/update_profile.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ profile_picture: newPP }),
            credentials: "same-origin",
        })
            .then(function (response) { return response.json(); })
            .then(function (data) {
            if (data.success) {
                alert("Photo de profil mis à jour !");
                location.reload();
            }
            else {
                alert(data.message);
            }
        })
            .catch(function (error) { return console.error("Erreur:", error); });
    });
    profileTitle.textContent = "Photo de profil";
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(text1);
    profileContainer === null || profileContainer === void 0 ? void 0 : profileContainer.appendChild(subDiv);
});
logoutButton === null || logoutButton === void 0 ? void 0 : logoutButton.addEventListener("click", function () {
    fetch('../utils/logout.php', {
        method: 'GET',
        credentials: 'same-origin',
    })
        .then(function (response) {
        if (response.ok) {
            window.location.href = "../index.php";
        }
    })
        .catch(function (error) {
        console.error('Erreur de déconnexion:', error);
    });
});
// Book Part
var bookContainer = document.querySelector('.bookContainer');
var searchInput = document.querySelector('.searchInput');
if (bookContainer) {
    fetchBooks();
    searchInput === null || searchInput === void 0 ? void 0 : searchInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            fetchBooks(searchInput === null || searchInput === void 0 ? void 0 : searchInput.value);
        }
    });
}
function fetchBooks(input) {
    if (input === void 0) { input = "Tintin"; }
    var url = "https://www.googleapis.com/books/v1/volumes?q=intitle:".concat(input, "&key=AIzaSyAIpFFILMeSTegVWB5jvw-f8VYPDHdz5zA");
    fetch(url)
        .then(function (response) { return response.json(); })
        .then(function (data) { displayBooks(data.items); })
        .catch(function (error) { return console.log(error); });
}
function displayBooks(books) {
    bookContainer.innerHTML = "";
    books.forEach(function (book) {
        var _a, _b;
        var bookTitle = document.createElement('p');
        bookTitle.textContent = book.volumeInfo.title;
        bookTitle.classList.add("font-bold", "text-xl", "truncate", "max-w-full", "underline");
        var bookAuthor = document.createElement('p');
        bookAuthor.textContent = ((_a = book.volumeInfo.authors) === null || _a === void 0 ? void 0 : _a.join(', ')) || "Aucun auteur";
        bookAuthor.classList.add("max-w-full", "truncate");
        var coverDiv = document.createElement('div');
        coverDiv.classList.add("w-56", "h-64");
        var bookCover = document.createElement('img');
        bookCover.src = ((_b = book.volumeInfo.imageLinks) === null || _b === void 0 ? void 0 : _b.thumbnail) || "https://via.placeholder.com/150";
        bookCover.classList.add('w-full', "h-full", 'object-cover');
        var favoritButton = document.createElement("p");
        favoritButton.textContent = "Ajouter aux favoris";
        favoritButton.classList.add("text-white", "px-4", "py-2", "rounded-md", "bg-sky-600", "hover:bg-sky-700", "transition-all", "mt-2", "cursor-pointer");
        var bookDiv = document.createElement('div');
        bookDiv.classList.add("flex-col", "flex", "gap-y-3", "justify-center", "items-center", "p-4", "w-96", "h-[450px]", "border", "rounded-lg", "border-zinc-400", "shadow-xl", "bg-gradient-to-br", "from-white", "to-zinc-100", "hover:scale-105", "transition-all", "hover:shadow-2xl");
        favoritButton.addEventListener("click", function () {
            fetch("../utils/update_favorites.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ addFavorite: book.id }),
                credentials: "same-origin",
            })
                .then(function (response) { return response.json(); })
                .then(function (data) {
                if (data.success) {
                    favoritButton.classList.remove("cursor-pointer", "bg-sky-600", "hover:bg-sky-700");
                    favoritButton.classList.add("pointer-events-none", "bg-lime-500", "hover:bg-lime-600");
                    favoritButton.textContent = data.message;
                }
                else {
                    favoritButton.classList.remove("cursor-pointer", "bg-sky-600", "hover:bg-sky-700");
                    favoritButton.classList.add("pointer-events-none", "bg-red-500", "hover:bg-red-600");
                    favoritButton.textContent = data.message;
                }
            })
                .catch(function (error) { return console.error("Erreur:", error); });
        });
        coverDiv.appendChild(bookCover);
        bookDiv.appendChild(bookTitle);
        bookDiv.appendChild(coverDiv);
        bookDiv.appendChild(bookAuthor);
        bookDiv.appendChild(favoritButton);
        bookContainer.appendChild(bookDiv);
    });
}
// Favorites Part
var favoritesContainer = document.querySelector(".favoritesContainer");
if (favoritesContainer) {
    callFavorites();
}
function callFavorites() {
    favoritesContainer.innerHTML = "";
    // récupérer les books
    fetch("../utils/update_favorites.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ requestFavorites: true }),
        credentials: "same-origin",
    })
        .then(function (response) { return response.json(); })
        .then(function (data) {
        if (data.success) {
            fetchBookDetails(data.books);
        }
        else {
            var warningTitle = document.createElement('h1');
            warningTitle.textContent = "Vous n'avez aucun favoris";
            warningTitle.classList.add("font-bold", "text-3xl");
            var subTitle = document.createElement('p');
            subTitle.textContent = "Retourner dans 'Bibliothèque' pour commencer à ajouter des livres. 😀";
            subTitle.classList.add("text-xl");
            var subDiv = document.createElement('div');
            subDiv.classList.add("flex", "flex-col", "gap-y-3", "justify-center", "items-center", "mx-auto", "text-center", "col-span-3");
            subDiv.appendChild(warningTitle);
            subDiv.appendChild(subTitle);
            favoritesContainer.appendChild(subDiv);
        }
    })
        .catch(function (error) { return console.error("Erreur lors de la récupération des favoris:", error); });
}
function fetchBookDetails(bookIds) {
    bookIds.map(function (bookId) {
        return fetch("https://www.googleapis.com/books/v1/volumes/".concat(bookId))
            .then(function (response) { return response.json(); })
            .then(function (book) {
            var _a, _b;
            var bookTitle = document.createElement('p');
            bookTitle.textContent = book.volumeInfo.title;
            bookTitle.classList.add("font-bold", "text-xl", "truncate", "max-w-full", "underline");
            var bookAuthor = document.createElement('p');
            bookAuthor.textContent = ((_a = book.volumeInfo.authors) === null || _a === void 0 ? void 0 : _a.join(', ')) || "Aucun auteur";
            bookAuthor.classList.add("max-w-full", "truncate");
            var coverDiv = document.createElement('div');
            coverDiv.classList.add("w-56", "h-64");
            var bookCover = document.createElement('img');
            bookCover.src = ((_b = book.volumeInfo.imageLinks) === null || _b === void 0 ? void 0 : _b.thumbnail) || "https://via.placeholder.com/150";
            bookCover.classList.add('w-full', "h-full", 'object-cover');
            var favoritButton = document.createElement("p");
            favoritButton.textContent = "Enlever des favoris";
            favoritButton.classList.add("text-white", "px-4", "py-2", "rounded-md", "bg-sky-600", "hover:bg-sky-700", "transition-all", "mt-2", "cursor-pointer");
            var bookDiv = document.createElement('div');
            bookDiv.classList.add("flex-col", "flex", "gap-y-3", "justify-center", "items-center", "p-4", "w-96", "h-[450px]", "border", "rounded-lg", "border-zinc-400", "shadow-xl", "bg-gradient-to-br", "from-white", "to-zinc-100", "hover:scale-105", "transition-all", "hover:shadow-2xl");
            favoritButton.addEventListener("click", function () {
                fetch("../utils/update_favorites.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ removeFavorite: book.id }),
                    credentials: "same-origin",
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                    if (data.success) {
                        location.reload();
                    }
                    else {
                        alert(data.message);
                    }
                })
                    .catch(function (error) { return console.error("Erreur:", error); });
            });
            coverDiv.appendChild(bookCover);
            bookDiv.appendChild(bookTitle);
            bookDiv.appendChild(coverDiv);
            bookDiv.appendChild(bookAuthor);
            bookDiv.appendChild(favoritButton);
            favoritesContainer.appendChild(bookDiv);
        })
            .catch(function (error) { return console.log(error); });
    });
}
