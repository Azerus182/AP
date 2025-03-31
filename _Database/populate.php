<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Service.php");

$database = new SQL();
$error = $database->error() ? $database->error() : "";
$success = null;

$users = new User($database);
$services = new Service($database);

$services->addService("Radiologie");
$services->addService("Chirurgie");

$users->createRole("Directeur");
$users->setRolePermission("Directeur", "edit_users", true);
$users->setRolePermission("Directeur", "edit_roles", true);
$users->setRolePermission("Directeur", "edit_preadmitions", true);
$users->setRolePermission("Directeur", "edit_services", true);

$users->register("v.huppe", "|sAswQt5Y|", "Victor", "Huppe");
$users->setRole($users->searchUser("v.huppe")["id"], $users->searchRole("Directeur")["id"]);


$services->addService("Neurologie");
$users->createRole("Chef de service");
$users->setRolePermission("Chef de service", "edit_preadmitions", true);
$users->register("h.faure", "|sAswQt5Y|", "Hugues", "Faure");
$users->setService($users->searchUser("h.faure")["id"], $services->getService("Neurologie")["id"]);
$users->setRole($users->searchUser("h.faure")["id"], $users->searchRole("Chef de service")["id"]);

$users->register("f.marquis", "|sAswQt5Y|", "Françoise", "Marquis");
$users->setService($users->searchUser("f.marquis")["id"], $services->getService("Radiologie")["id"]);
$users->setRole($users->searchUser("f.marquis")["id"], $users->searchRole("Chef de service")["id"]);

$users->register("a.covillon", "|sAswQt5Y|", "Alexandre", "Covillon");
$users->setService($users->searchUser("f.marquis")["id"], $services->getService("Radiologie")["id"]);
$users->setRole($users->searchUser("f.marquis")["id"], $users->searchRole("Chef de service")["id"]);

$users->createRole("Medecin");
$users->setRolePermission("Medecin", "edit_preadmitions", true);
$users->register("g.house", "|sAswQt5Y|", "Gregory", "House");
$users->setService($users->searchUser("g.house")["id"], $services->getService("Radiologie")["id"]);
$users->setRole($users->searchUser("g.house")["id"], $users->searchRole("Medecin")["id"]);

$users->createRole("Infirmier");
$users->createRole("Aide-soignant");


$users->createRole("Responsable Agents Techniques");
$users->register("m.dron", "|sAswQt5Y|", "Micheline", "Dron");
$users->setRole($users->searchUser("m.dron")["id"], $users->searchRole("Responsable Agents Techniques")["id"]);

$users->createRole("Agent Technique");
$users->register("f.gregoire", "|sAswQt5Y|", "Fabienne", "Gregoire");
$users->register("jf.delassus", "|sAswQt5Y|", "Jean-François", "Delassus");
$users->setRole($users->searchUser("f.gregoire")["id"], $users->searchRole("Agent Technique")["id"]);
$users->setRole($users->searchUser("jf.delassus")["id"], $users->searchRole("Agent Technique")["id"]);


$users->createRole("Responsable Securité systèmes d\'informations");
$users->register("p.lemort", "|sAswQt5Y|", "Pierre", "Lemort");
$users->setRole($users->searchUser("p.lemort")["id"], $users->searchRole("Responsable Securité systèmes d\'informations")["id"]);

$users->createRole("Admin");
$users->register("a.masson", "|sAswQt5Y|", "Antoine", "Masson");
$users->register("m.gousse", "|sAswQt5Y|", "Marc", "Gousse");
$users->register("r.parent", "|sAswQt5Y|", "Roger", "Parent");
$users->register("s.Poirier", "|sAswQt5Y|", "Sabine", "Poirier");
$users->register("a.racine", "|sAswQt5Y|", "Alexis", "Racine");
$users->register("d.guerette", "|sAswQt5Y|", "David", "Guerette");
$users->setRole($users->searchUser("a.masson")["id"], $users->searchRole("Admin")["id"]);
$users->setRole($users->searchUser("m.gousse")["id"], $users->searchRole("Admin")["id"]);
$users->setRole($users->searchUser("r.parent")["id"], $users->searchRole("Admin")["id"]);
$users->setRole($users->searchUser("s.Poirier")["id"], $users->searchRole("Admin")["id"]);
$users->setRole($users->searchUser("a.racine")["id"], $users->searchRole("Admin")["id"]);
$users->setRole($users->searchUser("d.guerette")["id"], $users->searchRole("Admin")["id"]);

$users->createRole("Directeur Financier");

$users->register("c.quirion", "|sAswQt5Y|", "Claude", "Quirion");
$users->setRole($users->searchUser("c.quirion")["id"], $users->searchRole("Directeur Financier")["id"]);
?>
