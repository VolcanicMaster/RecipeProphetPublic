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

//TODO searchForRecipes that returns a sorted list of recipes
//TODO query recipeDatabase so that it returns only the recipes that fit the constraints (ease,weight for now)

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



//TODO get list of ingredients and insert that into our ingredients database for reference here
//TODO use a fuzzy search with the ingredients database entries as inputs and 
//      they'll be searching each ingredient for each recipe


/*
$ingredientsfile = file_get_contents("tempRecipeJSON/testIngredients.json");

$ingredients = json_decode($ingredientsfile);

foreach($ingredients as $row){
    $sql = "INSERT INTO ingredients(name, pictureLink) VALUES ('".$row["name"]."', '".$row["photo_url"]."')";
    mysqli_query($conn, $sql);
}

echo "<p>Ingredients Data Inserted</p>";

*/

//TODO put code here that reads test json file with 2 entries and submits it to the database
//(will only be run once when the program is completed)


$allrecipesfile = file_get_contents("tempRecipeJSON/testRecipes.json");

$separator = "\r\n";
$line = strtok($allrecipesfile, $separator);

while ($line !== false) {
    # do something with $line
    $linearray = json_decode($line, true);
    echo '<div>';
    echo '<div>' . $linearray["title"] . '</div>';
    $ingarray = $linearray["ingredients"];
    foreach($ingarray as &$ing){
        //check if $ing contains a valid ingredient
        echo '<div>     ' . $ing  . '</div>';
    }
    
    # if all ingredients are valid, insert into database
    $sql = "INSERT INTO ";
    //$conn->query($sql);
    
    echo '</div>';
    # iterate
    $line = strtok( $separator );
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