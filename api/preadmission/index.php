<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Files.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Navigator.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Admission.php");

// try {
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

    $files = new Files($database);
    if (isset($_FILES['identityCard'], $_FILES['vitalCard'])) {
        $identityCard = $files->push($_FILES['identityCard']);
        $vitalCard = $files->push($_FILES['vitalCard']);
        // $mutualCard = $files->push($_FILES['mutualCard']);
    }

    // if (false == isset(
    //     $_POST["preadmission-type"],
    //     $_POST["day"],
    //     $_POST["time"],
    //     $_POST["medic"],
    //     $_POST["insuranceFund"],
    //     $_POST["ssn"],
    //     $_POST["patientIsPolicyHolder"],
    //     $_POST["isDisabled"],
    //     $_POST["mutualInsuranceName"],
    //     $_POST["civ"],
    //     $_POST["birthname"],
    //     $_POST["firstname"],
    //     $_POST["birthday"],
    //     $_POST["address"],
    //     $_POST["zipCode"],
    //     $_POST["city"],
    //     $_POST["email"],
    //     $_POST["phone"],
    //     $_FILES['identityCard'],
    //     $_FILES['vitalCard']
    // )) {
    //     throw new Exception("Erreur lors de la réception des informations");
    // }

    $error =  $admission->register(
        $_POST["ssn"],
        // $_POST["preadmission-type"],
        "1",
        $_POST["medic"],
        // $_POST["separateRoom"],
        10,
        $_POST["day"]." ".$_POST["time"],
        $_POST["firstname"],
        $_POST["birthname"],
        isset($_POST["mariedName"]) ? $_POST["mariedName"] : "",
        $_POST["birthday"],
        // $_POST["civ"],
        "0",
        // $_POST["isDisabled"],
        "0",
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
        // $_POST["patientIsPolicyHolder"] == "TRUE" ? "1" : "0",
        "0",
        $_POST["insuranceFund"],
        $_POST["mutualInsuranceName"],
        $identityCard,
        $vitalCard
    );
// } catch(Exception $e) {
//     // header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
//     $error = $e->getMessage();
// }
?>