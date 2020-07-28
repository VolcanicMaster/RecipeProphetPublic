<body>
    <!--<div id="newRecipeProphetRecipeGallery"></div>-->
</body>

<?php
    include "scripts/dbConnect.php"
?>
<?php

$data = file_get_contents( "php://input" ); //$data is now the string '[1,2,3]';

$data = json_decode( $data ); //$data is now a php array array(1,2,3)

$imploded_data = implode( "', '", $data);

/*
// Create a new DOM Document 
$dom = new DomDocument;
//$dom = new DOMDocument('1.0', 'iso-8859-1'); 

// Validate our document before referring to the id
$dom->validateOnParse = true;

// Create a div element 
$element = $dom->appendChild(new DOMElement('div')); 
  
// Create a id attribute to div 
$attr = $element->setAttributeNode( 
        new DOMAttr('id', 'my_id')); 
  
// Set that attribute as id 
$element->setIDAttribute('id', true); 

$id = $dom->getElementById('my_id');*/

echo '<div id="newRecipeProphetRecipeGallery">';

//searchForRecipes that returns a sorted list of recipes
//TODO query recipeDatabase so that it returns only the recipes that fit the constraints (ease,weight for now)


//Query for ingredients
$sql = "SELECT name, tags FROM ingredients;";
$result = $conn->query($sql);
$dbings = array();
if($result->num_rows > 0){
    echo '<p>if ingres</p>';
    while($row = $result->fetch_assoc()){
        //echo '<p>test while</p>';
        $dbings[] = $row;
    }
}

//TODO are all ingredients in the database being iterated through?




//TODO put code here that reads test json file with 2 entries and submits it to the database
//(will only be run once when the program is completed)


$arfile = file_get_contents("tempRecipeJSON/testRecipes.json");

$sep = "\r\n";
$line = strtok($arfile, $sep);

while ($line !== false) {
    # do something with $line
    $linearray = json_decode($line, true);
    echo '<div>';
    echo '<p>' . $linearray["title"] . '</p>';
    $ingarray = $linearray["ingredients"];
    
    $linecount = 0;
    foreach($ingarray as $ing){
        $ifound = false;
        
        //check if $ing contains a valid ingredient
        
        // 1st, attempt matching the words (removing words within parentheses) by checking if all words are included.
        
        // output data of each row
        foreach($dbings as $ingrow){
            //remove parentheses and words within
            $name = $ingrow["name"];

            $pos = strpos($name, '(');

            while($pos !== false){
                $endpos = strpos($name, ')');
                $name = str_replace(substr($name,$pos,($endpos - $pos) + 1),'',$name);
                $pos = strpos($name, '(');
                echo '<p>'. $name .'</p>';
            }
            // if the ingredient contains the dbingredient, query it to find the best match
            // if ingredient is wrong, just continue to the next row of the ingredients db
            if(strpos($ing,$name) === false){
                continue;
            }

            $sql = "SELECT name FROM ingredients WHERE name LIKE '%" . $name . "%'";
            $result = $conn->query($sql);

            //accept whichever result has the most characters/words and is contained within $ing
            $ingmax = "";
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $exprow = explode("",$row["name"]);
                    $corri = true; //tracks whether this ingredient may be correct based on content
                    foreach($exprow as $word){
                        $pos = strpos($ing, $word);
                        if($pos === false){
                            //this is not the right ingredient, continue with the next iteration...
                            $corri = false;
                            break;
                        }
                    }
                    if($corri === true){
                        //if this ingredient is bigger than the previous max, replace it
                        if(strlen($row["name"]) > strlen($ingmax)){
                            $ingmax = $row["name"];
                        }
                    }
                }
            } else {
                echo '<p>UNEXPECTED ERROR: valid ingredient name not found</p>';
            }
            //found the ingredient, break and move onto the next ingredient in the recipe

            echo '<div>';
            echo '<p>JSON ingredient: ' . $ing . '</p>';
            echo '<p>Closest ingredient: ' . $ingmax . '</p>';
            echo '</div>';
            $ifound = true;
            break;
        }
        //If no ingredient in the db matches the one in the json, print that it is invalid
        //TODO if ingredient is invalid (not found in ingredients db), the final code should ignore the entire recipe.
        //output line number of invalid ingredients until we have a serviceable recipe database?
        if(!$ifound){
            echo '<p> Invalid ingredient: ' . $ing . ' on line ' . $linecount . '</p>';
        }
        $linecount++;
    }
    
    # if all ingredients are valid, insert into database
    //TODO assign tags based on the included ingredients (ingredients should have tags?)
    // AND based on recipe name (if the name has "Salad", tag it "Salad"?)
    $sql = "INSERT INTO ";
    //$conn->query($sql);
    
    echo '</div>';
    # iterate
    $line = strtok( $sep );
}


// Query that selects recipes which only contain ingredients from the constraint list
$sql = "CALL SRecBasedOnIng( '" . $imploded_data . "' );";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    //use echos within a loop to generate the gallery
    while($row = $result->fetch_assoc()) {        
        /*
        <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="Salad, Easy, Light" onclick="location.href='index.html'"><div><img src="assets/images/mbr-10-1920x1280-800x533.jpg" alt="" title=""><span class="icon-focus"></span><span class="mbr-gallery-title mbr-fonts-style display-7">Caprese Salad</span></div></div>
        */
        echo '<div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags=' 
            . $row["tags"] 
            . ' onclick="window.open(\'' . $row["link"] . '\'' . ', &quot;' . '_blank&quot;)' . '">';
        echo '<div class="crop">';
        echo '<img src="' . $row["imglink"] . '" alt="" title="">';
        echo '<span class="icon-focus"></span>';
        echo '<span class="mbr-gallery-title mbr-fonts-style display-7">' . $row["name"] . '</span>';
        echo '</div>';
        
        echo '</div>';
        
    //echo "id: " . $row["id"]. " - Link: " . $row["link"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    //echo "0 results";
}

echo '</div>';

?>

<script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/masonry/masonry.pkgd.min.js"></script>
  <script src="assets/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/nav-dropdown.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/vimeoplayer/jquery.mb.vimeo_player.js"></script>
  <script src="assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/gallery/player.min.js"></script>
  <script src="assets/gallery/script.js"></script>
  <script src="assets/slidervideo/script.js"></script>

<?php
    $conn->close();
    //mysqli_close($conn);
?>