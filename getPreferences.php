<body>
<?php
echo '<div id="newRecipeProphetRecipeGallery">';
?>

    <div id="exclusionsDiv" class="">
    <div >
        <button class="btn btn-lg btn-primary display-4" onclick="saveExclusions()">Save Changes</button>
        <button class="btn btn-md btn-primary display-4" onclick="addVeganIngs()">I'm Vegan</button>
        <button class="btn btn-md btn-secondary display-4" onclick="clearExclusions()">Clear All</button>
    </div>
    <ul name="exclusions" id="ingredients">Exclusions: </ul>
    </div>


<?php
    include "scripts/dbConnect.php";
?>
<?php
        
        
$data = file_get_contents( "php://input" ); //$data is now a string like '[1,2,3]';

// Query that selects any existing exclusions for this user
//$sql = "CALL SRecBasedOnIng( '" . $imploded_data . "' );";
$sql = "SELECT ingredients.name as name, ingredients.id as id FROM (SELECT exIngID FROM userExclusions WHERE userID = '1') AS excSet INNER JOIN ingredients ON excSet.exIngID = ingredients.id;";

$result = $conn->query($sql);

//default preferences
//TODO fix this get, does not work //echoing a script does not work, should echo the info, then use js loop to catch it once it's sent back to account.php

if ($result->num_rows > 0) {
    echo '<div id="exclusionData" type="hidden">';
    while($row = $result->fetch_assoc()) {        
        
        //echo 'createListItem(' . $row["name"] . ',' . $row["id"] . ');';
        echo '<div data-exc-id="'. $row["id"] .'" data-exc-name="'. $row["name"] .'"></div>';
    }
    echo '</div>';
} else {
}


echo '</div>';

?>

<?php
    $conn->close();
    //mysqli_close($conn);
?>
    
</body>