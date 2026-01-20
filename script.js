// Prosta logika przełączania widoków (SPA feel)
function showSection(sectionId) {
    const sections = ['landing', 'home', 'details'];
    
    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            if (id === sectionId) {
                if (id === 'landing') el.style.display = 'flex';
                else el.style.display = 'block';
            } else {
                el.style.display = 'none';
            }
        }
    });
    
    // Scroll to top
    window.scrollTo(0,0);
}

function toggleMenu() {
    const menu = document.getElementById('navMenu');
    menu.classList.toggle('active');
}

function scrollMovies(sliderContainer, distance) {
    const grid = sliderContainer.querySelector('.movies-grid');
    grid.scrollBy({ left: distance, behavior: 'smooth' });
}

function toggleFav(event, element) {
    event.stopPropagation(); // Zatrzymuje wejście w movie.html
    element.classList.toggle('active');
    
    // Logika dla zwykłego symbolu serca HTML
    if (element.classList.contains('active')) {
        element.innerHTML = '&#10084;'; // Pełne serce
    } else {
        element.innerHTML = '&#9825;'; // Puste serce
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Na start sprawdź url param
    const urlParams = new URLSearchParams(window.location.search);
    const section = urlParams.get('section');

    // Sprawdź czy jesteśmy na głównej strukturze SPA (index.html)
    if (document.getElementById('landing')) {
        if (section) {
            showSection(section);
        } else {
            // Sprawdź czy strona została wcześniej odwiedzona
            if (localStorage.getItem('visited')) {
                showSection('home');
            } else {
                showSection('landing');
                localStorage.setItem('visited', 'true');
            }
        }
    } else {
        // Dla podstrony movie.html standardowo 'details'
        showSection('details');
    }
});