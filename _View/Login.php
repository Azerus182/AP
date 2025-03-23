<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/View.php");

class Login extends View {
    public function __toString() {
        return ('
            <div class="login">
                <form action="/login/" method="post">
                    <p>Connexion</p>
                    <div class="field">
                        <label for="username">Nom d\'utilisateur: </label>
                        <input type="text" name="username" id="username" required/>
                    </div>
                    <div class="field">
                        <label for="password">Mot de passe: </label>
                        <input type="password" name="password" id="password" required />
                    </div>
                    <div class="field">
                        <input type="submit" value="Connexion" />
                    </div>
                </form>
            </div>
        ');
    }
}
?>
