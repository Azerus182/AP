<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/SQL.php");

class Service {
    private $database;

    public function __construct(&$database) {
        $this->database = $database;
    }

    public function listServices() {
        $query = 'SELECT * FROM services;';

        try {
            $services = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (__FUNCTION__.':'.$error->getMessage());
        }
        return ($services);
    }

    public function addService($name) {
        $query = 'INSERT INTO services (name) VALUES ("'.$name.'");';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (__FUNCTION__.':'.$error->getMessage());
        }
        return (null);
    }

    public function getServices($name) {
        $query = 'SELECT * FROM services WHERE name="'.$name.'";';

        try {
            $services = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (__FUNCTION__.':'.$error->getMessage());
        }
        return ($services ? $services[0] : null);
    }

    public function renameService($id, $name) {
        $query = 'UPDATE services SET name="'.$name.'" WHERE id='.$id.';';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (__FUNCTION__.':'.$error->getMessage());
        }
        return (null);
    }

    public function delService($id) {
        $query = 'DELETE FROM services WHERE id='.$id.';';

        echo($query);
        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (__FUNCTION__.':'.$error->getMessage());
        }
        return (null);
    }
}
?>
