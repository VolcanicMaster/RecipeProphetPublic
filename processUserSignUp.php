<?php
include "scripts/dbConnect.php";
session_start();
if ( isset( $_POST['submit'] ) ){
    //verify that the information is correct
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $conn->prepare('SELECT id, password FROM userAccounts WHERE email = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['message'] = 'This email is already in use!';
            header('Location: login.php');
            exit;
        } else {
            //TODO google sign in //?send them a verification email with a code, then their account is officially made and they can login normally?
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, array('cost' => 10));
            $stmtIns = $conn->prepare('INSERT INTO userAccounts (password, email) VALUES (?,?)');
            $stmtIns->bind_param('ss', $password, $_POST['email']);
            $stmtIns->execute();
            $stmtIns->close();
            $_SESSION['message'] = 'Account created successfully!';
            header('Location: index.php');
            exit;
        }

        $stmt->close();
    }
    //does this make login persistent while keeping info secure?
} else {
    $_SESSION['message'] = 'Please fill both the email and password fields!';
    header('Location: login.php');
    exit;
}

?>