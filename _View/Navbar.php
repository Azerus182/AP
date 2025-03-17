<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/View.php");

class Navbar extends View {
    private $logged;

    public function __construct($logged) {
        $this->logged = $logged;
    }

    public function __toString() {
        return ('
            <div class="navbar">
                <h1>LPFS</h1>
                <a href="/">Accueil</a>
                '.(
                    $this->logged == true
                    ? '<a href="/account/">Mon compte</a><a href="/logout/">Deconnexion</a>'
                    : '<a href="/login/">Connexion</a>'
                ).'
            </div>
        ');
    }
}
?>
