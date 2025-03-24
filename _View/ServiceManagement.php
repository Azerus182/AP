<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/View.php");

class ServiceManagement extends View {
    private $services;

    public function __construct($services) {
        $this->services = $services;
    }

    private function renderService($service) {
        return ('
            <div>
                <input name="id" class="hidden" type="text" value="'.$service["id"].'">
                <input name="name" type="text" value="'.$service["name"].'">
                <button onclick="update(this)" value="save" class="save"><img src="/assets/icon/check.svg" alt="X"></button>
                <button onclick="update(this)" value="del" class="del"><img src="/assets/icon/close.svg" alt="X"></button>
            </div>
        ');
    }

    private function genList() {
        $render = "";

        foreach ($this->services as $service) {
            $render .= $this->renderService($service);
        }
        return ($render);
    }

    public function __toString() {
        return ('
            <div class="service-management">
                <p class="title">Liste des services</p>
                <div class="links">
                    '.$this->genList().'
                </div>
                <p class="title">Nouveau service</p>
                <div class="links">
                    <div>
                        <input name="name" type="text" value="">
                        <button class="save" onclick="saveNew(this)"><img src="/assets/icon/check.svg" alt="X"></button>
                    </div>
                </div>
            </div>
        ');
    }
}
?>
