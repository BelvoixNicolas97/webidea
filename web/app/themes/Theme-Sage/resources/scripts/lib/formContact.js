export default class FormContact {
    static get ID_ELEMENT () {return "formContact";}

    #FORM_ELEMENT;

    #URL_FORM = "#";
    #METHODE = "post";

    #INPUT = {
        Name: {
            element: null,
            valid: false
        },
        FirstName: {
            element: null,
            valid: false
        },
        Mail: {
            element: null,
            valid: false
        },
        Phone: {
            element: null,
            valid: false
        },
        Sujet: {
            element: null,
            content: null,
            placeholder: "Choisissez un sujet",
            valid: false
        },
        Txt: {
            element: null,
            valid: false
        },
        Consent: {
            element: null,
            valid: false
        }
    };

    #BUTTON_SUBMIT;

    constructor (element) {
        let errorName = "FORM CONTACT CONSTRUCTOR";

        // Vérification
            if (element.id !== FormContact.ID_ELEMENT) {
                let error = new Error(`L'élément recus n'a pas l'id "${FormContact.ID_ELEMENT}"`);
                error.name = errorName;

                throw error;
            }

        // Récupération des données
            this.#FORM_ELEMENT = element;

            this.#URL_FORM = (element.getAttribute("action") != null)? element.getAttribute("action") : this.#URL_FORM;
            this.#METHODE = (element.getAttribute("method") != null)? element.getAttribute("method") : this.#METHODE;

            this.#INPUT.Name.element = element.querySelector("#inputName input");
            this.#INPUT.FirstName.element = element.querySelector("#inputFirstName input");
            this.#INPUT.Mail.element = element.querySelector("#inputMail input");
            this.#INPUT.Phone.element = element.querySelector("#inputPhone input");
            this.#INPUT.Sujet.element = element.querySelectorAll("#inputSujet input");
            this.#INPUT.Sujet.content = element.querySelector("#inputSujet");
            this.#INPUT.Txt.element = element.querySelector("#inputTxt textarea");
            this.#INPUT.Consent.element = element.querySelector("#inputConsent input");

            this.#BUTTON_SUBMIT = element.querySelector("#inputSubmit button");

        // Init form
            this.resetForm();
            this.buttonDisabled(true);

        // Lancement des ecouteur d'evenemnt
            this.#FORM_ELEMENT.addEventListener("change", (event) => {
                let element = event.target;
                let name = element.getAttribute("name");

                switch (name) {
                    case "Name":
                        this.verifName();
                        break;

                    case "FirstName":
                        this.verifFirstName();
                        break;

                    case "Mail":
                        this.verifMail();
                        break;

                    case "Phone":
                        this.verifPhone();
                        break;

                    case "Sujet":
                        this.verifSujet();
                        break;

                    case "Txt":
                        this.verifTxt();
                        break;

                    case "Consent":
                        this.verifConsent();
                        break;
                
                    default:
                        console.warn(`L'input "${name}" n'est pas pris en compte par le formulaire de contact`);
                        console.warn(element);
                        break;
                }

                this.verif();
            });
            this.#FORM_ELEMENT.addEventListener("submit", (event) => {
                event.preventDefault();

                this.verifName();
                this.verifFirstName();
                this.verifMail();
                this.verifPhone();
                this.verifSujet();
                this.verifTxt();
                this.verifConsent();

                if (this.verif()) {
                    this.send();
                }
            });
    }

    buttonDisabled (bool) {
        let button = this.#BUTTON_SUBMIT;
        let listAttribute = button.getAttributeNames();

        if (!bool && listAttribute.includes("disabled")) {
            button.removeAttribute("disabled");
        }else if (bool && !listAttribute.includes("disabled")) {
            button.setAttribute("disabled", true);
        }
    }

    verifName () {
        let input = this.#INPUT.Name.element;
        let label = input.parentNode;
        let value = input.value;

        if (value.trim().length > 0) {
            this.#INPUT.Name.valid = true;
        }else {
            this.#INPUT.Name.valid = false;
        }

        if (this.#INPUT.Name.valid && label.classList.contains("error")) {
            label.classList.remove("error");
        }else if (!this.#INPUT.Name.valid && !label.classList.contains("error")) {
            label.classList.add("error");
        }
    }

    verifFirstName () {
        let input = this.#INPUT.FirstName.element;
        let label = input.parentNode;
        let value = input.value;

        if (value.trim().length > 0) {
            this.#INPUT.FirstName.valid = true;
        }else {
            this.#INPUT.FirstName.valid = false;
        }

        if (this.#INPUT.FirstName.valid && label.classList.contains("error")) {
            label.classList.remove("error");
        }else if (!this.#INPUT.FirstName.valid && !label.classList.contains("error")) {
            label.classList.add("error");
        }
    }

    verifMail () {
        let input = this.#INPUT.Mail.element;
        let label = input.parentNode;
        let value = input.value;
        let regex = /^(?<user>[a-zA-Z0-9.]{1,})@(?<domaine>[a-zA-Z0-9._-]{1,})\.(?<extend>[a-zA-Z]{1,})$/;
        let match = value.match(regex);

        if (match != null) {
            this.#INPUT.Mail.valid = true;
        }else {
            this.#INPUT.Mail.valid = false;
        }

        if (this.#INPUT.Mail.valid && label.classList.contains("error")) {
            label.classList.remove("error");
        }else if (!this.#INPUT.Mail.valid && !label.classList.contains("error")) {
            label.classList.add("error");
        }
    }

    verifPhone () {
        let input = this.#INPUT.Phone.element;
        let label = input.parentNode;
        let value = input.value;
        let regex = /^(?<code>\+[0-9]{2}|0)(?<prefix>[0-9]{1})(?<number>[0-9]{8})$/;
        let match = value.match(regex);

        if (match != null || value == "+33" || value == "") {
            this.#INPUT.Phone.valid = true;
        }else {
            this.#INPUT.Phone.valid = false;
        }

        if (this.#INPUT.Phone.valid && label.classList.contains("error")) {
            label.classList.remove("error");
        }else if (!this.#INPUT.Phone.valid && !label.classList.contains("error")) {
            label.classList.add("error");
        }
    }

    verifSujet () {
        let inputs = this.#INPUT.Sujet.element;
        let content = this.#INPUT.Sujet.content;
        let titre = content.querySelector(".value");
        let valid = false;

        for (let input of inputs) {
            if (input.checked) {
                valid = true;

                titre.textContent = input.value;

                break;
            }
        }

        if (valid) {
            this.#INPUT.Sujet.valid = true;
        }else {
            this.#INPUT.Sujet.valid = false;
        }

        if (this.#INPUT.Sujet.valid && content.classList.contains("error")) {
            content.classList.remove("error");
        }else if (!this.#INPUT.Sujet.valid && !content.classList.contains("error")) {
            content.classList.add("error");
        }

        if (content.getAttribute("open") != null) {
            content.removeAttribute("open");
        }
    }

    verifTxt () {
        let input = this.#INPUT.Txt.element;
        let label = input.parentNode;
        let value = input.value;

        if (value.trim().length > 0) {
            this.#INPUT.Txt.valid = true;
        }else {
            this.#INPUT.Txt.valid = false;
        }

        if (this.#INPUT.Txt.valid && label.classList.contains("error")) {
            label.classList.remove("error");
        }else if (!this.#INPUT.Txt.valid && !label.classList.contains("error")) {
            label.classList.add("error");
        }
    }

    verifConsent() {
        let input = this.#INPUT.Consent.element;
        let label = input.parentNode;

        if (input.checked) {
            this.#INPUT.Consent.valid = true;
        }else {
            this.#INPUT.Consent.valid = false;
        }

        if (this.#INPUT.Consent.valid && label.classList.contains("error")) {
            label.classList.remove("error");
        }else if (!this.#INPUT.Consent.valid && !label.classList.contains("error")) {
            label.classList.add("error");
        }
    }

    verif () {
        let listInput = this.#INPUT;
        let formValid = true;

        for (let input in listInput) {
            let inputValid = listInput[input].valid;

            if (!inputValid) {
                formValid = false;

                break;
            }
        }

        if (formValid) {
            this.buttonDisabled(false);
        }else {
            this.buttonDisabled(true);
        }

        return formValid;
    }

    send () {
        let errorName = "FORM CONTACT SEND";
        let form = this.#FORM_ELEMENT;
        let url = this.#URL_FORM;
        let methode = this.#METHODE;
        let req = new XMLHttpRequest();
        let data = new FormData(form);
        let delayAlert = 3000;

        req.timeout = 5000;
        req.onload = (ev) => {
            let status = req.status;

            if (status == 200) {
                let vm = document.implementation.createHTMLDocument();
                let formVm;

                vm.write(req.responseText);
                formVm = vm.querySelector(`#${FormContact.ID_ELEMENT}`);

                if (formVm !== null && formVm.classList.contains("true")) {
                    if (!form.classList.contains("valid")) {
                        form.classList.add("valid");
        
                        setTimeout(() => {
                            form.classList.remove("valid");
                        }, delayAlert);
    
                        this.buttonDisabled(false);
                        this.resetForm();
                    }
                }else {
                    let txt = `La requette "${methode}: ${url}" n'a pas aboutie`;
                    let error = new Error(txt);
                    error.name = errorName;

                    console.warn(error);

                    if (!form.classList.contains("warn")) {
                        form.classList.add("warn");
        
                        setTimeout(() => {
                            form.classList.remove("warn");
                            this.buttonDisabled(false);
                        }, delayAlert);
                    }
                }
            }else {
                let txt = `La requette "${methode}: ${url}" n'a pas aboutie\r\n${status}: ${req.statusText}`;
                let error = new Error(txt);
                error.name = errorName;

                console.warn(error);

                if (!form.classList.contains("warn")) {
                    form.classList.add("warn");
    
                    setTimeout(() => {
                        form.classList.remove("warn");
                        this.buttonDisabled(false);
                    }, delayAlert);
                }
            }
        };
        req.onerror = () => {
            let error = new Error(`La requette "${methode}: ${url}" a échouer`);
            error.name = errorName;

            console.error(error);

            if (!form.classList.contains("error")) {
                form.classList.add("error");

                setTimeout(() => {
                    form.classList.remove("error");
                    this.buttonDisabled(false);
                }, delayAlert);
            }
        };
        req.open(methode, url);
        req.send(data);
        this.buttonDisabled(true);
    }

    resetForm () {
        let form = this.#FORM_ELEMENT;
        let select = this.#INPUT.Sujet;

        form.reset();
        select.content.querySelector(".value").textContent = select.placeholder;

        for (let input in this.#INPUT) {
            this.#INPUT[input].valid = false;
        }
    }
}