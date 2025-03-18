<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/Model/Navigator.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/View/Navbar.php");
// require_once($_SERVER["DOCUMENT_ROOT"]."/View/StatusBar.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/View/Login.php");

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
    <link rel="stylesheet" href="/asset/css/style.css">
    <script src="/asset/js/statusbar.js"></script>
</head>
<body>
<?php
echo(
    new Navbar($user)
    // .new StatusBar(
        // $error ? StatusType::Error: ($success ? StatusType::Success : StatusType::None),
        // $error ? $error : ($success ? $success : "")
    // )
    .new Login();

);
?>
</body>
</html>