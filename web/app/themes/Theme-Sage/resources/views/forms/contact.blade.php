
@if ($valid == 0)
    <form id="formContact" action="#" method="post">
        <input type="hidden" name="FomContact">
        <fieldset class="ident">
            <legend>Identiter</legend>
            <label id="inputName">
                <h5 class="titre">Nom</h5>
                <input type="text" name="Name" id="Name">
            </label>
            <label id="inputFirstName">
                <h5 class="titre">Prénom</h5>
                <input type="text" name="FirstName" id="FirstName">
            </label>
            <label id="inputMail">
                <h5 class="titre">Adresse email</h5>
                <input type="email" name="Mail" id="Mail">
            </label>
            <label id="inputPhone">
                <h5 class="titre">Téléphone <span>(facultatif)</span></h5>
                <input type="tel" name="Phone" id="Phone" value="+33">
            </label>
        </fieldset>
        <fieldset class="msg">
            <legend>message</legend>
            <details id="inputSujet">
                <summary><span class="titre">Sujet</span><span class="value">Choisissez un sujet</span></summary>
                <ul>
                    <li>
                        <label for="sujetUn">Sujet 1</label>
                        <input type="radio" name="Sujet" value="Sujet 1" id="sujetUn">
                    </li>
                    <li>
                        <label for="sujetDeux">Sujet 2</label>
                        <input type="radio" name="Sujet" value="Sujet 2" id="sujetDeux">
                    </li>
                    <li>
                        <label for="sujettrois">Sujet 3</label>
                        <input type="radio" name="Sujet" value="Sujet 3" id="sujettrois">
                    </li>
                </ul>
            </details>
            <label id="inputTxt">
                <h5 class="titre">Message</h5>
                <textarea name="Txt" id="Txt"></textarea>
            </label>
            <label id="inputConsent">
                <h5 class="titre">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis risus mi. Ut placerat quam lectus. Curabitur dictum velit non lacus ornare tempor.</h5>
                <input type="checkbox" name="Consent" id="Consent">
            </label>
        </fieldset>
        <div id="inputSubmit">
            <button type="submit">Envoyer</button>
        </div>
    </form>
@elseif ($valid == 1)
    <div id="formContact" class="true">
    </div>
@else
    <div id="formContact" class="false">
    </div>
@endif