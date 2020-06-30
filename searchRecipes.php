<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/mbr-122x158.png" type="image/x-icon">
  <meta name="description" content="Website Creator Description">
  
  <title id=title>Searching for Recipes...</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/gallery/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    
    <style>
        #ingredientsSection {
            overflow:hidden;
            float:left;
            width: 220px;
        }
        #gallery1-8 {
           float: left;
        }
        #ingredients {
            margin-top: 100px;
        }
    </style>
  
</head>
<body>
    <!--<div id="newRecipeProphetRecipeGallery"></div>-->
</body>

<?php
    include "scripts/dbConnect.php"
?>
<?php

$data = file_get_contents( "php://input" ); //$data is now the string '[1,2,3]';

$data = json_decode( $data ); //$data is now a php array array(1,2,3)

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

//use echos within a loop to generate the gallery

//TODO searchForRecipes that returns a sorted list of recipes
//TODO query recipeDatabase so that it returns only the recipes that fit the constraints (ease,weight for now)

// Query that selects recipes which only contain ingredients from the constraint list
$sql = "SELECT r.id AS 'id', r.link AS 'link', r.name AS 'name', r.tags AS 'tags', r.imglink AS 'imglink'
FROM recipes r
WHERE r.id IN
(SELECT DISTINCT ri1.recipe_id
FROM recipeIngredients ri1
   --
   -- There should not exist an ingredient
   -- that is not part of our recipeIngredient.
   --
WHERE NOT EXISTS (
        SELECT *
        FROM ingredients ing
        WHERE 1=1
           -- extra clause: only want ingredients from a literal list
        AND ing.id IN (7,14)
           --  ... that is not part of our recipeIngredient...
        AND NOT EXISTS ( SELECT *
                FROM recipeIngredients ri2
                WHERE ri2.ingredient_id = ing.id
                AND ri2.recipe_id = ri1.recipe_id
                )
        )
)";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {        
        /*
        <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="Salad, Easy, Light" onclick="location.href='index.html'"><div><img src="assets/images/mbr-10-1920x1280-800x533.jpg" alt="" title=""><span class="icon-focus"></span><span class="mbr-gallery-title mbr-fonts-style display-7">Caprese Salad</span></div></div>
        */
        echo '<div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags=' 
            . $row["tags"] 
            . ' onclick="window.open(\'' . $row["link"] . '\'' . ', &quot;' . '_blank&quot;)' . '">';
        echo '<div>';
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