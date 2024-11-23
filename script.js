const adjustLinks = () => {
    const isLocal = window.location.protocol === 'file:' || window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';
    const portfolioLinks = document.querySelectorAll('.portfolio-link');

    portfolioLinks.forEach(link => {
        if (isLocal) {
            // Jeśli lokalnie, ustawiamy linki na pelny adres
            link.href = "https://krystianbeduch.github.io/";
        }
    });
};

document.addEventListener('DOMContentLoaded', adjustLinks);

const toggleInput = () => {
    const teachersTogetherVal = document.getElementById("teachers_together_yes").checked;
    const teachersTgInput = document.getElementById("teachers_tg");
    if (teachersTogetherVal) {
        teachersTgInput.style.display = "block";
    }
    else {
        teachersTgInput.style.display = "none";
    }
};

