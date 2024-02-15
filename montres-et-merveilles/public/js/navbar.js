// get the logo in the dom
let logo = document.getElementById("logo");
let swissLogo = document.getElementById("swiss-logo");

// get the navbar and the header in the dom
let navbar = document.getElementById("navbar");
let header = navbar.parentElement;

// variables states initialization
let isTop = true;
let isVisible = true;
let isWhite = false;

// variable used to know if the user is scrolling up or down
let isGoUp = true;

// variable used to know if the navbar is in transition
let inTransition = false;

function changeColorOfLogo() {
    // change the color of logo
    let cachedSrc = logo.src;
    logo.src = logo.dataset.altSrc;
    logo.dataset.altSrc = cachedSrc;

    let cachedSwissSrc = swissLogo.src;
    swissLogo.src = swissLogo.dataset.altSrc;
    swissLogo.dataset.altSrc = cachedSwissSrc;
}

// don't make animation on other pages
if (window.location.pathname !== "/") {
    header.classList.add("notAccueill");
} else {
    navbar.classList.add("whiteText");
    changeColorOfLogo();

    // this event listener is used to detect if the user is scrolling up or down for showing or hiding the navbar
    window.addEventListener("scroll", (e) => {

        if (window.location.pathname !== "/") {
            return;
        }

        if (inTransition) {
            return;
        }

        if (window.scrollY <= 0) {
            navbar.classList.remove("scrolledDown");
            navbar.classList.remove("scrolledUp");

            navbar.classList.add("whiteText");

            changeColorOfLogo();
            if (!isTop) {
                isTop = true;
            }
            return;
        }

        if (!isGoUp && window.scrollY < previousScrollY) {
        // La page est en train de remonter
        isGoUp = true;

        navbar.classList.remove("scrolledDown");
        navbar.classList.add("scrolledUp");

        navbar.classList.remove("whiteText");

        } else if (isGoUp && window.scrollY > previousScrollY) {
        // La page est en train de descendre
        isGoUp = false;

        navbar.classList.remove("scrolledUp");
        navbar.classList.add("scrolledDown");
        
        }

        previousScrollY = window.scrollY;
    });

    navbar.addEventListener("transitionstart", (e) => {
        if (e.propertyName === "transform") {
            inTransition = true;
        }
    });
    
    navbar.addEventListener("transitionend", (e) => {
        if (e.propertyName === "transform") {
            if (!isGoUp && isVisible && isTop) {
    
                if (isTop) {
                    isTop = false;
                }
    
                changeColorOfLogo();
                isVisible = false;
            } else if (!isVisible) {
                isVisible = true;
            }
    
            inTransition = false;
        }
    });

}

let previousScrollY = window.scrollY;