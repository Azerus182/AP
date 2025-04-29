<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Files.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Navigator.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Admission.php");

header("Content-Type: application/json");

$answer = [
    "status" => 0,
    "error" => ""
];

try {
    $database = new SQL();
    if ($database->error()) {
        throw new Exception($database->error());
    }
    $users = new User($database);
    $admission = new Admission($database);
    $user = $users->getUser(Navigator::get("token"));
    if ($admission == null || $user == null || ($users->getRole($user["role"]))["edit_preadmitions"] == false) {
        throw new Exception("Vous n'avez pas la permission d'acceder à ce contenu");
    }
    // Requirements
    if (false == isset(
        $_POST["preadmission-type"],
        $_POST["day"],
        $_POST["time"],
        $_POST["medic"],
        $_POST["insuranceFund"],
        $_POST["ssn"],
        $_POST["patientIsPolicyHolder"],
        $_POST["isDisabled"],
        $_POST["mutualInsuranceName"],
        $_POST["civ"],
        $_POST["birthname"],
        $_POST["firstname"],
        $_POST["birthday"],
        $_POST["address"],
        $_POST["zipCode"],
        $_POST["city"],
        $_POST["email"],
        $_POST["phone"],
        $_FILES['identityCard'],
        $_FILES['vitalCard']
    )) {
        throw new Exception("Erreur lors de la réception des informations");
    }

    if ($_POST["ssn"][0] != $_POST["civ"]) {
        throw new Exception("Numéro de sécurité sociale incohérent avec l'état civile");
    }

    if (substr($_POST["ssn"], 1, 2) != (new DateTime($_POST["birthday"]))->format('y')) {
        throw new Exception("Numéro de sécurité sociale incohérent avec l'état civile");
    }
    if (substr($_POST["ssn"], 3, 2) != (new DateTime($_POST["birthday"]))->format('m')) {
        throw new Exception("Numéro de sécurité sociale incohérent avec l'état civile");
    }

    $files = new Files($database);
    $identityCard = $files->push($_FILES['identityCard']);
    $vitalCard = $files->push($_FILES['vitalCard']);
    if (isset($_FILES['mutualCard'])) {
        $mutualCard = $files->push($_FILES['mutualCard']);
    } else {
        $mutualCard = NULL;
    }

    $error =  $admission->register(
        $_POST["ssn"],
        $_POST["preadmission-type"],
        $_POST["medic"],
        $_POST["separateRoom"],
        $_POST["day"]." ".$_POST["time"],
        $_POST["firstname"],
        $_POST["birthname"],
        isset($_POST["mariedName"]) ? $_POST["mariedName"] : "",
        $_POST["birthday"],
        $_POST["civ"],
        $_POST["isDisabled"],
        $_POST["address"] . ", " .$_POST["city"],
        $_POST["zipCode"],
        $_POST["email"],
        $_POST["phone"],
        isset($_POST["contactName"]) ? $_POST["contactName"] : "",
        isset($_POST["contactFirstname"]) ? $_POST["contactFirstname"] : "",
        isset($_POST["contactAddress"]) ? $_POST["contactAddress"] : "",
        isset($_POST["contactPhone"]) ? $_POST["contactPhone"] : "",
        isset($_POST["trustName"]) ? $_POST["trustName"] : "",
        isset($_POST["trustFirstname"]) ? $_POST["trustFirstname"] : "",
        isset($_POST["trustAddress"]) ? $_POST["trustAddress"] : "",
        isset($_POST["trustPhone"]) ? $_POST["trustPhone"] : "",
        $_POST["insuranceFund"],
        $_POST["patientIsPolicyHolder"],
        $_POST["insuranceFund"],
        $_POST["mutualInsuranceName"],
        $identityCard,
        $vitalCard
    );
} catch(Exception $e) {
    $answer["status"] = 1;
    $answer["error"] = $e->getMessage();
}
echo(json_encode($answer, JSON_NUMERIC_CHECK));
?>