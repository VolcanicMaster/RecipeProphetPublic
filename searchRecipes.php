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

//TODO use echos within a loop to generate the gallery?

//TODO3 searchForRecipes that returns a sorted list of recipes
//TODO3.1 query recipeDatabase so that it returns only the recipes that fit the constraints (ease,weight for now)
//TODO3.2 if we can use a query to do the filter we want on ingredients, do that

$sql = "SELECT id, link, name, tags, imglink FROM recipes";

// we need php to gain access to the indexeddb contents
$result = $conn->query($sql);
$resultArray = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $rowArray = array();
        //$rowArray[] = $row["id"];
        $rowArray[] = $row["name"];
        $rowArray[] = $row["link"];
        $rowArray[] = $row["imglink"];
        $rowArray[] = $row["tags"];
        $resultArray[] = $rowArray;
        
        //TODO echo from within this loop, then if it works delete the unnecessary vars
        /*
        <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="Salad, Easy, Light" onclick="location.href='index.html'"><div><img src="assets/images/mbr-10-1920x1280-800x533.jpg" alt="" title=""><span class="icon-focus"></span><span class="mbr-gallery-title mbr-fonts-style display-7">Caprese Salad</span></div></div>
        */
        //TODO do the tags need extra quotes?
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
<script>
    //Do logs work on pages that aren't in the front?
    console.log("log from searchRecipes.php");
    
    //TODO figure out why database recipes aren't showing? Gallery is being replaced, but EITHER
    //  1. the code isn't running? (we know php code runs because we tested the array before) OR
    //  2. the database isn't being accessed correctly, returning an empty list
    
    //TODO JS code doesn't appear to be running: RECREATE THIS IN PHP
    
    const newRecipeGallery = document.getElementById('newRecipeProphetRecipeGallery');

        //remove all existing children from recipeGallery
        /*while (recipeGallery.firstChild) {
              recipeGallery.removeChild(recipeGallery.firstChild);
            }*/
    
    //var listOfRecipes = [["testName","testLink","testImage","testTags"]];
    //var listOfRecipes = [["Caprese Salad","index.html","assets/images/mbr-10-1920x1280-800x533.jpg","Salad, Easy, Light"]];
    var listOfRecipes = [];
    
    //Testing if JS code runs
    var recipeArray = ["Caprese Salad","index.html","assets/images/mbr-10-1920x1280-800x533.jpg","Salad, Easy, Light"];
    listOfRecipes.push(recipeArray);
    
    //TODO3 searchForRecipes that returns a sorted list of recipes
    //TODO3.1 query recipeDatabase so that it returns only the recipes that fit the constraints (ease,weight for now)
    //TODO3.2 if we can use a query to do the filter we want on ingredients, do that

    <?php
        $sql = "SELECT id, link, name, tags, imglink FROM recipes";
    ?>

    // we need php to gain access to the indexeddb contents
    <?php
        $result = $conn->query($sql);
        $resultArray = array();

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $rowArray = array();
                $rowArray[] = $row["id"];
                $rowArray[] = $row["link"];
                $rowArray[] = $row["name"];
                $rowArray[] = $row["tags"];
                $rowArray[] = $row["imglink"];
                $resultArray[] = $rowArray;
            //echo "id: " . $row["id"]. " - Link: " . $row["link"]. " - Name: " . $row["name"]. "<br>";
            }
        } else {
            //echo "0 results";
        }
    ?>
    var encodedQueryResult = <?php echo json_encode($resultArray) ?>;

    //TODOeventually compile a string for the tags when we have to enter the recipes into the db automatically

    //TODOeventually combine the two for loops (directly from encodedQueryResult, no need for listOfRecipes)
    var i;
    for(i = 0; i < encodedQueryResult.length; i++){
        var queryRecipeArray = encodedQueryResult[i];
        var recipeArray = ["Caprese Salad","index.html","assets/images/mbr-10-1920x1280-800x533.jpg","Salad, Easy, Light"];
        recipeArray[0] = queryRecipeArray[2];//recipe name
        recipeArray[1] = queryRecipeArray[1];//recipe link
        recipeArray[2] = queryRecipeArray[4];//recipe image link
        recipeArray[3] = queryRecipeArray[3];//recipe tags
        listOfRecipes.push(recipeArray);
    }

    //displayRecipes that empties and fills the recipeGallery with that list of recipes

    var i;
    for(i = 0; i < listOfRecipes.length; i++)
    {
        recipe = listOfRecipes[i];

        //create and add a new html element to recipeGallery
        /*
        <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="Salad, Easy, Light" onclick="location.href='index.html'"><div><img src="assets/images/mbr-10-1920x1280-800x533.jpg" alt="" title=""><span class="icon-focus"></span><span class="mbr-gallery-title mbr-fonts-style display-7">Caprese Salad</span></div></div>
        */
        const galleryItem = document.createElement('div');
        galleryItem.className = "mbr-gallery-item mbr-gallery-item--p1";
        galleryItem.setAttribute("data-video-url","false");
        //substring removes quote in tags
        galleryItem.setAttribute("data-tags",recipe[3].substring(1,recipe[3].length - 1)); // tags
        onclickAttribute = "location.href='" + recipe[1] + "'";
        galleryItem.setAttribute("onclick",onclickAttribute); // link to recipe

        const galleryContent = document.createElement('div');
        const galleryImage = document.createElement('img');
        galleryImage.setAttribute("src",recipe[2]); // image
        galleryImage.setAttribute("alt","");
        galleryImage.setAttribute("title","");
        const gallerySpanFocus = document.createElement('span');
        gallerySpanFocus.className="icon-focus";
        const gallerySpanTitle = document.createElement('span');
        gallerySpanTitle.className = "mbr-gallery-title mbr-fonts-style display-7";
        gallerySpanTitle.textContent = recipe[0]; // name

        galleryContent.appendChild(galleryImage);
        galleryContent.appendChild(gallerySpanFocus);
        galleryContent.appendChild(gallerySpanTitle);
        galleryItem.appendChild(galleryContent);
        newRecipeGallery.appendChild(galleryItem);
    }
</script>

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

//echo '<pre>'; print_r($data); echo '</pre>';

?>

<?php
    $conn->close();
    //mysqli_close($conn);
?>