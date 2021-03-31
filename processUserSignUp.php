<?php
include "scripts/dbConnect.php";
//session_start();
//$data = file_get_contents( "php://input" ); //gets string from xmlhttp, does it work for retrieving form POST?
if ( isset( $_POST['submit'] ) ){
    //verify that the information is correct
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $conn->prepare('SELECT id, password FROM userAccounts WHERE username = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo 'This username is already in use!';
        } else {
            //TODO send them a verification email with a code, then their account is officially made and they can login normally.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, array('cost' => 10));
            $stmtIns = $conn->prepare('INSERT INTO userAccounts (username, password, email) VALUES (?,?,?)')
            $stmtIns->bind_param('s', $_POST['username'], $password, $_POST['email']);
            $stmtIns->execute();
            $stmtIns->close();
        }

        $stmt->close();
    }
    //does this make login persistent while keeping info secure?
} else {
    exit('Please fill both the username and password fields!');
}

?>