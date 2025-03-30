<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_Model/SQL.php");

class User {
    private $database;

    public function __construct(&$database) {
        $this->database = $database;
    }

    // Basic
    private function newSalt() : String {
        return (hash("sha256",random_bytes(32)));
    }

    private function hashPassword($password, $salt) : String {
        return (hash("sha512", $password . $salt));
    }

    // User
    public function getUser($tokens) {
        $user = $this->database->query(
            'SELECT * from users INNER JOIN tokens ON users.id=tokens.id WHERE tokens.token="'.$tokens.'";'
        );
        return ($user ? $user[0] : null);
    }

    public function login($username, $password) {
        if ($username == null || $password == null) {
            return;
        }

        $user = $this->database->query('SELECT * from users WHERE username="'.$username.'";');
        if ($user == null) {
            return (null);
        }
        $user = $user[0];
        if ($user["password"] != $this->hashPassword($password, $user["salt"])) {
            return (null);
        }
        $token = $this->newSalt();
        $query = 'INSERT INTO tokens (id, token) VALUES ("'.$user["id"].'", "'.$token.'");';
        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return ($token);
    }

    public function logout($token) {
        $query = 'DELETE FROM tokens WHERE token="'.$token.'";';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return (null);
    }

    public function register($username, $password, $firstname, $lastname) {
        $salt = $this->newSalt();
        $password = $this->hashPassword($password, $salt);
        $query =
        'INSERT INTO users ('
            .'username, firstname, lastname, password, salt'
        .') VALUES ("'
            .$username.'", "'.$firstname.'", "'.$lastname.'", "'.$password.'", "'.$salt
        .'") RETURNING id;';

        try {
            $id = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return ($id[0]["id"]);
    }

    public function delete($username) {
        $query = 'DELETE FROM users WHERE username='.$username.';';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return (null);
    }

    public function setRole($userId, $roleId) {
        $query = 'UPDATE users SET role='.$roleId.' WHERE id='.$userId.';';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return (null);
    }

    public function setService($userId, $serviceId) {
        $query = 'UPDATE users SET service='.$serviceId.' WHERE id='.$userId.';';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return (null);
    }

    public function searchUser($username) {
        $query = 'SELECT * FROM users WHERE username="'.$username.'";';

        try {
            $user = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return ($user ? $user[0] : null);
    }

    public function searchUserByRole($role) {
        $query = 'SELECT users.firstname,users.lastname,users.service,users.id FROM users INNER JOIN roles ON users.role=roles.id WHERE roles.name="'.$role.'";';

        try {
            $users = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return ($users);
    }

    public function getUsers() {
        $query = 'SELECT * FROM users;';

        try {
            $users = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return ($users);
    }

    // Role
    public function createRole($name) {
        $query = 'INSERT INTO roles (name) VALUES ("'.$name.'");';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return (null);
    }

    public function getRole($id) {
        $query = 'SELECT * FROM roles WHERE id='.$id.';';
        $role = null;

        try {
            $role = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return ($role ? $role[0] : null);
    }

    public function getRoles() {
        $query = 'SELECT * FROM roles;';

        try {
            $roles = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return ($roles);
    }

    public function setRolePermission($name, $permission, $canDo) {
        $query = 'UPDATE roles SET '.$permission.' = '.($canDo ? "TRUE" : "FALSE").' WHERE name="'.$name.'";';

        try {
            $this->database->update($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return (null);
    }

    public function searchRole($role) {
        $query = 'SELECT * FROM roles WHERE name="'.$role.'";';

        try {
            $roles = $this->database->query($query);
        } catch (mysqli_sql_exception $error) {
            return (null);
        }
        return ($roles ? $roles[0] : null);
    }
}
?>
