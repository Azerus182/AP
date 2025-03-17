<?php
class Navigator {
    public static function get($name) {
        if (isset($_COOKIE[$name])) {
            return ($_COOKIE[$name]);
        }
        return (null);
    }

    public static function set($name, $value) {
        setcookie($name, $value, time() + 60 * 5, "/");
    }

    public static function delete($name) {
        setcookie($name, "", 0, "/");
    }
}
?>
