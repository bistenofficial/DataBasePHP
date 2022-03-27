<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['Phone']) && isset($_POST['Password'])) {
    if ($db->dbConnect()) {
        if($db->checkRegistration("agent", $_POST['Phone'])) {
            if ($db->logIn("agent", $_POST['Phone'], $_POST['Password'])) {
                echo "Login Success";
            } else echo "Username or Password wrong";
        }else echo "User not registered";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
