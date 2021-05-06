<?php
include "scripts/dbConnect.php";
session_start();
//$data = file_get_contents( "php://input" ); //gets string from xmlhttp, does it work for retrieving form POST?
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
                $_SESSION['userin'] = TRUE; //TODO actually use this value
                $_SESSION['name'] = $_POST['email'];
                $_SESSION['id'] = $id;
                echo 'Welcome ' . $_SESSION['name'] . '!';
                $_SESSION['message'] = 'Logged in successfully!';
                header('Location: index.php');
                exit;
            } else {
                echo 'Incorrect password!';
                $_SESSION['message'] = 'Incorrect email or password!';
                header('Location: login.php');
                exit;
            }
        } else {
            echo 'Incorrect email!';
            $_SESSION['message'] = 'Incorrect email!';
            header('Location: login.php');
            exit;
        }

        $stmt->close();
    }
    //does this make login persistent while keeping info secure?
} else {
    exit('Please fill both the email and password fields!');
}

?>