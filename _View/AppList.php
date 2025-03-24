<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/View.php");

class AppList extends View {
    private $username;
    private $role;

    public function __construct($username, $role) {
        $this->username = $username;
        $this->role = $role;
    }

    private function renderLink($link, $name) {
        return ('<a class="shortcut" href="'.$link.'">'.$name.'</a>');
    }

    private function genList() {
        $render = "";

        if ($this->username == null) {
            $render .= $this->renderLink("/login/", "Connection");
        }
        if ($this->role == null) {
            return ($render);
        }
        if ($this->role["edit_users"]) {
            $render .= $this->renderLink("/editusers/", "Editer Utilisateurs");
        }
        if ($this->role["edit_roles"]) {
            $render .= $this->renderLink("/role_management/", "Editer Roles");
        }
        if ($this->role["edit_preadmitions"]) {
            $render .= $this->renderLink("/preadmission/", "Préadmission");
        }
        if ($this->role["edit_services"]) {
            $render .= $this->renderLink("/service_management/", "Editer les services");
        }
        return ($render);
    }

    public function __toString() {
        return ('
            <div class="app-list">
                <p class="greeter">Bonjour '.($this->username ? $this->username : "").'</p>
                <div class="links">
                    '.$this->genList().'
                </div>
            </div>
        ');
    }
}
?>
