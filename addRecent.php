<?php
    include "scripts/dbConnect.php";
session_start();
?>
<?php
        
        
$data = file_get_contents( "php://input" ); //$data is now a string like '[1,2,3]';

if(isset($_SESSION["userin"])){

    //if SELECT id FROM userRecents WHERE userID = ? AND recipeID = ? returns no rows, continue.
    $sql = "SELECT id FROM userRecents WHERE userID = ? AND recipeID = ?;";

    $stmtSel = $conn->prepare($sql);
    $stmtSel->bind_param('ss', $_SESSION["id"], $data);
    $stmtSel->execute();
    if ($stmtSel->num_rows == 0) {
        $stmtSel->close();

        $stmtIns = $conn->prepare('INSERT INTO userRecents (userID, recipeID) VALUES (?,?);');
        $stmtIns->bind_param('ss', $_SESSION["id"], $data);
        $stmtIns->execute();
        $stmtIns->close();

        //if there are now over 50 recents, remove the earliest one (the one with the lowest id?)
        $stmtRem = $conn->prepare('CALL CheckCountAndRemoveRecents(?);');
        $stmtRem->bind_param('s', $_SESSION["id"]);
        $stmtRem->execute();
        $stmtRem->close();

    }
    
}

?>

<?php
    $conn->close();
?>