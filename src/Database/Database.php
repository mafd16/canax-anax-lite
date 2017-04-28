<?php

//namespace Marton\Database;


/**
 * Class to collect all database activities.
 */
class Database
{
    private $db;


    /**
     * Create a connection to the database.
     *
     * @param array $config details on how to connect.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD)
     */
    public function connect($config)
    {
        try {
            $this->db = new PDO(...array_values($config));
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (Exception $e) {
            // Rethrow to hide connection details, through the original
            // exception to view all connection details.
            //throw $e;
            throw new PDOException("Could not connect to database, hiding details.");
        }
    }


    /**
     * Get the info about the user
     * @param $user string The username of the user to get info about.
     * @return $res array The info about the user.
     */
    public function getUserInfo($user)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name='$user'");
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        //$res = $stmt->fetchAll();
        return $res;
    }

    /**
     * Adds user to the database
     * @param $user string The name of the user
     * @param $pass string The user's password
     * @return void
     */
    public function addUser($user, $pass)
    {
        $stmt = $this->db->prepare("INSERT into users (name, pass) VALUES ('$user', '$pass');");
        $stmt->execute();
    }

    /**
     * Deletes user from the database
     * @param $userId int The id of the user
     * @return void
     */
    public function deleteUser($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = $userId;");
        $stmt->execute();
    }



    /**
     * Gets the hashed password from the database
     * @param $user string The user to get password from/for
     * @return string The hashed password
     */
    public function getHash($user)
    {
        $stmt = $this->db->prepare("SELECT pass FROM users WHERE name='$user'");
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res["pass"];
    }

    /**
     * Gets all users from the database
     * @param $sql string sql-expression
     * @return
     */
    public function getAllUsers($sql)
    {
        //$stmt = $this->db->prepare("SELECT * FROM users");
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        //$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = $stmt->fetchAll();
        return $res;
    }

    /**
     * Do SELECT with optional parameters and return a resultset.
     *
     * @param string $sql   statement to execute
     * @param array  $param to match ? in statement
     *
     * @return array with resultset
     */
    public function executeFetchAll($sql, $param = [])
    {
        $sth = $this->execute($sql, $param);
        $res = $sth->fetchAll();
        if ($res === false) {
            $this->statementException($sth, $sql, $param);
        }
        return $res;
    }


    /**
     * Do INSERT/UPDATE/DELETE with optional parameters.
     *
     * @param string $sql   statement to execute
     * @param array  $param to match ? in statement
     *
     * @return PDOStatement
     */
    public function execute($sql, $param = [])
    {
        $sth = $this->db->prepare($sql);
        if (!$sth) {
            $this->statementException($sth, $sql, $param);
        }

        $status = $sth->execute($param);
        if (!$status) {
            $this->statementException($sth, $sql, $param);
        }

        return $sth;
    }


    /**
     * Changes the password for a user
     * @param $user string The usr to change the password for
     * @param $pass string The password to change to
     * @return void
     */
    public function changePassword($user, $pass)
    {
        $stmt = $this->db->prepare("UPDATE users SET pass='$pass' WHERE name='$user'");
        $stmt->execute();
    }

    /**
     * Updates the information for a user
     * @param $uin array [firstname, lastname, age, place, profession, interest]
     * @param $user string The username
     * @param $admin int 0/1 admin or not.
     */
    public function updateUser($uin, $user, $admin = 0)
    {
        $stmt = $this->db->prepare("UPDATE users SET firstname='$uin[0]', lastname='$uin[1]', age='$uin[2]', city='$uin[3]', profession='$uin[4]', interest='$uin[5]', admin='$admin' WHERE name='$user'");
        $stmt->execute();
    }


    /**
     * Check if user exists in the database
     * @param $user string The user to search for
     * @return bool true if user exists, otherwise false
     */
    public function exists($user)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name='$user'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return !$row ? false : true;
    }

    /**
     * Through exception with detailed message.
     *
     * @param PDOStatement $sth statement with error
     * @param string       $sql     statement to execute
     * @param array        $param   to match ? in statement
     *
     * @return void
     *
     * @throws Exception
     */
    public function statementException($sth, $sql, $param)
    {
        throw new Exception(
            $sth->errorInfo()[2]
            . "<br><br>SQL ("
            . substr_count($sql, "?")
            . " params):<br><pre>$sql</pre><br>PARAMS ("
            . count($param)
            . "):<br><pre>"
            . implode($param, "\n")
            . "</pre>"
            . ((count(array_filter(array_keys($param), 'is_string')) > 0)
                ? "WARNING your params array has keys, should only have values."
                : null)
        );
    }
}
