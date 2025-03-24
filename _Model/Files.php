<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/SQL.php");

class Files {
    private $database;
    public $error;

    private function path() {
        return ($_SERVER["DOCUMENT_ROOT"]."/files");
    }

    public function __construct(&$database) {
        $this->database = $database;
        $this->error = null;

        if (is_dir($this->path()) == false) {
            if (mkdir($this->path(), 700)) {
                $this->error = "Permission Error";
            }
        }
    }

    private function toID($name, $ext) {
        $query = 'INSERT INTO files(name, ext) VALUES ("'.$name.'", "'.$ext.'") RETURNING id;';

        try {
            $id = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            throw new Exception(__CLASS__.":".__METHOD__.':'.$error->getMessage());
        }
        return ($id[0]["id"]);
    }

    private function fromID($id) {
        $query = 'SELECT * from files WHERE id='.$id.';';

        try {
            $file = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            throw new Exception(__CLASS__.":".__METHOD__.':'.$error->getMessage());
        }
        return ($file[0]["id"]);
    }

    public function push($file) {
        $ext = end(explode('.', $file['name']));
        $id = $this->toID($file['name'], $ext);
        $dest = $this->path()."/".$id;
        try {
            if (move_uploaded_file($file["tmp_name"], $dest) == false) {
                throw new Exception(__CLASS__."Unable to manipulate file");
            }
            return ($id);
        } catch (Exception $error) {
            $this->error = $error->getMessage();
            return (null);
        }
    }
}
?>
