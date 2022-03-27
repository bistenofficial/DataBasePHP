<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $Phone, $Password)
    {
        $Phone = $this->prepareData($Phone);
        $Password = $this->prepareData($Password);

        $this->sql = "select * from " . $table . " where Phone = '" . $Phone . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
            $dbusername = $row['Phone'];
            $dbpassword = $row['Password'];
            if (($dbusername == $Phone) && ($Password == $dbpassword)) {
                $login = true;
            } else $login = false;
        return $login;
    }

    function signUp($table, $Phone, $password)
    {
        $Phone = $this->prepareData($Phone);
        $password = $this->prepareData($password);
        $this->sql =
            "INSERT INTO " . $table . " (Phone, password) VALUES ('" . $Phone . "','" . $password . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }
    function checkRegistration($table, $Phone)
    {
        $this->sql = "select * from " . $table . " where Phone = '" . $Phone . "'";
        $result = mysqli_query($this->connect, $this->sql);
        if (mysqli_num_rows($result) != 0)
        {
            return true;
        }
        else return false;
    }
}
?>
