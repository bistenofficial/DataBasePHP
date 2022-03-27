<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['Phone']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if(!$db->checkRegistration("agent", $_POST['Phone'])) {
            if ($db->signUp("agent", $_POST['Phone'], $_POST['password'])) {
                echo "Sign Up Success";
            } else echo "Sign up Failed";
        }else echo "User already registered";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
