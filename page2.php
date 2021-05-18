<html  >
<head>
  <!-- Site made partly with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/mbr-122x158.png" type="image/x-icon">
  <meta name="description" content="Website Creator Description">
  
  
  <title id=title>Display Recipes</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/gallery/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    
    <?php
    //This locks pages behind a login. We can use it for test versions of pages. When we want to update the main page we can just copy in the new page and add this login again.
    session_start();
    
    if (isset($_SESSION['loggedin'])) {
        header('Location: page2Test.php');
        exit; 
    }
    ?>
    
    <style>
        /*currently unused as it was replaced*/
        #ingredientsAndGallerySection {
            width: 100%;
        }
        #gallery1-8 {
           /*float: left;*/
            width: 100%;
	       margin: 0 auto;
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
          width: 0; /* 0 width - change this with JavaScript */
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

        /* Position and style the close button (top right corner) */
        .sidebar .closebtn {
          position: absolute;
          top: 0;
          right: 25px;
          font-size: 36px;
          margin-left: 300px;
        }

        /* The button used to open the sidebar */
        .openbtn {
          font-size: 20px;
          cursor: pointer;
          background-color: #111;
          color: white;
          padding: 10px 15px;
          border: none;
        }

        .openbtn:hover {
          background-color: #444;
        }

        #main {
          transition: margin-left .5s; /* If you want a transition effect */
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
          .sidebar {padding-top: 15px;}
          .sidebar a {font-size: 18px;}
        }
    </style>
    
    
  
</head>
<body>
<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times; CLOSE</a>
    <div >
        <button class="btn btn-sm btn-primary display-4" onclick="addDefaultIngs()">Add Common Ingredients</button>
        <!--TODO change this to an edit feature for Add Common Ingredients & readd custom list functionality and login when ready-->
        <!--<button class="createCustomIngredientListBtn btn btn-sm display-4" onclick="location.href = 'createCustomIngredientList.php';">
            <span class="mbri-plus mbr-iconfont mbr-iconfont-btn"></span>Create Custom Ingredient List <span class="mbri-sites mbr-iconfont mbr-iconfont-btn"></span></button>-->
        <button class="btn btn-md btn-secondary display-4" onclick="clearIndexedDB()">Clear All</button>
    </div>
    <ul name="ingredients" id="ingredients">Ingredients: </ul>
</div>
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
            <!--<ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="index.php"><span class="mbri-info mbr-iconfont mbr-iconfont-btn"></span>
                        
                        About Us
                    </a>
                </li></ul>-->
            <div class="navbar-buttons mbr-section-btn">
                <a id="loginBtn" class="btn btn-sm btn-primary display-4" href="login.php">
                    <!--TODO add favorites page mbri-star-->
                    <span class="mbri-login mbr-iconfont mbr-iconfont-btn"></span>Log In To Save Data</a>
                <a id="accountBtn" style="display: none" class="btn btn-sm btn-primary display-4" href="account.php">
                    <span class="mbri-setting mbr-iconfont mbr-iconfont-btn"></span>Account Preferences</a>
            </div>
        </div>
    </nav>
</section>

<section id="ingredientsAndGallerySection">
    <section class="mbr-gallery mbr-slider-carousel cid-rXMgNWDBnJ" id="gallery1-8">

        <div class="container" >
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <div>
                      <button class="openbtn" onclick="openOrCloseNav()">&#9776; See your current "inventory"</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="rPRecipeContainer" class="container">
<!--TODO FAILURE: send the entire container in the xmlhttprequest to see if tags work? -->
            <div><!-- Filter --><div class="mbr-gallery-filter container gallery-filter-active"><ul buttons="0"><li class="mbr-gallery-filter-all"><image width="50" src="assets/images/undo.png" onclick="history.back()"></image><a class="btn btn-md btn-primary-outline active display-7" href="">All</a></li></ul></div><div><center><a href="page1.php">Keep Searching for Recipes</a></center></div><!-- Gallery --><div class="mbr-gallery-row"><div class="mbr-gallery-layout-default"><div><div id="recipeProphetRecipeGallery"><!--loading circle here--><div class="loader"></div></div></div><div class="clearfix"></div></div></div><!-- Lightbox --><div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery1-8"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><ol class="carousel-indicators"><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="0"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="1"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="2"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="3"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="4"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="5"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" data-slide-to="6"></li><li data-app-prevent-settings="" data-target="#lb-gallery1-8" class=" active" data-slide-to="7"></li></ol><div class="carousel-inner"><div class="carousel-item"><img src="assets/images/mbr-10-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-1920x1287.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-5-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-9-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-3-1920x1280.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-1920x1281.jpg" alt="" title=""></div><div class="carousel-item"><img src="assets/images/mbr-7-1920x1280.jpg" alt="" title=""></div><div class="carousel-item active"><img src="assets/images/mbr-1920x1279.jpg" alt="" title=""></div></div><a class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#lb-gallery1-8"><span class="mbri-left mbr-iconfont" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control carousel-control-next" role="button" data-slide="next" href="#lb-gallery1-8"><span class="mbri-right mbr-iconfont" aria-hidden="true"></span><span class="sr-only">Next</span></a><a class="close" href="#" role="button" data-dismiss="modal"><span class="sr-only">Close</span></a></div></div></div></div></div>
        
        </div>

    </section>
</section>

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
    
            if (isset($_SESSION['userin'])) {
                //if($_SESSION['userin'] == TRUE){
                    //change log in button to account info button
                    echo '<script type="text/javascript">';
                    echo 'document.getElementById("loginBtn").style.display = "none";';
                    echo 'document.getElementById("accountBtn").style.display = "";';
                    echo '</script>';
                //}
            }
    ?>
    <script src="scripts/databaseManipulator.js"></script>
    <!--<script src="scripts/recipeSearch.js"></script>-->
    <script>
        const sidebarMaxWidth = "500px";
        var sidebarWidth = sidebarMaxWidth;
        
        function openNav() {
            if(parseInt(window.screen.width) < parseInt(sidebarMaxWidth)){
                console.log("screen width was lower than sidebarMaxWidth!");
                sidebarWidth = window.screen.width;
            }
            document.getElementById("mySidebar").style.width = sidebarWidth;
            //document.getElementById("main").style.marginLeft = "250px"; //move the main page
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            //document.getElementById("main").style.marginLeft = "0"; //move the main page
        }
        
        function openOrCloseNav(){
            if(parseInt(document.getElementById("mySidebar").style.width) > 0){
               //already open, close it
                closeNav();
            } else {
                openNav();
            }
        }
    </script>
    <script>
        const recipeGallery = document.getElementById('recipeProphetRecipeGallery');
        //const recipeGallery = document.getElementById('rPRecipeContainer');

        //remove all existing children from recipeGallery
        /*while (recipeGallery.firstChild) {
              recipeGallery.removeChild(recipeGallery.firstChild);
            }*/
        
        var listOfIngredients = [];
        
        function getListOfIngredientsAndSendToSearchRecipes(listOfIngredients){
            if(recipeGallery.parentNode == null || recipeGallery == null){}else{
                console.log("entered getLOIEtc");
                let objectStore = db.transaction('notes_os').objectStore('notes_os');
                objectStore.openCursor().onsuccess = function(e) {
                    console.log("entered objectStore.openCursor().onsuccess");
                    // Get a reference to the cursor
                    let cursor = e.target.result;

                    // If there is still another data item to iterate through, keep running this code
                    if(cursor) {
                        console.log("entered if cursor");
                        //add this ingredient to an easily accessible array
                        listOfIngredients.push(cursor.value.name);
                        cursor.continue();
                    } else {
                        console.log("entered else cursor");
                        var xmlhttp = new XMLHttpRequest;

                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                //do display results code in searchRecipes.php, then put the responseText in the gallery
                                console.log("entered onreadystatechange");
                                let doc = new DOMParser().parseFromString(this.responseText, 'text/html');
                                let newRecipeGallery = doc.getElementById("newRecipeProphetRecipeGallery");
                                //let newRecipeGallery = doc.getElementById("rPRecipeContainer");
                                recipeGallery.parentNode.replaceChild(newRecipeGallery, recipeGallery);
                                
                                //TODO tags are present on the recipe elements, but not as buttons
                                //TODO use document.ready or something like that for the tag code?

                                console.log("ended onreadystatechange");
                              }
                        }

                        xmlhttp.open( "POST", "searchRecipes.php" );
                        xmlhttp.setRequestHeader( "Content-Type", "application/json" );
                        xmlhttp.send( JSON.stringify(listOfIngredients) );
                        return listOfIngredients;
                    }
                }
            }
        }
        
        recipeSearchDone = false;
        
        if(recipeGallery.parentNode == null || recipeGallery == null){
           
        } else {
        
            //instead of setUpDatabase.onsuccess, listen for a change in the setUpCompleted variable?
            setUpCompleted.registerListener(function(val) {
                console.log("Changed the value of setUpCompleted.a to " + val);
                if(val == true && !recipeSearchDone){
                    listOfIngredients = getListOfIngredientsAndSendToSearchRecipes(listOfIngredients);
                    //Ensure that setUpCompleted is set back to false right after the functions finish
                    setUpCompleted.a = false;
                    recipeSearchDone = true;
                }
            });

            setUpDatabase();
        }
        
        
    </script>
    <script>
    function addRecent(rid){
        console.log("recipeid: " + rid);
        var xmlhttp = new XMLHttpRequest;
        xmlhttp.open( "POST", "addRecent.php" );
        xmlhttp.setRequestHeader( "Content-Type", "text/plain" );
        xmlhttp.send( rid );
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