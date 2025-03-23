<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Navigator.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/StatusBar.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/Navbar.php");

$error = null;
$success = null;

$database = new SQL();
if ($database->error()) {
    $error = $database->error();
} else {
    $users = new User($database);
    $user = $users->getUser(Navigator::get("token"));
    $role = $user ? $users->getRole($user["role"]) : null;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPFS-Intranet</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php
    echo(
        new Navbar($user)
        .new StatusBar($success, $error)
    );
?>
</body>
</html>
