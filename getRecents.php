<body>
    <!--<div id="newRecipeProphetRecipeGallery"></div>-->
</body>

<?php
    include "scripts/dbConnect.php";
?>
<?php
        
        
$data = file_get_contents( "php://input" ); //$data is now a string like '[1,2,3]';

//$data = json_decode( $data ); //$data is now a php array array(1,2,3)

//$imploded_data = implode( "\', \'", $data);
//$imploded_data = "\'" . $imploded_data .  "\'";

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

// Query that selects recipes which only contain ingredients from the constraint list
//$sql = "CALL SRecBasedOnIng( '" . $imploded_data . "' );";
$sql = "CALL GetRecents('" . $data . "');";

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