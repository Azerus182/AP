<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/View/Navbar.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPFS-Intranet</title>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>
<?php
    echo(
        new Navbar(null)
    );
?>
</body>
</html>
