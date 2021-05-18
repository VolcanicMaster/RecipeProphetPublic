<html  >
<head>
  <!-- Site made partly with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/mbr-122x158.png" type="image/x-icon">
  <meta name="description" content="Website Creator Description">
  
  
  <title id=title>Account: Recipe Prophet</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/gallery/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    
    
    <!--redirect to login page if $_SESSION['id'] is not set-->
    <?php
    session_start();
    if (!isset($_SESSION['id'])){
        header('Location: login.php');
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'var userid = ' . json_encode($_SESSION['id']) . ';';
        echo '</script>';
    }
    ?>
    
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
        .crop {
            width: 400px; /* 200 */
            height: 225px; /* 150 */
            overflow: hidden;
        }
        .crop img {
            width: 400px;  /* 400 */
            height: 225px; /* 300 */
            object-fit: cover;
            /*margin: 0 0 0 0;*/
        }
        /*editing styling of existing class*/
        .mbr-gallery-item {
            margin-left: 100px;
            margin-right: 100px;
        }
        
        .loader {
          /*border: 16px solid #f3f3f3; /* Light grey */
          border-top: 16px solid #3498db; /* Blue */
          border-radius: 50%;
          width: 120px;
          height: 120px;
          animation: spin 2s ease infinite;
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
        
        
        
        /* The sidebar menu */
        .sidebar {
          height: 100%; /* 100% Full-height */
          width: 10%; /* 0 width - change this with JavaScript */
          position: fixed; /* Stay in place */
          z-index: 1; /* Stay on top */
          top: 0;
          left: 0;
          background-color: #111; /* Black*/
          overflow-x: hidden; /* Disable horizontal scroll */
          padding-top: 160px; /* Place content 60px from the top */
          transition: 0.5s; /* 0.5 second transition effect to slide in the sidebar */
        }

        /* The sidebar links */
        .sidebar li, .sidebar a {
          text-decoration: none;
          color: #818181;
          display: block;
          transition: 0.3s;
        }
        .sidebar a{
            padding: 8px 8px 8px 32px;
            font-size: 25px;
        }
        /* When you mouse over the navigation links, change their color */
        .sidebar li:hover, .sidebar a:hover {
          color: #f1f1f1;
        }
        
        #main {
            padding: 20px;
            margin-left: 10%; /*same as width of sidebar*/
        }

        .show {display: block;}
        
        .hide {
          display:none;
        }
    </style>
  
</head>
<body>
<div id="accountMenu" class="sidebar">
    <!--use sidebar as menu? not collapsible this time-->
    <!--<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times; CLOSE</a>-->
    <div >
        <button class="btn btn-sm btn-primary display-4" onclick="getUserIDAndSendToGetRecents()">Recently Viewed Recipes</button>
        <button class="btn btn-sm btn-primary display-4" onclick="getPreferences()">Preferences</button>
    </div>
</div>
    <div id="main">
  <section class="menu cid-qTkzRZLJNu" once="menu" id="menu1-7">

    

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                         <img src="assets/images/mbr-122x158.png" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a id=recipeProphetHomeButton class="navbar-caption text-white display-4" href="index.php">
                        Recipe Prophet</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item">
                    <!--<a class="nav-link link text-white display-4" href="index.php"><span class="mbri-info mbr-iconfont mbr-iconfont-btn"></span>
                        
                        About Us
                    </a>-->
                </li></ul>
            <div class="navbar-buttons mbr-section-btn"><!--<a class="btn btn-sm btn-primary display-4" href="index.php"><span class="mbri-question mbr-iconfont mbr-iconfont-btn"></span>
                    Help</a>--></div>
        </div>
    </nav>
</section>

<section id="ingredientsAndGallerySection">
    
    <section class="mbr-gallery mbr-slider-carousel cid-rXMgNWDBnJ" id="gallery1-8">



        <div id="rPRecipeContainer" class="container">
            <div><!-- Filter --><!--<div class="mbr-gallery-filter container gallery-filter-active"><ul buttons="0"><li class="mbr-gallery-filter-all"><image width="50" src="assets/images/undo.png" onclick="history.back()"></image><a class="btn btn-md btn-primary-outline active display-7" href="">All</a></li></ul></div>--><div><center><!--<a href="page1.php">Keep Searching for Recipes</a>--></center></div><!-- Gallery --><div class="mbr-gallery-row"><div class="mbr-gallery-layout-default"><div><div id="recipeProphetRecipeGallery"><!--loading circle here--></div></div><div class="clearfix"></div></div></div><!-- Lightbox --><div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery1-8"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><ol class="carousel-indicators"><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="0"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="1"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="2"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="3"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="4"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="5"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="6"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" class=" active" data-slide-to="7"></li></ol><div class="carousel-inner"><div class="carousel-item"><img src="assets/images/mbr-10-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-1920x1287.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-5-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-9-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-3-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-1920x1281.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-7-1920x1280.jpg" alt="" title=""></div><div class="carousel-item active"><img src="assets/images/mbr-1920x1279.jpg" alt="" title=""></div></div><a class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#lb-gallery1-8"><span class="mbri-left mbr-iconfont" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control carousel-control-next" role="button" data-slide="next" href="#lb-gallery1-8"><span class="mbri-right mbr-iconfont" aria-hidden="true"></span><span class="sr-only">Next</span></a><a class="close" href="#" role="button" data-dismiss="modal"><span class="sr-only">Close</span></a></div></div></div></div></div>
        
        </div>

    </section>
</section>
</div>

    <?php
        include "scripts/dbConnect.php"
    ?>
    <?php
            //log php output via js
            function console_log($output, $with_script_tags = true) {
            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
                if ($with_script_tags) {
                    $js_code = '<script>' . $js_code . '</script>';
                }
                echo $js_code;
            }    
    
            //$test_string = '\'Egg\',\'Mozzarella (Cheese)\'';
            //escaping is not necessary / does not work if it's already escaped
            //$test_string = $conn->real_escape_string($test_string);
            //console_log($test_string);
    ?>
    <script src="scripts/databaseManipulator.js"></script>
    <script src="scripts/dropdownSelection.js"></script>
    <!--<script src="scripts/recipeSearch.js"></script>-->
    <script>
        const recipeGallery = document.getElementById('recipeProphetRecipeGallery');   
                
        //linked to Preferences button
        //send the userID to getPreferences.php, then display the output (the radio button lists or whatever it is will show the current setting)
        function getPreferences(){
            if(recipeGallery.parentNode == null || recipeGallery == null){}else{
                console.log("entered getLOIEtc");
                
                //remove all existing children from recipeGallery
                while (recipeGallery.firstChild) {
                      recipeGallery.removeChild(recipeGallery.firstChild);
                }
                
                //create div with class loader
                const loader = document.createElement('div');
                loader.className = 'loader';
                recipeGallery.appendChild(loader);
                
                var xmlhttp = new XMLHttpRequest;

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //do display results code in searchRecipes.php, then put the responseText in the gallery
                        console.log("entered onreadystatechange");
                        let doc = new DOMParser().parseFromString(this.responseText, 'text/html');
                        let newRecipeGallery = doc.getElementById("newRecipeProphetRecipeGallery");
                        //let newRecipeGallery = doc.getElementById("rPRecipeContainer");
                        recipeGallery.replaceChild(newRecipeGallery, loader);
                        
                        //for each element in exclusionData, VISUALLY add the ingredients to match the database.
                        let excData = document.getElementById("exclusionData");
                        while(excData.firstChild){
                            createListItem(excData.firstChild.getAttribute("data-exc-name"),excData.firstChild.getAttribute("data-exc-id"));
                            excData.removeChild(excData.firstChild);
                        }
                        
                        console.log("ended onreadystatechange");
                      }
                }

                xmlhttp.open( "POST", "getPreferences.php" );
                xmlhttp.setRequestHeader( "Content-Type", "text/plain" );
                xmlhttp.send(userid);
            }
        }
        
        //linked to I'm Vegan button in Preferences
        //Preferences: VISUALLY add Vegan ingredients to the user's exclusions
        function addVeganIngs(){
            //done manually to reduce server load since the ingredients will rarely change
            createListItem("Egg","1");
            createListItem("Chicken","9");
            createListItem("Mozzarella (Cheese)","10");
            createListItem("Honey","61");
            createListItem("Cheddar (Cheese)","25");
            createListItem("Brie (Cheese)","26");
            createListItem("Gouda (Cheese)","27");
            createListItem("Feta (Cheese)","28");
            createListItem("Parmesan (Cheese)","29");
            createListItem("Mascarpone (Cheese)","30");
            createListItem("(Pecorino) Romano (Cheese)","31");
            createListItem("Camembert (Cheese)","32");
            createListItem("Cream Cheese","33");
            createListItem("Provolone (Cheese)","34");
            createListItem("Gorgonzola (Cheese)","35");
            createListItem("Stilton (Cheese)","36");
            createListItem("Manchego (Cheese)","37");
            createListItem("Monterey Jack (Cheese)","38");
            createListItem("Gruyere (Cheese)","39");
            createListItem("Blue Cheese","40");
            createListItem("Goat Cheese","41");
            createListItem("Whey","42");
            createListItem("Milk","43");
            createListItem("Sausage","103");
            createListItem("Ham","104");
            createListItem("Pepperoni","109");
            createListItem("Pepperjack (Cheese)","110");
            createListItem("Asiago (Cheese)","119");
            createListItem("Cottage (Cheese)","123");
            createListItem("Mayo","147");
            createListItem("Beef","165");
            createListItem("Fish","166");
            createListItem("Fish Sauce","167");
            createListItem("Tilapia","168");
            createListItem("Pork","169");
            createListItem("Lamb","170");
            createListItem("Duck","171");
            createListItem("Crab","172");
            createListItem("Clam","173");
            createListItem("Mussel","174");
            createListItem("Ice Cream","175");
            createListItem("Bacon","199");
            createListItem("Halibut","200");
            createListItem("American Cheese","202");
            createListItem("Muenster (Cheese)","206");
            createListItem("Soy (Sauce)","211");
            createListItem("Swiss (Cheese)","216");
            createListItem("Salami","223");
            createListItem("Tuna","225");
        }
        
        //linked to Clear All button in Preferences
        //Preferences: VISUALLY Remove all exclusions
        function clearExclusions(){
            const exclusionList = document.getElementById("ingredients");
            //remove all existing children from the ingredient list
            while (exclusionList.firstChild) {
                  exclusionList.removeChild(exclusionList.firstChild);
            }
            //readd title
            exclusionList.textContent = "Exclusions: ";
        }
        
        var ingids = [];
        //helper function to get the ingredient id from the html
        function getIngredientIDFromHTMLObject(item, index){
            //add id to ingids js array
            ingids.push(item.firstChild.content);
        }

        //linked to Save Changes button in Preferences
        //Preferences: Save visual changes to database
        function saveExclusions() {
            console.log("entered saveExclusions");
            var list = document.getElementById("ingredients");
            
            //check for oddities
            if(!list.hasChildNodes()){
                console.log("Unexpected: Exclusions title was not present");
               return;
            }
            //reset the array (just in case)
            ingids = [];
            //remove the first child "Exclusions: "
            list.removeChild(list.firstChild);
            //get all ids from the ingredient list
            list.childNodes.forEach(getIngredientIDFromHTMLObject);
            console.log("ids retrieved from ingredient list");    

            //send js array to php like in searchRecipes, convert ingids to php array.
            var xmlhttp = new XMLHttpRequest;

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //this part can be used to get the responseText and either display or just use it.
                    console.log("entered onreadystatechange for sendToProcessCustomIngredientList");
                    //let doc = new DOMParser().parseFromString(this.responseText, 'text/html');
                    //let resultObj = doc.getElementById("result");
                    //console.log(resultObj.textContent);

                    //TODO check for errors and keep them on the page if there's something wrong for some reason?

                    //send the user back to index.php and give them a pop up message saying the custom list has been added.
                    <?php
                    //$_SESSION['message'] = "Custom List added!"; 
                    //header('Location: index.php');
                    ?>
                }
            }

            xmlhttp.open( "POST", "processExclusions.php" );
            xmlhttp.setRequestHeader( "Content-Type", "application/json" );
            xmlhttp.send( JSON.stringify(ingids) );
            
            //readd title
            var textnode = document.createTextNode("Exclusions: ");
            list.insertBefore(textnode, list.firstChild);
        }
        
        //linked to Recently Viewed Recipes button
        //send the userID to getRecents.php, then display the output
        function getUserIDAndSendToGetRecents(){
            if(recipeGallery.parentNode == null || recipeGallery == null){}else{
                console.log("entered getLOIEtc");
                
                //remove all existing children from recipeGallery
                while (recipeGallery.firstChild) {
                      recipeGallery.removeChild(recipeGallery.firstChild);
                }
                
                //create div with class loader
                const loader = document.createElement('div');
                loader.className = 'loader';
                recipeGallery.appendChild(loader);
                
                var xmlhttp = new XMLHttpRequest;

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //do display results code in searchRecipes.php, then put the responseText in the gallery
                        console.log("entered onreadystatechange");
                        let doc = new DOMParser().parseFromString(this.responseText, 'text/html');
                        let newRecipeGallery = doc.getElementById("newRecipeProphetRecipeGallery");
                        //let newRecipeGallery = doc.getElementById("rPRecipeContainer");
                        recipeGallery.replaceChild(newRecipeGallery, loader);

                        console.log("ended onreadystatechange");
                      }
                }

                xmlhttp.open( "POST", "getRecents.php" );
                xmlhttp.setRequestHeader( "Content-Type", "text/plain" );
                xmlhttp.send(userid);
            }
        }
        
        //recipeSearchDone = false;
        
        if(recipeGallery.parentNode == null || recipeGallery == null){
           
        } else {
        
            /*//instead of setUpDatabase.onsuccess, listen for a change in the setUpCompleted variable?
            setUpCompleted.registerListener(function(val) {
                console.log("Changed the value of setUpCompleted.a to " + val);
                if(val == true && !recipeSearchDone){
                    getUserIDAndSendToGetRecents();
                    //Ensure that setUpCompleted is set back to false right after the functions finish
                    setUpCompleted.a = false;
                    recipeSearchDone = true;
                }
            });*/

            setUpDatabaseWithoutDisplay();
        }
        
        
    </script>
    
    <?php

        $conn->close();
        //mysqli_close($conn);

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
  
</body>
</html>