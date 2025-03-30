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
                <option value="">Aucun service</option>
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
                <option value="">Aucun role</option>
                '.$render.'
            </select>
        ');
    }

    private function renderUser($users) {
        return ('
            <tr>
                <th class="hidden"><input name="id" class="hidden" type="text" value="'.$users["id"].'"></th>
                <th><input name="username" type="text" value="'.$users["username"].'"></th>
                <th><input name="firstname" type="text" value="'.$users["firstname"].'"></th>
                <th><input name="lastname" type="text" value="'.$users["lastname"].'"></th>
                <th><input name="password" type="text" value="" placeholder="pas de changement"></th>
                <th>'.$this->renderService($this->services, $users["service"]).'</th>
                <th>'.$this->renderRole($this->roles, $users["role"]).'</th>
                <th>
                    <button onclick="update(this, \'saveUser\')" value="save" class="save">
                        <img src="/assets/icon/check.svg" alt="X">
                    </button>
                    <button onclick="update(this, \'delUser\')" value="del" class="del">
                        <img src="/assets/icon/close.svg" alt="X">
                    </button>
                </th>
            </tr>
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
                <table>
                    <tr>
                        <th class="hidden"></th>
                        <th>Utilisateur</th>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Mots de passe</th>
                        <th>Service</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                    '.$this->genList().'
                </table>
                <p class="title">Nouvel utilisateur</p>
                <table>
                    <tr>
                        <th class="hidden"><input name="id" class="hidden" type="text" value=""></th>
                        <th><input name="username" type="text" value="" placeholder="Utilisateur"></th>
                        <th><input name="firstname" type="text" value="" placeholder="Prénom"></th>
                        <th><input name="lastname" type="text" value="" placeholder="Nom"></th>
                        <th><input name="password" type="text" value="" placeholder="Mot de passe"></th>
                        <th>'.$this->renderService($this->services, null).'</th>
                        <th>'.$this->renderRole($this->roles, null).'</th>
                        <th>
                            <button onclick="update(this, \'newUser\')" value="save" class="save">
                                <img src="/assets/icon/check.svg" alt="X">
                            </button>
                        </th>
                    </tr>
                </table>
            </div>
        ');
    }
}
?>
