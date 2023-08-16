export default class ListArticles {
    static get ID_ELEMENT () {return "sectionListArticles";}

    #NB_ARTICLES = 0;
    #ATICLES_NOW = 0;

    #BUTTON_NEXT;
    #BUTTON_PRE;
    #LIST_ARTICLES;

    #VIEWPORT = {
        mobile: 480,
        tablet: 768,
        laptop: 1024
    };
    #VIEWPORT_NOW;

    constructor (element) {
        let errorName = "LIST ARTICLES CONSTRUCTOR";

        // Vérification
            if (element.id !== ListArticles.ID_ELEMENT) {
                let error = new Error(`L'élément recus n'a pas l'id "${ListArticles.ID_ELEMENT}"`);
                error.name = errorName;

                throw error;
            }

        // Récupération des données
            this.#LIST_ARTICLES = element.querySelector(".articles");
            this.#NB_ARTICLES = element.querySelectorAll(".articles .article").length;
            this.#BUTTON_NEXT = element.querySelector("#next");
            this.#BUTTON_PRE = element.querySelector("#pre");
            this.#VIEWPORT_NOW = this.getTypeViewport();

        // Selection du premier article
            this.selectArticle(1);

        // Lancement des ecouteur d'evenemnt
            this.#BUTTON_PRE.addEventListener("click", () => {
                let select = this.#ATICLES_NOW - 1;

                this.selectArticle(select);
            });
            this.#BUTTON_NEXT.addEventListener("click", () => {
                let select = this.#ATICLES_NOW + 1;

                this.selectArticle(select);
            })
            window.addEventListener("resize", () => {
                let articleNow = this.#ATICLES_NOW;
                let typeViewportOld = this.#VIEWPORT_NOW;
                let typeViewportNow = this.getTypeViewport();

                if (typeViewportOld != typeViewportNow) {
                    this.#VIEWPORT_NOW = typeViewportNow;

                    this.selectArticle(articleNow);
                }
            });
    }

    selectArticle (articleNb) {
        let listArticles = this.#LIST_ARTICLES;
        let buttons = {
            next: this.#BUTTON_NEXT,
            prev: this.#BUTTON_PRE
        };
        let nbArticles = this.#NB_ARTICLES;
        let articleNow = this.#ATICLES_NOW;
        let viewport = this.#VIEWPORT;
        let viewportX = window.innerWidth;
        let left;

        // Vérification
            if (articleNb > nbArticles || articleNb < 1) {
                console.warn(`La selection de l\'article ${articleNb}/${nbArticles} n'est pas valide !`);
            }else {
                // uptade article now
                    articleNow = articleNb;
                    this.#ATICLES_NOW = articleNow;

                // Calcule de la distance
                    if (viewportX <= viewport.mobile) {
                        left = `calc((77.86vw + 1.6rem) * -${articleNow-1})`;
                    }else if (viewportX <= viewport.tablet) {
                        left = `calc(((100% - 1.6rem ) / 2 + 1.6rem) * -${articleNow-1})`;
                    }else {
                        left = `calc(((100% - 2.8rem * 2) / 3 + 2.8rem) * -${articleNow-1})`;
                    }

                // update de la position
                    listArticles.style.left = left;
            }

            // Update button
                if (nbArticles <= 1) {
                    buttons.next.setAttribute("disabled", true);
                    buttons.prev.setAttribute("disabled", true);
                } else if (articleNow <= 1 && nbArticles > articleNow) {
                    buttons.prev.setAttribute("disabled", true);
                    buttons.next.removeAttribute("disabled");
                }else if (articleNow >= nbArticles) {
                    buttons.next.setAttribute("disabled", true);
                    buttons.prev.removeAttribute("disabled");
                }else {
                    buttons.next.removeAttribute("disabled");
                    buttons.prev.removeAttribute("disabled");
                }
    }

    getTypeViewport () {
        let viewport = this.#VIEWPORT;
        let viewportX = window.innerWidth;
        let typeViewport;

        if (viewportX <= viewport.mobile) {
            typeViewport = 1;
        }else if (viewportX <= viewport.tablet) {
            typeViewport = 2;
        }else if (viewportX <= viewport.laptop) {
            typeViewport = 3;
        }else {
            typeViewport = 4;
        }

        return typeViewport;
    }
};