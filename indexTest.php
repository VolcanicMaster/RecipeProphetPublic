<html>
<head>
  <!-- Site made partly with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/mbr-122x158.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Home</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
    <style>
        
    /*class="form-control-label mbr-fonts-style display-7"*/
        
    label {
        cursor: auto !important;
    }
        
    .dropbtn {
      background-color: #76a5af;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    .dropbtn:hover, .dropbtn:focus {
      background-color: #507f89;
    }

    .filteredInput {
      box-sizing: border-box;
      background-image: url('searchicon.png');
      background-position: 14px 12px;
      background-repeat: no-repeat;
      font-size: 16px;
      padding: 14px 20px 12px 45px;
      border: none;
      border-bottom: 1px solid #ddd;
    }
        
    .filteredInput:focus {outline: 3px solid #ddd;}
        
    /*#myInput {
      box-sizing: border-box;
      background-image: url('searchicon.png');
      background-position: 14px 12px;
      background-repeat: no-repeat;
      font-size: 16px;
      padding: 14px 20px 12px 45px;
      border: none;
      border-bottom: 1px solid #ddd;
    }

    #myInput:focus {outline: 3px solid #ddd;}*/

    .dropdown {
      position: relative;
        
      display: inline-block;
    }

    #ingredientDropdown {
        bottom: -200px;
    }
        
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f6f6f6;
      min-width: 230px;
      overflow: auto;
      border: 1px solid #ddd;
      z-index: 1;
    }

    .dropdown-content p {
      color: black;
      padding: 12px 16px 0px;
      text-decoration: none;
      display: block;
        cursor:pointer;
    }

    .dropdown p:hover {background-color: #ddd;}

    .show {display: block;}
        
    .hide {
      display:none;
    }
    </style>
    
    <?php
    //This locks pages behind a login. We can use it for test versions of pages. When we want to update the main page we can just copy in the new page and add this login again.
    session_start();
//    //header('Location: adminLogin.php');
//
//    if (isset($_SESSION['loggedin'])) {
//        header('Location: page1Test.php');
//        exit; 
//    } else {
//        
//    }
    if (!isset($_SESSION['loggedin'])) {
        header('Location: adminLogin.php');
        exit; 
    }
    ?>
  
</head>
<body>
  <section class="menu cid-qTkzRZLJNu" once="menu" id="menu1-0">

    

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
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="index.php" id="homeButton">
                        Recipe Prophet</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="index.php"><span class="mbri-info mbr-iconfont mbr-iconfont-btn"></span>
                        
                        About Us
                    </a>
                </li></ul>
            <div class="navbar-buttons mbr-section-btn"><a class="btn btn-sm btn-primary display-4" href="index.php"><span class="mbri-question mbr-iconfont mbr-iconfont-btn"></span>
                    Help</a></div>
        </div>
    </nav>
</section>

<section class="engine"></section><section class="cid-qTkA127IK8 mbr-fullscreen" id="header2-1">

    

    

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div id="homeMainDisplayDiv" class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    Enter Ingredients, <br>Find Recipes</h1>
                
                <p class="mbr-text pb-3 mbr-fonts-style display-5">Enter as little as 2 ingredients, and we'll ask you if you have certain other ingredients to find the perfect recipe you can make without leaving home.</p>
                <div class="mbr-section-btn"><a class="btn btn-md btn-secondary display-4" href="index.php#ingredientForm">FIND RECIPES!</a></div>
            </div>
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#ingredientForm">
            <i class="mbri-down mbr-iconfont"></i>
        </a>
    </div>
</section>
<?php
    
        include "scripts/dbConnect.php"
        
?>
<section class="mbr-section form1 cid-rXBVuCaPZB" id="ingredientForm">

    

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                
                
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" > <!--data-form-type="formoid"-->
                <!---Formbuilder Form--->
                <div>
                    <div class="row">
                        
                        <!--<div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                        </div>-->
                    </div>
                    <div class="dragArea row">
                        
                        
                        <!-- 
                                generates ingredients list from database, 
                                filterFunction limits number of ingredients shown at once
                                
                                TODOmaybe use all words in parentheses for display?

                                TODO include ingredients like Salt, Olive Oil, Water by default
                                    AND add a button that adds common ingredients
                                TODO add RESET button that either clears or calls the "add default" function?
                        -->
                        <div data-for="message" class="col-md-12 form-group">
                            <label id="enterIngredientsLabel" for="message-form1-3" class="form-control-label mbr-fonts-style display-7">Enter Ingredients</label>
                            <input name="search" data-form-field="Message" class="form-control display-7" placeholder="Start typing ingredient name and click on the ingredient you want to add..." id="search" onkeyup="filterFunction('search','ingredientDropdown')" style="resize: none;" autocomplete="off">
                            <ul name="results" id="results"></ul>
                            <div class="dropdown">
                              <div id="ingredientDropdown" class="dropdown-content">
                                
                              </div>
                            </div>
                            
                            <div class="dropdown">
                              <button onclick="myFunction('easyFilter')" class="dropbtn" id="easyFilterButton">No Difficulty Preference</button>
                              <div id="easyFilter" class="dropdown-content">
                                <p id="noDifficultyPreferenceSelection" onclick="selectElement('noDifficultyPreferenceSelection','easyFilter','easyFilterButton')">No Difficulty Preference</p>
                                <p id="easySelection" onclick="selectElement('easySelection','easyFilter','easyFilterButton')">Easy</p>
                              </div>
                            </div>
                            
                            <!--
                            <div class="dropdown">
                              <button onclick="myFunction('cuisineFilter')" class="dropbtn" id="cuisineFilterButton">No Cuisine Preference</button>
                              <div id="cuisineFilter" class="dropdown-content">
                                <a href="#noCuisinePreference" id="noCuisinePreferenceSelection" onclick="selectElement('noCuisinePreferenceSelection','cuisineFilter','cuisineFilterButton')">No Cuisine Preference</a>
                                <a href="#japaneseSelection"  id="japaneseSelection" onclick="selectElement('japaneseSelection','cuisineFilter','cuisineFilterButton')">Japanese</a>
                                <a href="#thaiSelection"  id="thaiSelection" onclick="selectElement('thaiSelection','thaiFilter','thaiFilterButton')">Thai</a>
                              </div>
                            </div>-->
                            
                            <div class="dropdown">
                              <button onclick="myFunction('lightFilter')" class="dropbtn" id="lightFilterButton">No Meal Weight Preference</button>
                              <div id="lightFilter" class="dropdown-content">
                                <p id="noLightPreferenceSelection" onclick="selectElement('noLightPreferenceSelection','lightFilter','lightFilterButton')">No Meal Weight Preference</p>
                                <p id="lightSelection" onclick="selectElement('lightSelection','lightFilter','lightFilterButton')">Light Meal</p>
                                <p id="heavySelection" onclick="selectElement('heavySelection','lightFilter','lightFilterButton')">Heavy Meal</p>
                              </div>
                            </div>
                            
                        </div>
                        <div class="col-md-12 input-group-btn align-center"><a href="page1.php"><button id="submitButton" type="submit" class="btn btn-primary btn-form display-4">FIND RECIPES!</button></a></div>
                            
                            <ul name="ingredients" id="ingredients">Ingredients: </ul>
                            
                            
                        
                    </div>
                </div><!---Formbuilder Form--->
                
                <!--<div class="dropdown">
                              <button onclick="myFunction('myDropdown')" class="dropbtn" id="dropdownButton">Dropdown</button>
                              <div id="myDropdown" class="dropdown-content">
                                <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()" class="filteredInput">
                                <a href="#about" id="AboutSelection" onclick="selectElement('AboutSelection','myDropdown','dropdownButton')">About</a>
                                <a href="#base">Base</a>
                                <a href="#blog">Blog</a>
                                <a href="#contact">Contact</a>
                                <a href="#custom">Custom</a>
                                <a href="#support">Support</a>
                                <a href="#tools">Tools</a>
                              </div>
                            </div>-->
                
                
            </div>
        </div>
    </div>
</section>

<section class="cid-qTkAaeaxX5" id="footer1-2">

    

    

    <div class="container">
        <div class="media-container-row content text-white">
            <div class="col-12 col-md-3">
                <div class="media-wrap">
                    <a href="index.php">
                        <img src="assets/images/mbr-122x158.png" alt="Mobirise" title="">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Address
                </h5>
                <p class="mbr-text">
                    1234 Street Name
                    <br>City, AA 99999
                </p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Contacts
                </h5>
                <p class="mbr-text">
                    Email: hello@alexgl.com
                    <br>Phone: +1 (0) 000 0000 001
                    <br>Fax: +1 (0) 000 0000 002
                </p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Links
                </h5>
                <p class="mbr-text"><a class="text-warning" href="index.php">Recipe Prophet Home</a>&nbsp;<br><a class="text-warning" href="index.php">About Us</a><br><a class="text-warning" href="index.php">Help</a></p>
            </div>
        </div>
        <div class="footer-lower">
            <div class="media-container-row">
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
            <div class="media-container-row mbr-white">
                <div class="col-sm-6 copyright">
                    <p class="mbr-text mbr-fonts-style display-7">
                        © Copyright 2020 Recipe Prophet - All Rights Reserved
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="social-list align-right">
                        <div class="soc-item">
                            <a href="https://twitter.com/volcanicmaster" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social socicon-twitter socicon"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="index.php" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social socicon-youtube socicon"></span>
                            </a>
                        </div>
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

    $conn->close();
    //mysqli_close($conn);

?>
    
    
    
    <script src="scripts/databaseManipulator.js"></script>
    <script>
                document.onclick = function(e){
                    //add this clickoff functionality to all dropdowns 
                    if(e.target.id !== 'easyFilter' && e.target.id !== 'easyFilterButton'){
                      document.getElementById('easyFilter').style.display = 'none';
                    }
                    if(e.target.id !== 'lightFilter' && e.target.id !== 'lightFilterButton'){
                      document.getElementById('lightFilter').style.display = 'none';
                    }
                    if(e.target.id !== 'ingredientDropdown' && e.target.id !== 'search'){
                      document.getElementById('ingredientDropdown').style.display = 'none';
                    }
                };
                </script>
    <script src="scripts/dropdownSelection.js"></script>
    <!--TODO: only run dropdownSelection after fillIngredientDropdown has completed?-->
    <script>
        const ingredientDropdown = document.getElementById('ingredientDropdown');
        
        var xmlhttp = new XMLHttpRequest;

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //do display results code in searchRecipes.php, then put the responseText in the gallery
                console.log("entered onreadystatechange");
                let doc = new DOMParser().parseFromString(this.responseText, 'text/html');
                let newIngredientDropdown = doc.getElementById("ingredientDropdown");
                ingredientDropdown.parentNode.replaceChild(newIngredientDropdown, ingredientDropdown);

                //TODO tags are present on the recipe elements, but not as buttons

                console.log("ended onreadystatechange");
              }
        }

        xmlhttp.open( "POST", "fillIngredientDropdown.php" );
        xmlhttp.setRequestHeader( "Content-Type", "application/json" );
        xmlhttp.send();//no need to send any data
    </script>
    
  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/nav-dropdown.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <!--<script src="https://cdn.jsdelivr.net/npm/fuse.js@5.2.3"></script>-->
  
</body>
</html>