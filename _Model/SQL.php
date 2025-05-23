<?php
class SQL {
    private $handler;
    private $error;

    public function __construct() {
        try {
            $this->handler = new mysqli("localhost", "root", "password", "Lpfs");
        } catch (Exception $exception) {
            $this->error = $exception->getMessage();
            return;
        }
        $this->error = $this->handler->connect_errno ? $this->handler->connect_error : null;
    }

    public function __destruct() {
        if ($this->handler) {
            $this->handler->close();
        }
    }

    public function error() {
        return ($this->error);
    }

    public function update($request) {
        $result = $this->handler->query($request);
        file_put_contents($_SERVER["DOCUMENT_ROOT"].'/files/log.html', $request . PHP_EOL, FILE_APPEND);
    }

    public function query($request) {
        $answer = $this->handler->query($request);
        $result = $answer->fetch_all(MYSQLI_ASSOC);
        $answer->free_result();
        file_put_contents($_SERVER["DOCUMENT_ROOT"].'/files/log.html', $request . PHP_EOL, FILE_APPEND);
        return ($result);
    }
}
?>