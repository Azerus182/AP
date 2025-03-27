<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/View.php");

class UserManagement extends View {
    private $users;
    private $services;
    private $roles;

    public function __construct($users, $services, $roles) {
        $this->users = $users;
        $this->services = $services;
        $this->roles = $roles;
    }

    private function renderService($services, $assigned) {
        $render = '';

        foreach ($services as $service) {
            $render .= '<option '.($service["id"] == $assigned ? 'selected="selected" ' : "").'value="'.$service["id"].'">'.$service["name"].'</option>';
        }
        return ('
            <select name="service">
                <option value=""></option>
                '.$render.'
            </select>
        ');
    }

    private function renderRole($roles, $assigned) {
        $render = '';

        foreach ($roles as $role) {
            $render .= '<option '.($role["id"] == $assigned ? 'selected="selected" ' : "").'value="'.$role["id"].'">'.$role["name"].'</option>';
        }
        return ('
            <select name="role">
                <option value=""></option>
                '.$render.'
            </select>
        ');
    }

    private function renderUser($users) {
        return ('
            <div>
                <input name="id" class="hidden" type="text" value="'.$users["id"].'">

                <label for="username">Utilisateur</label>
                <input name="username" type="text" value="'.$users["username"].'">

                <label for="firstname">Prénom</label>
                <input name="firstname" type="text" value="'.$users["firstname"].'">

                <label for="lastname">Nom</label>
                <input name="lastname" type="text" value="'.$users["lastname"].'">

                <label for="password">Mot de passe</label>
                <input name="password" type="text" value="">

                <label for="service">Service</label>
                '.$this->renderService($this->services, $users["service"]).'

                <label for="role">Role</label>
                '.$this->renderRole($this->roles, $users["role"]).'

                <button onclick="update(this)" value="save" class="save">
                    <img src="/assets/icon/check.svg" alt="X">
                </button>
                <button onclick="update(this)" value="del" class="del">
                    <img src="/assets/icon/close.svg" alt="X">
                </button>
            </div>
        ');
    }

    private function genList() {
        $render = "";

        foreach ($this->users as $user) {
            $render .= $this->renderUser($user);
        }
        return ($render);
    }

    public function __toString() {
        return ('
            <div class="user-management">
                <p class="title">Liste des utilisateurs</p>
                <div class="links">
                    '.$this->genList().'
                </div>
                <p class="title">Nouvel utilisateur</p>
                <div>
                    <label for="firstname">Prénom</label>
                    <input name="firstname" type="text" value="">
                    <label for="lastname">Nom</label>
                    <input name="lastname" type="text" value="">
                    <label for="password">Mot de passe</label>
                    <input name="password" type="text" value="">
                    <label for="service">Service</label>
                    '.$this->renderService($this->services, null).'
                    <label for="role">Role</label>
                    '.$this->renderRole($this->roles, null).'
                    <button onclick="update(this)" value="save" class="save">
                        <img src="/assets/icon/check.svg" alt="X">
                    </button>
                    <button onclick="update(this)" value="del" class="del">
                        <img src="/assets/icon/close.svg" alt="X">
                    </button>
                </div>
            </div>
        ');
    }
}
?>
