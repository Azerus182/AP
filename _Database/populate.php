<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Service.php");

$database = new SQL();
$error = $database->error() ? $database->error() : "";
$success = null;

$users = new User($database);
$services = new Service($database);

$services->addServices("Radiologie");
$services->addServices("Neurologie");

$error .= $users->register("Secretaire", "password", "Secretaire", "Lastname");
$error .= $users->register("Administrateur", "password", "Admin", "Lastname");
$error .= $users->register("Medecin", "password", "Medecin", "Lastname");

$error .= $users->createRole("Admin");
$error .= $users->createRole("Secretaire");
$error .= $users->createRole("Medecin");

$error .= $users->setRolePermission("Secretaire", "edit_preadmitions", true);
$error .= $users->setRolePermission("Admin", "edit_users", true);
$error .= $users->setRolePermission("Admin", "edit_roles", true);
$error .= $users->setRolePermission("Admin", "edit_preadmitions", true);
$error .= $users->setRolePermission("Admin", "edit_services", true);

$error .= $users->setRole($users->searchUser("Secretaire")["id"], $users->searchRole("Secretaire")["id"]);
$error .= $users->setRole($users->searchUser("Administrateur")["id"], $users->searchRole("Admin")["id"]);
$error .= $users->setRole($users->searchUser("Medecin")["id"], $users->searchRole("Medecin")["id"]);
?>
