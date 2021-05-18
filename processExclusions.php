<?php
    include "scripts/dbConnect.php";
?>
<?php
session_start();
$ingids = file_get_contents( "php://input" );
$ingids = json_decode( $ingids );

//submit to the DB

$id = $_SESSION['id'];

//Delete all previous exclusions for this user
if($stmtDel = $conn->prepare('DELETE FROM userExclusions WHERE userID = ?')){
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmtDel->bind_param('i', $id);
    $stmtDel->execute();
    $stmtDel->close();
}

//Insert the ingredients as rows in customListIngredients
foreach($ingids as $ingid){
    if ($stmtTwo = $conn->prepare('INSERT INTO userExclusions (userID,exIngID) VALUES (?,?)')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmtTwo->bind_param('ii', $id, $ingid);
        $stmtTwo->execute();
        $stmtTwo->close();
    }
}
?>