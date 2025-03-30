<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Navigator.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Service.php");

$database = new SQL();
if ($database->error()) {
    throw new Exception($database->error());
}

$users = new User($database);
$services = new Service($database);
$user = $users->getUser(Navigator::get("token"));
if ($user == null || ($users->getRole($user["role"]))["edit_users"] == false) {
    throw new Exception("Vous n'avez pas la permission d'acceder à ce contenu");
}
header("HTTP/1.1 200 OK");

var_dump($_POST);

if (isset($_POST["action"])) {
    if ($_POST["action"] == "newUser") {
        if (isset($_POST["username"],
            $_POST["firstname"],
            $_POST["lastname"],
            $_POST["password"]
        )) {
            $username = trim($_POST["username"]);
            $firstname = trim($_POST["firstname"]);
            $lastname = trim($_POST["lastname"]);
            $password = trim($_POST["password"]);

            $id = $users->register($username, $password, $firstname, $lastname);
            if (isset($_POST["service"])) {
                $users->setService($id, $_POST["service"]);

            }
            if (isset($_POST["role"])) {
                $users->setRole($id, $_POST["role"]);
            }
        }
    } else if ($_POST["action"] == "saveUser") {
        if (isset($_POST["id"],
            $_POST["username"],
            $_POST["firstname"],
            $_POST["lastname"]
        )) {
            $id = trim($_POST["id"]);
            $username = trim($_POST["username"]);
            $firstname = trim($_POST["firstname"]);
            $lastname = trim($_POST["lastname"]);
            $password = trim($_POST["password"]);

            $users->modify($id, $username, $password, $firstname, $lastname);
            if (isset($_POST["service"])) {
                $users->setService($id, $_POST["service"]);
            } else {
                $users->setService($id, "NULL");
            }
            if (isset($_POST["role"])) {
                $users->setRole($id, $_POST["role"]);
            } else {
                $users->setRole($id, "NULL");
            }
        }
    } else if ($_POST["action"] == "delUser") {
        if (isset($_POST["id"])) {
            $users->delete(trim($_POST["id"]));
        }
    }
}
?>