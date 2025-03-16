// const apikey = "AIzaSyAIpFFILMeSTegVWB5jvw-f8VYPDHdz5zA"

// let url = `https://www.googleapis.com/books/v1/volumes?q=intitle:${input.value}&key=${apiKey}`

// Partie pour les options de profil
let logoutButton: HTMLElement | null = document.getElementById("logout")
let profileButton: HTMLParagraphElement | null = document.querySelector(".profile-button")
let passwordButton: HTMLParagraphElement | null = document.querySelector(".password-button")
let mailButton: HTMLParagraphElement | null = document.querySelector(".mail-button")
let ppButton: HTMLParagraphElement | null = document.querySelector(".pp-button")
let profileTitle: HTMLParagraphElement | null = document.querySelector(".profile-title")
let profileContainer: HTMLDivElement | null = document.querySelector(".profile-container")

profileButton?.addEventListener("click", () => {
    profileContainer!.innerHTML = ""
    let text1: HTMLParagraphElement = document.createElement("p")
    text1.textContent = "Ici vous pouvez modifier votre Pseudonyme. Attention le nom d'utilisateur doit:"
    let text2: HTMLParagraphElement = document.createElement("p")
    text2.textContent = "- Ne pas contenir de mot choquant"
    let text3: HTMLParagraphElement = document.createElement("p")
    text3.textContent = "- Contenir doit être compris entre 4 et 24 caractères"
    let text4: HTMLParagraphElement = document.createElement("p")
    text4.textContent = "- Contenir que des minuscules, majuscules, chiffres ou un/des underscores"
    let subDiv: HTMLDivElement = document.createElement("div")
    subDiv.classList.add("gap-x-2", "flex", "mt-6")
    let input1: HTMLInputElement = document.createElement("input")
    input1.placeholder = "Nouveau pseudonyme"
    input1.classList.add("rounded-md", "px-2", "py-1", "min-w-20", "border", "border-zinc-400", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none")
    let submit1: HTMLButtonElement = document.createElement("button")
    submit1.textContent = "Enregistrer"
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white", "transition-all")
    subDiv.appendChild(input1)
    subDiv.appendChild(submit1)

    submit1.addEventListener("click", () => {
        const newUsername = input1.value.trim();
    
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
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Nom d'utilisateur mis à jour !");
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Erreur:", error));
    });

    profileTitle!.textContent = "Pseudonyme"
    profileContainer?.appendChild(text1)
    profileContainer?.appendChild(text2)
    profileContainer?.appendChild(text3)
    profileContainer?.appendChild(text4)
    profileContainer?.appendChild(subDiv)
})

passwordButton?.addEventListener("click", () => {
    profileContainer!.innerHTML = ""
    let text1: HTMLParagraphElement = document.createElement("p")
    text1.textContent = "Ici vous pouvez modifier votre Mot de passe. Attention, votre nouveau mot de passe doit respecter ces critères:"
    let text2: HTMLParagraphElement = document.createElement("p")
    text2.textContent = "- Contenir au moins 1 caractère spécial"
    let text3: HTMLParagraphElement = document.createElement("p")
    text3.textContent = "- Contenir au moins 1 chiffre"
    let text4: HTMLParagraphElement = document.createElement("p")
    text4.textContent = "- Contenir au moins 8 caractères"
    var text5 = document.createElement("p");
    text5.classList.add("font-bold", "mt-6")
    text5.textContent = "Confirmation:";
    var text6 = document.createElement("p");
    text6.classList.add("font-bold", "mt-6")
    text6.textContent = "Nouveau mot de passe:";
    let subDiv: HTMLDivElement = document.createElement("div")
    subDiv.classList.add("gap-x-2", "flex", "mt-2")
    let input1: HTMLInputElement = document.createElement("input")
    input1.placeholder = "Nouveau mdp..."
    input1.type = "password"
    input1.classList.add("rounded-md", "px-2", "py-1", "w-[219px]", "border", "border-zinc-400", "mt-2", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none")
    let input2: HTMLInputElement = document.createElement("input")
    input2.placeholder = "Confirmation mdp..."
    input2.type = "password"
    input2.classList.add("rounded-md", "px-2", "py-1", "min-w-20", "border", "border-zinc-400", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none")
    let submit1: HTMLButtonElement = document.createElement("button")
    submit1.textContent = "Enregistrer"
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white", "transition-all")
    subDiv.appendChild(input2)
    subDiv.appendChild(submit1)

    submit1.addEventListener("click", () => {

        if (input1.value === input2.value) {
            const newPassword = input1.value.trim();
            fetch("../utils/update_profile.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ password_hash: newPassword }),
                credentials: "same-origin",
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Mot de passe mis à jour !");
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Erreur:", error));
        } else {
            alert("Les mots de passe ne sont pas identiques.");
        }
    });

    profileTitle!.textContent = "Mot de passe"
    profileContainer?.appendChild(text1)
    profileContainer?.appendChild(text2)
    profileContainer?.appendChild(text3)
    profileContainer?.appendChild(text4)
    profileContainer?.appendChild(text6)
    profileContainer?.appendChild(input1)
    profileContainer?.appendChild(text5)
    profileContainer?.appendChild(subDiv)
})

mailButton?.addEventListener("click", () => {
    profileContainer!.innerHTML = ""
    let text1: HTMLParagraphElement = document.createElement("p")
    text1.textContent = "Ici vous pouvez modifier votre Mail:"
    let subDiv: HTMLDivElement = document.createElement("div")
    subDiv.classList.add("gap-x-2", "flex", "mt-6")
    let input1: HTMLInputElement = document.createElement("input")
    input1.placeholder = "Nouveau mail:"
    input1.classList.add("rounded-md", "px-2", "py-1", "min-w-20", "border", "border-zinc-400", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none")
    let submit1: HTMLButtonElement = document.createElement("button")
    submit1.textContent = "Enregistrer"
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white", "transition-all")
    subDiv.appendChild(input1)
    subDiv.appendChild(submit1)

    submit1.addEventListener("click", () => {
        const newEmail = input1.value.trim();
    
        fetch("../utils/update_profile.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ email: newEmail }),
            credentials: "same-origin",
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Email mis à jour !");
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Erreur:", error));
    });

    profileTitle!.textContent = "Mail"
    profileContainer?.appendChild(text1)
    profileContainer?.appendChild(subDiv)
})

ppButton?.addEventListener("click", () => {
    profileContainer!.innerHTML = ""
    let text1: HTMLParagraphElement = document.createElement("p")
    text1.textContent = "Ici vous pouvez modifier votre photo de profil:"
    let subDiv: HTMLDivElement = document.createElement("div")
    subDiv.classList.add("gap-x-2", "flex", "mt-6")
    let input1: HTMLInputElement = document.createElement("input")
    input1.placeholder = "Nouvelle url..."
    input1.classList.add("rounded-md", "px-2", "py-1", "min-w-20", "border", "border-zinc-400", "transition-all", "hover:border-zinc-700", "focus:border-zinc-900", "outline-none")
    let submit1: HTMLButtonElement = document.createElement("button")
    submit1.textContent = "Enregistrer"
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white", "transition-all")
    subDiv.appendChild(input1)
    subDiv.appendChild(submit1)

    submit1.addEventListener("click", () => {
        const newPP = input1.value.trim();
        fetch("../utils/update_profile.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ profile_picture: newPP }),
            credentials: "same-origin",
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Photo de profil mis à jour !");
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Erreur:", error));
    });

    profileTitle!.textContent = "Photo de profil"
    profileContainer?.appendChild(text1)
    profileContainer?.appendChild(subDiv)
})

logoutButton?.addEventListener("click", () => {
    fetch('../utils/logout.php', {
        method: 'GET',
        credentials: 'same-origin',
    })
    .then(response => {
        if (response.ok) {
            window.location.href = "../index.php";
        }
    })
    .catch(error => {
        console.error('Erreur de déconnexion:', error);
    });
})

// Book Part

let bookContainer: HTMLDivElement | null = document.querySelector('.bookContainer');
let searchInput: HTMLInputElement | null = document.querySelector('.searchInput');

if (bookContainer) {
    fetchBooks()
    searchInput?.addEventListener("keypress", (event) => {
        if (event.key === "Enter") {
            fetchBooks(searchInput?.value);
        }
    })
}

function fetchBooks(input: String = "Tintin") {
     let url = `https://www.googleapis.com/books/v1/volumes?q=intitle:${input}&key=AIzaSyAIpFFILMeSTegVWB5jvw-f8VYPDHdz5zA`
     fetch(url)
     .then(response => response.json())
     .then(data => {displayBooks(data.items)})
     .catch(error => console.log(error));
}

function displayBooks(books: any[]) {
    bookContainer!.innerHTML = "";
    books.forEach(book => {
        let bookTitle: HTMLParagraphElement = document.createElement('p');
        bookTitle.textContent = book.volumeInfo.title;
        bookTitle.classList.add("font-bold", "text-xl", "truncate", "max-w-full", "underline")
        let bookAuthor: HTMLParagraphElement = document.createElement('p');
        bookAuthor.textContent = book.volumeInfo.authors?.join(', ') || "Aucun auteur";
        bookAuthor.classList.add("max-w-full", "truncate",)
        let coverDiv: HTMLDivElement = document.createElement('div');
        coverDiv.classList.add("w-56", "h-64");
        let bookCover: HTMLImageElement = document.createElement('img');
        bookCover.src = book.volumeInfo.imageLinks?.thumbnail || "https://via.placeholder.com/150";
        bookCover.classList.add('w-full', "h-full", 'object-cover');
        let favoritButton: HTMLParagraphElement = document.createElement("p")
        favoritButton.textContent = "Ajouter aux favoris";
        favoritButton.classList.add("text-white", "px-4", "py-2", "rounded-md", "bg-sky-600", "hover:bg-sky-700", "transition-all", "mt-2", "cursor-pointer");
        let bookDiv: HTMLDivElement = document.createElement('div');
        bookDiv.classList.add("flex-col", "flex", "gap-y-3", "justify-center", "items-center", "p-4", "w-96", "h-[450px]", "border" ,"rounded-lg", "border-zinc-400", "shadow-xl", "bg-gradient-to-br", "from-white", "to-zinc-100", "hover:scale-105", "transition-all", "hover:shadow-2xl")
        
        favoritButton.addEventListener("click", () => {
            fetch("../utils/update_favorites.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ addFavorite: book.id }),
                credentials: "same-origin",
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    favoritButton.classList.remove("cursor-pointer", "bg-sky-600", "hover:bg-sky-700")
                    favoritButton.classList.add("pointer-events-none", "bg-lime-500", "hover:bg-lime-600")
                    favoritButton.textContent = data.message
                } else {
                    favoritButton.classList.remove("cursor-pointer", "bg-sky-600", "hover:bg-sky-700")
                    favoritButton.classList.add("pointer-events-none", "bg-red-500", "hover:bg-red-600")
                    favoritButton.textContent = data.message
                }
            })
            .catch(error => console.error("Erreur:", error));
        })
        coverDiv.appendChild(bookCover);
        bookDiv.appendChild(bookTitle);
        bookDiv.appendChild(coverDiv);
        bookDiv.appendChild(bookAuthor);
        bookDiv.appendChild(favoritButton);
        bookContainer!.appendChild(bookDiv);
    })
}


// Favorites Part
let favoritesContainer = document.querySelector(".favoritesContainer")

if (favoritesContainer) {
    callFavorites();
}

function callFavorites() {
    favoritesContainer!.innerHTML = "";

    // récupérer les books
    fetch("../utils/update_favorites.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ requestFavorites: true }),
        credentials: "same-origin",
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchBookDetails(data.books);
        } else {
            let warningTitle: HTMLParagraphElement = document.createElement('h1');
            warningTitle.textContent = "Vous n'avez aucun favoris";
            warningTitle.classList.add("font-bold", "text-3xl")
            let subTitle: HTMLParagraphElement = document.createElement('p');
            subTitle.textContent = "Retourner dans 'Bibliothèque' pour commencer à ajouter des livres. 😀";
            subTitle.classList.add("text-xl")
            let subDiv: HTMLDivElement = document.createElement('div')
            subDiv.classList.add("flex", "flex-col", "gap-y-3", "justify-center", "items-center", "mx-auto", "text-center", "col-span-3")
            subDiv.appendChild(warningTitle);
            subDiv.appendChild(subTitle);
            favoritesContainer!.appendChild(subDiv);
        }
    })
    .catch(error => console.error("Erreur lors de la récupération des favoris:", error));
}

function fetchBookDetails(bookIds) {
    bookIds.map(bookId => 
        fetch(`https://www.googleapis.com/books/v1/volumes/${bookId}`)
        .then(response => response.json())
        .then(book => {
            let bookTitle: HTMLParagraphElement = document.createElement('p');
            bookTitle.textContent = book.volumeInfo.title;
            bookTitle.classList.add("font-bold", "text-xl", "truncate", "max-w-full", "underline")
            let bookAuthor: HTMLParagraphElement = document.createElement('p');
            bookAuthor.textContent = book.volumeInfo.authors?.join(', ') || "Aucun auteur";
            bookAuthor.classList.add("max-w-full", "truncate",)
            let coverDiv: HTMLDivElement = document.createElement('div');
            coverDiv.classList.add("w-56", "h-64");
            let bookCover: HTMLImageElement = document.createElement('img');
            bookCover.src = book.volumeInfo.imageLinks?.thumbnail || "https://via.placeholder.com/150";
            bookCover.classList.add('w-full', "h-full", 'object-cover');
            let favoritButton: HTMLParagraphElement = document.createElement("p")
            favoritButton.textContent = "Enlever des favoris";
            favoritButton.classList.add("text-white", "px-4", "py-2", "rounded-md", "bg-sky-600", "hover:bg-sky-700", "transition-all", "mt-2", "cursor-pointer");
            let bookDiv: HTMLDivElement = document.createElement('div');
            bookDiv.classList.add("flex-col", "flex", "gap-y-3", "justify-center", "items-center", "p-4", "w-96", "h-[450px]", "border" ,"rounded-lg", "border-zinc-400", "shadow-xl", "bg-gradient-to-br", "from-white", "to-zinc-100", "hover:scale-105", "transition-all", "hover:shadow-2xl")
            
            favoritButton.addEventListener("click", () => {
                fetch("../utils/update_favorites.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ removeFavorite: book.id }),
                    credentials: "same-origin",
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload()
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Erreur:", error));
            })
            coverDiv.appendChild(bookCover);
            bookDiv.appendChild(bookTitle);
            bookDiv.appendChild(coverDiv);
            bookDiv.appendChild(bookAuthor);
            bookDiv.appendChild(favoritButton);
            favoritesContainer!.appendChild(bookDiv);
        })
        .catch(error => console.log(error))
    );
}
