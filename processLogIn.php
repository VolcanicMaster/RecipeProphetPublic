<?php
include "scripts/dbConnect.php";
session_start();
//$data = file_get_contents( "php://input" ); //gets string from xmlhttp, does it work for retrieving form POST?
if ( isset( $_POST['submit'] ) ){
    //verify that the information is correct
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            //for verification (use password_hash to encrypt)
            //$enteredPassword = password_hash($_POST['password'], PASSWORD_DEFAULT, array('cost' => 10));
            if (password_verify($_POST['password'], $password)) {
                // Verification success! User has loggedin!
                // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                //$_SESSION['id'] = $id;
                echo 'Welcome ' . $_SESSION['name'] . '!';
                //header('Location: index.php');
                //exit;
            } else {
                echo 'Incorrect password!';
            }
        } else {
            echo 'Incorrect username!';
        }

        $stmt->close();
    }
    //does this make login persistent while keeping info secure?
} else {
    exit('Please fill both the username and password fields!');
}

?>