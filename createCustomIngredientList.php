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
  <!--<link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">-->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
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
    //$data = file_get_contents( "php://input" ); //gets string from xmlhttp, does it work for retrieving form POST?
    if ($_SESSION['userin'] == TRUE){
        //TODO check how many custom ingredient lists this user already has
        //TODO? open the page

    } else {
        //TODO check redirect to login page
        //exit('Login to create custom ingredient lists!');
        header('login.php');
    }


    ?>
    
    <style>
        
    /*class="form-control-label mbr-fonts-style display-7"*/
        
    label {
        cursor: auto !important;
    }
        
    .dropbtn {
      background-color: #99a5af;
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
        
    .createCustomIngredientListBtn {
        background-color: #ddd;
    }
        
    .createCustomIngredientListBtn:focus, .createCustomIngredientListBtn:hover {
        background-color: #99a5af;
    }

    .dropdown {
      position: relative;
        
      display: inline-block;
    }

    .ingredientDropdown {
        /*bottom: -200px;*/
        position: fixed;
        display: none;
        background-color: #f6f6f6;
        min-width: 230px;
        overflow: auto;
        border: 1px solid #ddd;
        z-index: 1;
    }
    .ingredientDropdown + .ingredientDropdown {
        visibility: hidden;
        position: static;
        padding-top: 200px;
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
        
    .createCustomIngredientListBtn {
        background-color: #ddd;
    }
        
    .createCustomIngredientListBtn:focus, .createCustomIngredientListBtn:hover {
        background-color: #99a5af;
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

    /*."sidebar a" styles is unused rn*/
    /* The sidebar links */
    .sidebar a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }

    /* When you mouse over the navigation links, change their color */
    .sidebar a:hover {
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

    /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
    #main {
      transition: margin-left .5s; /* If you want a transition effect */
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
      .sidebar {padding-top: 15px;}
      .sidebar a {font-size: 18px;}
    }
        
    .show {display: block;}
        
    .hide {
      display:none;
    }
    </style>
    
    
  
</head>
<body>
<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times; CLOSE</a>
    <div >
        <button class="btn btn-md btn-secondary display-4" onclick="clearIndexedDB()">Clear All</button>
    </div>
    <ul name="ingredients" id="ingredients"></ul>
</div>
<div id="main">
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
            <!--<ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="index.php"><span class="mbri-info mbr-iconfont mbr-iconfont-btn"></span>Send Feedback</a>
                </li></ul>-->
            <div class="navbar-buttons mbr-section-btn"><!--<a class="btn btn-sm btn-primary display-4" href="index.php"><span class="mbri-question mbr-iconfont mbr-iconfont-btn"></span>
                    Help</a>-->
                <a class="btn btn-sm btn-primary display-4" href="login.php">
                    <!--<span class="mbri-save mbr-iconfont mbr-iconfont-btn"></span>-->
                    <!--TODO add logout button-->
                    <span class="mbri-login mbr-iconfont mbr-iconfont-btn"></span>Log In To Save Data</a>
            </div>
        </div>
    </nav>
</section>
<section class="mbr-section form1 cid-rXBVuCaPZB" id="ingredientForm">

    <div class="container" >
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <div>
                      <button class="openbtn" onclick="openOrCloseNav()">&#9776; See ingredients currently in this custom list</button>
                    </div>
                </div>
            </div>
    </div>
    <div class="container" >
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
                        -->
                        <div data-for="message" class="col-md-12 form-group">
                            <label id="enterIngredientsLabel" for="message-form1-3" class="form-control-label mbr-fonts-style display-7">Enter Ingredients</label>
                            <input name="search" data-form-field="Message" class="form-control display-7" placeholder="Start typing ingredient name and click on the ingredient you want to add..." id="search" onkeyup="filterFunction('search','ingredientDropdown')" style="resize: none;" autocomplete="off">
                            <ul name="results" id="results"></ul>
                            <div class="dropdown">
                              <div id="ingredientDropdown" class="ingredientDropdown">

                              </div>
                            </div>
                        </div>
                        <div class="col-md-12 input-group-btn align-center"><a href="page1.php"><button id="submitButton" type="submit" onclick="submitCIL()" class="btn btn-lg btn-primary btn-form display-5">Save changes</button></a></div>

                        <!--<div >
                            <button class="dropBtn btn btn-sm display-4" onclick="addDefaultIngs()">Add Common Ingredients</button>
                            <a class="createCustomIngredientListBtn btn btn-sm display-4" href="createCustomIngredientList.php">
                                <span class="mbri-plus mbr-iconfont mbr-iconfont-btn"></span>Create Custom Ingredient List <span class="mbri-sites mbr-iconfont mbr-iconfont-btn"></span></a>
                            <button class="btn btn-md btn-secondary display-4" onclick="clearIndexedDB()">Clear All</button>
                        </div>-->



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
</div>
<?php
            
    //$conn->close();
    //mysqli_close($conn);

?>
    
    
    
    <script src="scripts/databaseManipulator.js"></script>
    <script>
                document.onclick = function(e){
                    //add this clickoff functionality to all dropdowns 
                    if(e.target.id !== 'ingredientDropdown' && e.target.id !== 'search'){
                      document.getElementById('ingredientDropdown').style.display = 'none';
                    }
                };
                </script>
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
    <script src="scripts/dropdownSelection.js"></script>
    <!--probably not necessary to change anything to make sure dropdownSelection only after fillIngredientDropdown has completed-->
<script>    
    var ingids = [];
    //helper function to get the ingredient id from the html
    function getIngredientIDFromHTMLObject(item, index){
        //add id to ingids js array
        ingids.push(item.firstChild.content);
    }
    
    function submitCIL() {
        console.log("entered submitCIL");
        var list = document.getElementById("ingredients");
        //check if the first child's listItem has the textContent 'No ingredients selected.'
        if(!list.hasChildNodes()){
            //TODO say no ingredients are selected and stay on the page.
            console.log("no ingredients selected");
           return;
        }
        if(list.firstChild.textContent === 'No ingredients selected.'){
            //TODO remove all "no ingredient selected" functionality or say no ingredients are selected and stay on the page.
            console.log("no ingredients selected");
           return;
        }
        //get all names from the ingredient list
        list.childNodes.forEach(getIngredientIDFromHTMLObject);
        console.log("names retrieved from ingredient list");    
        
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

        xmlhttp.open( "POST", "processCustomIngredientList.php" );
        xmlhttp.setRequestHeader( "Content-Type", "application/json" );
        xmlhttp.send( JSON.stringify(ingids) );
    }
</script>
<script>
	document.onclick = function(e){
		//add this clickoff functionality to all dropdowns 
		if(e.target.id !== 'ingredientDropdown' && e.target.id !== 'search'){
		  document.getElementById('ingredientDropdown').style.display = 'none';
		}
	};
</script>
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
    xmlhttp.setRequestHeader( "Content-Type", "text/plain" );
    xmlhttp.send('false');//send boolean (whether or not we use the db, in this case no)
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