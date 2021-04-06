<?php
session_start();
$ingids = file_get_contents( "php://input" );
$ingids = json_decode( $ingids );

//submit to the DB

// Prepare our SQL Insert
if ($stmt = $conn->prepare('INSERT INTO userCustomLists (name, userID) VALUES (?,?)')) {
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmt->bind_param('s', $name, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();
}
//get the ID of the new user list so we can add the ingredients
if ($stmt = $conn->prepare('SELECT listID FROM userCustomLists WHERE name = ? AND userID = ? LIMIT 1')) {
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmt->bind_param('s', $name, $_SESSION['id']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($listid);
        $stmt->fetch();
        $stmt->close();
        //Insert the ingredients as rows in customListIngredients
        foreach($ingids as $ingid){
            if ($stmt = $conn->prepare('INSERT INTO customListIngredients (listID, ingredientID) VALUES (?,?)')) {
                // Bind parameters (s = string, i = int, b = blob, etc)
                $stmt->bind_param('i', $listid, $ingid);
                $stmt->execute();
                $stmt->close();
            }
        }
}
?>