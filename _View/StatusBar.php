<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/View.php");

class StatusBar extends View {
    private $success;
    private $error;

    public function __construct($success, $error) {
        $this->success = $success;
        $this->error = $error;
    }

    public function __toString() {
        $status = $this->error ? "error" : ($this->success ? "success" : "none");
        $text = $this->error ? $this->error : ($this->success ? $this->success : "");

        return ('
            <div class="statusbar">
                <div class="bar '.$status.'">
                    <p class="text">'.$text.'</p>
                    <button onclick="statusbarClose()"><img src="/assets/icon/close.svg" alt="X"></button>
                </div>
            </div>
        ');
    }
}
?>