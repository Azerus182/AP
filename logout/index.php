<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Navigator.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/Navbar.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/StatusBar.php");

$error = null;
$success = null;

$database = new SQL();
$user = new User($database);
$success = null;
$error = $database->error() ? $database->error() : null;
$token = Navigator::get("token");
if ($token) {
    $error = $user->logout($token);
    Navigator::delete("token");
    $user = null;
    $success = "Vous avez été déconnecté";
} else {
    $error = "Vous n'etes pas connecté";
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
