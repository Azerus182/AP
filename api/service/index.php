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
if ($user == null || ($users->getRole($user["role"]))["edit_services"] == false) {
    throw new Exception("Vous n'avez pas la permission d'acceder à ce contenu");
}
header("HTTP/1.1 200 OK");

if (isset($_POST["newService"])) {
    $services->addService($_POST["newService"]);
}

if (isset($_POST["action"])) {
    if ($_POST["action"] == "save") {
        $services->renameService($_POST["id"], $_POST["name"]);
    }
    if ($_POST["action"] == "del") {
        $services->delService($_POST["id"]);
    }
}
?>