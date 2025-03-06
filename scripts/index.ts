// const apikey = "AIzaSyAIpFFILMeSTegVWB5jvw-f8VYPDHdz5zA"

// let url = `https://www.googleapis.com/books/v1/volumes?q=intitle:${input.value}&key=${apiKey}`

// Partie pour les options de profil
const logoutButton: HTMLParagraphElement | null = document.getElementById("logout")
const profileButton: HTMLParagraphElement | null = document.querySelector(".profile-button")
const passwordButton: HTMLParagraphElement | null = document.querySelector(".password-button")
const mailbutton: HTMLParagraphElement | null = document.querySelector(".mail-button")
const ppButton: HTMLParagraphElement | null = document.querySelector(".pp-button")
const profileTitle: HTMLParagraphElement | null = document.querySelector(".profile-title")
const profileContainer: HTMLDivElement | null = document.querySelector(".profile-container")

profileButton?.addEventListener("click", () => {
    profileContainer!.innerHTML = ""
    let text1: HTMLParagraphElement = document.createElement("p")
    text1.textContent = "Ici vous pouvez modifier votre Pseudonyme. \n Attention le nom d'utilisateur doit: \n- Ne pas contenir de mot choquant\n- Contenir au moins 4 caractères"
    let subDiv: HTMLDivElement = document.createElement("div")
    subDiv.classList.add("gap-x-2", "flex")
    let input1: HTMLInputElement = document.createElement("input")
    input1.placeholder = "Nouveau pseudonyme"
    input1.classList.add("rounded-md", "px-2", "py-1", "min-w-20")
    let submit1: HTMLButtonElement = document.createElement("button")
    submit1.textContent = "Enregistrer"
    submit1.classList.add("rounded-md", "px-2", "py-1", "bg-sky-600", "hover:bg-sky-700", "text-white")
    subDiv.appendChild(input1)
    subDiv.appendChild(submit1)
    profileContainer?.appendChild(text1)
    profileContainer?.appendChild(subDiv)
})

logoutButton?.addEventListener("click", () => {
    fetch('../utils/logout.php', {
        method: 'GET',
        credentials: 'same-origin', // Assure que la session est envoyée avec la requête
    })
    .then(response => {
        if (response.ok) {
            window.location.href = "../index.php"; // Redirige vers la page d'accueil après la déconnexion
        }
    })
    .catch(error => {
        console.error('Erreur de déconnexion:', error);
    });
})

