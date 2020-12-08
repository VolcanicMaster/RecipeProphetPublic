<?php
    include "scripts/dbConnect.php"
?>
<?php
        

echo '<div id="newRecipeProphetRecipeGallery">';

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

$arfile = file_get_contents("tempRecipeJSON/allrecipes1000to1500.json"); //last completed: allrecipes1000to1500

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


echo '</div>';


?>
<!--
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
  <script src="assets/slidervideo/script.js"></script>-->

<?php
    $conn->close();
    //mysqli_close($conn);
?>