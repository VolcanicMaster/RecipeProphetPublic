<body>
    <!--<div id="newRecipeProphetRecipeGallery"></div>-->
</body>

<?php
    include "scripts/dbConnect.php"
?>
<?php
        
//TODO This alone DOES NOT work to keep the page behind a login.
//session_start();
//
//if (!isset($_SESSION['loggedin'])) {
//    header('Location: adminLogin.php');
//    exit; 
//}

        //TODO there could be an issue with the length of $data
        
$data = file_get_contents( "php://input" ); //$data is now the string '[1,2,3]';

$data = json_decode( $data ); //$data is now a php array array(1,2,3)

//for each ingredient, add slash quotes around it.
/*foreach($data as &$ing){
    $ing = '\'' . $ing . '\'';
}*/
/*
foreach($data as &$ing){
    $ing = "\'" . $ing . "\'";
}*/

//$imploded_data = implode( "', '", $data); //original
//$imploded_data = implode( '\', \'', $data);
//$imploded_data = implode( "\", \"", $data);
//$imploded_data = implode( "\', \'", $data);
//$imploded_data = implode( ", ", $test_array); //

//TODO the problem IS with implosion itself. But what? Test further.
//TODO implode test_string so you know what it is.
//$test_array = array("Egg","Mozzarella (Cheese)");
//$imploded_data = implode( "\', \'", $test_array);
//$imploded_data = "\'" . $imploded_data .  "\'";

$imploded_data = implode( "\', \'", $data);
$imploded_data = "\'" . $imploded_data .  "\'";

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

// echo everthing in "rPRecipeContainer" that comes before recipeProphetRecipeGallery
/*
<div id="rPRecipeContainer" class="container">
            <div><!-- Filter --><div class="mbr-gallery-filter container gallery-filter-active"><ul buttons="0"><li class="mbr-gallery-filter-all"><image width="50" src="assets/images/undo.png" onclick="history.back()"></image><a class="btn btn-md btn-primary-outline active display-7" href="">All</a></li></ul></div><div><center><a href="keepSearchingErrorPrompt.php">Keep Searching for Recipes</a></center></div><!-- Gallery --><div class="mbr-gallery-row"><div class="mbr-gallery-layout-default"><div>
*/
/*
echo '<div id="rPRecipeContainer" class="container">';
echo '<div><!-- Filter --><div class="mbr-gallery-filter container gallery-filter-active"><ul buttons="0"><li class="mbr-gallery-filter-all"><image width="50" src="assets/images/undo.png" onclick="history.back()"></image><a class="btn btn-md btn-primary-outline active display-7" href="">All</a></li></ul></div><div><center><a href="keepSearchingErrorPrompt.php">Keep Searching for Recipes</a></center></div><!-- Gallery --><div class="mbr-gallery-row"><div class="mbr-gallery-layout-default"><div>';*/

echo '<div id="newRecipeProphetRecipeGallery">';

//searchForRecipes that returns a sorted list of recipes

//TODO uncomment this block when you want to add json recipes to db. 
/*
//Query for ingredients
$sql = "SELECT name FROM ingredients;";
$result = $conn->query($sql);
$dbings = array();
if($result->num_rows > 0){
    echo '<p>if ingres</p>';
    while($row = $result->fetch_assoc()){
        //echo '<p>'. $row["name"] .'</p>';
        $dbings[] = $row;
    }
}
//echo "<p>dbings length: ". count($dbings) ."</p>";

//TODO only read the json file, and add ingredients manually based on what is invalid
//TODO split the json file into parts so it can actually run? (like allrecipes100.json)

//TODO put both the script and html for the tag selection into this php ("rPRecipeContainer"?)

$arfile = file_get_contents("tempRecipeJSON/allrecipes100.json");

$sep = "\r\n";
$line = strtok($arfile, $sep);

while ($line !== false) {
    # do something with $line
    $linearray = json_decode($line, true);
    echo '<div>';
    echo '<p>' . $linearray["title"] . '</p>';
    $ingarray = $linearray["ingredients"];
    
    $recings = array();
    
    $skipre = false;
    foreach($ingarray as $ing){
        $ing = strtolower($ing);
        $ifound = false;
        
        $ingmax = 0;
        $ingnam = "";
        $imaxid = "";
        $imaxta = "";
        $imaxop = 0;
        
        //check if $ing contains a valid ingredient
        
        //IF IT HAS A COLON, IGNORE THAT INGREDIENT (so it doesn't invalidate)
        if(strpos($ing, ':') !== false){
            continue;
        }
        
        // 1st, attempt matching the words (removing words within parentheses) by checking if all words are included.
        
        // output data of each row
        foreach($dbings as $ingrow){
            //remove parentheses and words within
            $name = strtolower($ingrow["name"]);

            $pos = strpos($name, '(');
            while($pos !== false){
                $endpos = strpos($name, ')');
                $name = str_replace(substr($name,$pos,($endpos - $pos) + 1),'',$name);
                $pos = strpos($name, '(');
            }
            $name = trim($name);
            
            // if the ingredient contains the dbingredient, query it to find the best match
            // if ingredient is wrong, just continue to the next row of the ingredients db
            if(strpos($ing,$name) === false){
                continue;
            }

            $sql = "SELECT name, id, tags FROM ingredients WHERE name LIKE '%" . $name . "%'";
            $result = $conn->query($sql);

            //accept whichever result has the most matching characters/words and is contained within $ing
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    //echo "<p>begin LIKE name fetch</p>";
                    //overriding $name for a different use. could be ill-advised.
                    $name = strtolower($row["name"]);

                    $pos = strpos($name, '(');
                    while($pos !== false){
                        $endpos = strpos($name, ')');
                        $name = str_replace(substr($name,$pos,($endpos - $pos) + 1),'',$name);
                        $pos = strpos($name, '(');
                    }
                    $name = trim($name);
                    
                    $exprow = explode(" ",$name);
                    $newlen = 0;
                    $corri = true; //tracks whether this ingredient may be correct based on content
                    foreach($exprow as $word){
                        //echo "<p>begin exprow word fetch, word: ". $word ."</p>";
                        $pos = strpos($ing, $word);
                        if($pos === false){
                            //This is not the right ingredient, continue with the next iteration...
                            $corri = false;
                            break;
                        } else {
                            $newlen = $newlen + strlen($word);
                        }
                        echo "<p>newlen of ". $name ." is now:". $newlen ."</p>";
                    }
                    if($corri === true){
                        //if this ingredient is bigger than the previous max, replace it
                        if($newlen > $ingmax){
                            $ingmax = $newlen;
                            $ingnam = $row["name"];
                            echo "<p>newlen > ingmax. name: ". $ingnam ."</p>";
                            $imaxid = $row["id"];
                            $imaxta = $row["tags"];
                            //use parsing to determine whether this ingredient is optional
                            if(strpos($ing,"(optional)") !== false){
                                $imaxop = 1;
                            }
                        }
                    }
                }
                if($ingnam == ""){
                    echo '<p>corri never returned true</p>';
                    continue;
                }
            } else {
                echo '<p>UNEXPECTED ERROR: valid ingredient name not found</p>';
            }
            //don't add it yet, complete the loop and find the max among all iterations of this jsoning. 
            //found the ingredient

            $ifound = true;
        }
        //If no ingredient in the db matches the one in the json, print that it is invalid
        //output line number of invalid ingredients until we have a serviceable recipe database?
        if($ifound){
            echo '<div>';
            echo '<p>JSON ingredient: ' . $ing . '</p>';
            echo '<p>Closest ingredient: ' . $ingnam . '</p>';
            echo '</div>';
            $recings[] = array("id" => $imaxid, "opt" => $imaxop, "tags" => $imaxta);
        } else {
            echo '<p> Invalid ingredient: ' . $ing . '</p>';
            //if ingredient is invalid (not found in ingredients db), the final code should ignore the entire recipe.
            //skip to the next recipe
            $skipre = true;
            break;
        }
    }
    
    if(!$skipre){

        # if all ingredients are valid, insert into database

        $ilink = $linearray["photo_url"];

        $link = $linearray["url"];

        $name = $linearray["title"];

        $tags = "";
        //TODO: before DB UPLOAD, add tags to every ingredient in the database
        // assign tags based on the included ingredients (ingredients should have tags?)
        // AND based on recipe name (if the name has "Salad", tag it "Salad"?)
        $lname = strtolower($name);
        if(strpos($lname,"salad") !== false){
            $tags = $tags . "Salad,";
        }
        if(strpos($lname,"spicy") !== false){
            $tags = $tags . "Spicy,";
        }
        if(strpos($lname,"thai") !== false){
            $tags = $tags . "Thai,";
        }
        if(strpos($lname,"chinese") !== false){
            $tags = $tags . "Chinese,";
        }
        if(strpos($lname,"japanese") !== false){
            $tags = $tags . "Japanese,";
        }
        if(strpos($lname,"american") !== false){
            $tags = $tags . "American,";
        }
        if(strpos($lname,"indian") !== false){
            $tags = $tags . "Indian,";
        }
        //read tags like Lactose or NotVegan that don't actually show up as a filter, but are used to create Lactose-Free and Vegan tags for recipes here?
        $vegan = true;
        $lacfree = true;
        $peanutf = true;
        foreach($recings as $recing){
            if(strpos($recing["tags"],"NotVegan") !== false){
                $vegan = false;
                continue;
            }
            if(strpos($recing["tags"],"Lactose") !== false){
                $lacfree = false;
                continue;
            }
            if(strpos($recing["tags"],"Peanut") !== false){
                $peanutf = false;
                continue;
            }
            $tags = $tags . $recing["tags"] . ",";
        }
        if($vegan){
            $tags = $tags . "Vegan,";
        }
        if($lacfree){
            $tags = $tags . "Lactose-Free,";
        }
        if($peanutf){
            $tags = $tags . "Peanut-Free,";
        }
        //remove trailing comma(s?)
        $tags = trim($tags, ",");
        echo "<p>tags: ". $tags ."</p>";
        //remove repeated commas
        $pos = strpos($tags,",,");
        while($pos !== false){
            $tags = str_replace(",,",",",$tags);
            //iterate
            $pos = strpos($tags,",,");
        }
        //remove duplicate tags
        $tags = implode(',',array_unique(explode(',', $tags)));
        echo "<p>tags after eximplode: ". $tags ."</p>";
        //may not be necessary, but clean?
        $tags = trim($tags, ",");

        echo "<p>INSERTING...</p>";
        $sql = 'INSERT INTO recipes(imglink,link,name,tags) VALUES("'. $ilink .'","'. $link .'","'. $name .'","'. $tags .'");';
        $conn->query($sql);

        //Then, insert the ingredients into recipeIngredients

        //find the recipe_id this connection just added
        //$sql = 'SELECT LAST_INSERT_ID();';
        //$recid = $conn->query($sql);
        $recid = mysqli_insert_id($conn);

        foreach($recings as $recing){
            $sql = 'INSERT INTO recipeIngredients(ingredient_id,recipe_id,optional) VALUES("'. $recing["id"] .'","'. $recid .'","'. $recing["opt"] .'");';
            $conn->query($sql);
        }
    }
    echo '</div>';
    # iterate
    $line = strtok( $sep );
}
*/


//TODO do extensive testing to figure out if any of the below TODOs are still issues. 
//TODO THE PROBLEM IS: not all ids between the first and last are present. 101 recipes but after 1,2,3 it jumps to 18__.
//TODOmaybe: 1841 repeats ingredients, as does 1835, both of which have no egg. 1830 repeats ing 13 only, no egg. 1753 repeats ing 111.
//TODO not displaying recipes at all. Could have to do with our additions of '\
//Our code has no issue displaying large amounts of recipes (tested with 100). Though eventually we should limit the query

// Query that selects recipes which only contain ingredients from the constraint list
//$conn->real_escape_string($imploded_data);
$sql = "CALL SRecBasedOnIng( '" . $imploded_data . "' );"; //
//$test_string = '\'Egg\',\'Mozzarella (Cheese)\''; //outermost quote type doesn't matter if it's concatenated later
//test_string is already escaped, real escape string returns the same thing.

//$sql = "CALL SRecBasedOnIng('" . $test_string . "');"; //This does not work
//$sql = "SELECT * FROM recipes;"; //This works
//$sql = "CALL SRecBasedOnIng(\"\'Egg\',\'Mozzarella (Cheese)\'\");"; //THIS LINE WORKS!
//$sql = "CALL SRecBasedOnIng(\"" . $test_string . "\");"; //THIS WORKS!
//$sql = "CALL SRecBasedOnIng( \"" . $imploded_data . "\" );"; //This doesn't work? maybe because of the implosion code?
//$sql = 'CALL SRecBasedOnIng( \"' . $imploded_data . '\" );';

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    //use echos within a loop to generate the gallery
    while($row = $result->fetch_assoc()) {        
        /*
        <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="Salad, Easy, Light" onclick="location.href='index.html'"><div><img src="assets/images/mbr-10-1920x1280-800x533.jpg" alt="" title=""><span class="icon-focus"></span><span class="mbr-gallery-title mbr-fonts-style display-7">Caprese Salad</span></div></div>
        */
        echo '<div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="' 
            . $row["tags"] 
            . '" onclick="window.open(\'' . $row["link"] . '\'' . ', &quot;' . '_blank&quot;)' . '">';
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

//echo everthing in "rPRecipeContainer" that comes after recipeProphetRecipeGallery
/*
</div><div class="clearfix"></div></div></div><!-- Lightbox --><div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery1-8"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><ol class="carousel-indicators"><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="0"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="1"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="2"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="3"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="4"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="5"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="6"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" class=" active" data-slide-to="7"></li></ol><div class="carousel-inner"><div class="carousel-item"><img src="assets/images/mbr-10-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-1920x1287.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-5-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-9-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-3-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-1920x1281.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-7-1920x1280.jpg" alt="" title=""></div><div class="carousel-item active"><img src="assets/images/mbr-1920x1279.jpg" alt="" title=""></div></div><a class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#lb-gallery1-8"><span class="mbri-left mbr-iconfont" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control carousel-control-next" role="button" data-slide="next" href="#lb-gallery1-8"><span class="mbri-right mbr-iconfont" aria-hidden="true"></span><span class="sr-only">Next</span></a><a class="close" href="#" role="button" data-dismiss="modal"><span class="sr-only">Close</span></a></div></div></div></div></div>
        </div>
        */
/*
echo '</div><div class="clearfix"></div></div></div><!-- Lightbox --><div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery1-8"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><ol class="carousel-indicators"><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="0"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="1"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="2"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="3"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="4"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="5"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="6"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" class=" active" data-slide-to="7"></li></ol><div class="carousel-inner"><div class="carousel-item"><img src="assets/images/mbr-10-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-1920x1287.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-5-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-9-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-3-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-1920x1281.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-7-1920x1280.jpg" alt="" title=""></div><div class="carousel-item active"><img src="assets/images/mbr-1920x1279.jpg" alt="" title=""></div></div><a class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#lb-gallery1-8"><span class="mbri-left mbr-iconfont" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control carousel-control-next" role="button" data-slide="next" href="#lb-gallery1-8"><span class="mbri-right mbr-iconfont" aria-hidden="true"></span><span class="sr-only">Next</span></a><a class="close" href="#" role="button" data-dismiss="modal"><span class="sr-only">Close</span></a></div></div></div></div></div>
        </div>';*/

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