<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/Navigator.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/Navbar.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/StatusBar.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/Login.php");

$error = null;
$success = null;

if (isset($_POST["username"], $_POST["password"])) {
    $database = new SQL();
    $user = new User($database);
    $success = null;
    $error = $database->error() ? $database->error() : null;

    if ($error == null) {
        $cookie = $user->login($_POST["username"], $_POST["password"]);
        if ($cookie == null) {
            $error = "Nom d'utilisateur ou mots de passe incorect";
        } else {
            Navigator::set("token", $cookie);
            $success = "Bienvenue ".$_POST["username"];
        }
    }
} else {
    $user = null;
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
    .new Login()
);
?>
</body>
</html>