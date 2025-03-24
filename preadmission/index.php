<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Navigator.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/StatusBar.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/Navbar.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/AppList.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/Preadmission.php");

$error = null;
$success = null;

$database = new SQL();
if ($database->error()) {
    $error = $database->error();
    $role = null;
} else {
    $users = new User($database);
    $user = $users->getUser(Navigator::get("token"));
    $role = $user ? $users->getRole($user["role"]) : null;
}
if ($user == null || $role["edit_preadmitions"] == false) {
    $error = "Vous n'avez pas la permission d'acceder à ce contenu";
} else {
    $medics = $users->searchUserByRole("Medecin");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPFS-Intranet</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/statusbar.js"></script>
    <script src="/assets/js/preadmission.js"></script>
</head>
<body>
<?php
    echo(
        new Navbar($user)
        .new StatusBar($success, $error)
        .($role["edit_preadmitions"] ? new Preadmission($medics) : "")
    );
?>
</body>
</html>
