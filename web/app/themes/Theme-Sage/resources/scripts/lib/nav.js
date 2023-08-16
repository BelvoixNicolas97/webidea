export default class Navigation {
    static get ID_ELEMENT () {return "sectionNavigation";}

    #NAVIGATION_ELEMENT;
    #BUTTON_ELEMENT;

    constructor (element) {
        let errorName = "NAVIGATION CONSTRUCTOR";

        // Vérification
            if (element.id !== Navigation.ID_ELEMENT) {
                let error = new Error(`L'élément recus n'a pas l'id "${Navigation.ID_ELEMENT}"`);
                error.name = errorName;

                throw error;
            }

        // Récupération des données
            this.#NAVIGATION_ELEMENT = element;
            this.#BUTTON_ELEMENT = element.querySelector("#burger");

        // Initialisation de l'etat de la bar de navigation
            this.onScroll();

        // Lancement des écouteur d'événement
            window.addEventListener("scroll", (event) => {
                this.onScroll();
            });
            this.#BUTTON_ELEMENT.addEventListener("click", (event) => {
                this.onOffMenu();
            });
            this.#NAVIGATION_ELEMENT.addEventListener("click", (event) => {
                this.clicInScreenBlack(event);
            });
    }

    onScroll() {
        let element = this.#NAVIGATION_ELEMENT;

        if (window.scrollY == 0 && !element.classList.contains("oppen")) {
            element.classList.remove("white");
        }else if (window.scrollY > 0 && !element.classList.contains("white")) {
            element.classList.add("white");
        }
    }

    onOffMenu () {
        let element = this.#NAVIGATION_ELEMENT;

        if (!element.classList.contains("oppen")) {
            if (!element.classList.contains("white")) {
                element.classList.add("white");
                setTimeout(() => {
                    element.classList.add("oppen");
                }, 50);
            }else {
                element.classList.add("oppen");
            }
        }else {
            element.classList.remove("oppen");
            setTimeout(() => {
                if (window.scrollY === 0) {
                    element.classList.remove("white");
                }
            }, 100);
        }
    }

    clicInScreenBlack (event) {
        if (event.target.id == Navigation.ID_ELEMENT && event.target.classList.contains("oppen")) {
            this.onOffMenu();
        }
    }
};