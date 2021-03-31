<?php
include "scripts/dbConnect.php";
echo 'starting...';
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = "test"')) {
    echo 'entered first if...';
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    //$stmt->bind_param('s', 'test');
    $stmt->execute();
    echo 'stmt executed...';
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    echo 'stmt result stored...';
    if ($stmt->num_rows > 0) {
        echo 'entered second if...';
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        //for verification (use password_hash to encrypt)
        $enteredPassword = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));
        echo $enteredPassword;
    } else {
        echo 'Incorrect username!';
    }

    $stmt->close();
}
//does this make login persistent while keeping info secure?
?>