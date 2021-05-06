<?php
    include "scripts/dbConnect.php";
session_start();
?>
<?php
        
        
$data = file_get_contents( "php://input" ); //$data is now a string like '[1,2,3]';

if(isset($_SESSION["userin"])){

    $stmtIns = $conn->prepare('INSERT INTO userRecents (userID, recipeID) VALUES (?,?)');
    $stmtIns->bind_param('ss', $_SESSION["id"], $data);
    $stmtIns->execute();
    $stmtIns->close();
    
}

?>

<?php
    $conn->close();
?>