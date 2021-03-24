<html  >
<head>
  <!-- Site made partly with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/mbr-122x158.png" type="image/x-icon">
  <meta name="description" content="Web Site Generator Description">
  
  
  <title>Ingredient Prompt</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <?php
    //This locks pages behind a login. We can use it for test versions of pages. When we want to update the main page we can just copy in the new page and add this login again.
    session_start();
    //header('Location: adminLogin.php');

    if (isset($_SESSION['loggedin'])) {
        header('Location: page1Test.php');
        exit; 
    } else {
        
    }
    ?>
  
  
</head>
<body>
  <section class="menu cid-qTkzRZLJNu" once="menu" id="menu1-4">

    

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
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="index.php">
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

<section class="engine"><a href="https://mobirise.info/f">easy website builder</a></section><section class="cid-rXBYK1XkL4 mbr-fullscreen" id="header2-6">

    

    
    <div class="container align-center">
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">

                    <!--TODO LATER make the back button go back in the prompt set instead of history.back()?-->
                    <image width="50" src="assets/images/undo.png" onclick="history.back()"></image>

                    <h3 id="prompt"class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-2">
                        </h3><!--Do you have Tomato?-->

                    <div class="mbr-section-btn"><a id="yesBtn" class="btn btn-md btn-info display-4" onclick="">YES</a>
                        <a id="noBtn" class="btn btn-md btn-white display-4" onclick="">NO</a></div>
                </div>
            </div>
        </div>

    </div>
    <div class= "container align-bottom align-right" style="position: absolute; bottom: 0; right: 0;">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <div class="mbr-section-btn"><a id="justGiveMeRecipesBtn" class="btn btn-md btn-black display-4" href="page2.php">JUST GIVE ME RECIPES</a><h1 id="promptCounter" class="mbr-text pb-3 mbr-fonts-style display-5" style="float: right">Prompt 1/3</h1></div>
                <!--class="mbr-text pb-3 mbr-fonts-style display-5"> -->
            </div>
        </div>
    </div>
    
</section>
    <?php
        include "scripts/dbConnect.php"
    ?>
    <script src="scripts/databaseManipulator.js"></script>
    <script>
        //clear the onload function that is set by default in databaseManipulator
        //instead, we need a version of setUpDatabase without the displayDatas.
        window.onload = setUpDatabaseWithoutDisplay; 
        
        //TODO get ingredients from indexeddb
        var listOfIngredients = []; 
        var indexedDBGetDone = false;
        
        const prompt = document.getElementById('prompt');
        const yesBtn = document.getElementById('yesBtn');
        const noBtn = document.getElementById('noBtn');
        const promptCounter = document.getElementById('promptCounter');        
        
        var ingsToPrompt = [];//var ingsToPrompt = [];
        var unavailables = []; //TODO make unavailables session-tied (indexeddb)
        
        //instead of setUpDatabase.onsuccess, listen for a change in the setUpCompleted variable?
        setUpCompleted.registerListener(function(val) {
            if(val == true && !indexedDBGetDone){
                let objectStore = db.transaction('notes_os').objectStore('notes_os');
                objectStore.openCursor().onsuccess = function(e) {
                    // Get a reference to the cursor
                    let cursor = e.target.result;

                    // If there is still another data item to iterate through, keep running this code
                    if(cursor) {
                        //add this ingredient to an easily accessible array
                        listOfIngredients.push(cursor.value.name);
                        cursor.continue();
                    } else {
                        //do something on completion
                        //Ensure that setUpCompleted is set back to false right after the functions finish
                        setUpCompleted.a = false;
                        indexedDBGetDone = true;
                        //do prompt setup, which ends by calling the first prompt
                        ingPromptSetup();
                    }
                }
                
            }
        });
        
        
        //use this to delete from array based on value
        function arrayRemove(arr, value) { return arr.filter(function(ele){ return ele != value; });}
        
        ///
        /////TODO do calculation to determine what the best ingredient to ask about is. 
        //TODO have commonality index and just order by that? sort by number of instances of ingredients in recipeIngredients?
        //TODO factor this commonality index into a summary score that will eventually factor in calculated user preference (the more times they say they don't have an ingredient, the lower the score? Goes back up if they say yes? )
        
        function ingPromptSetup(){
            //generate full list of ingredients from database
            //have two selects, pushed to the same array one after the other?: SELECT name,tags FROM ingredients WHERE tags LIKE "%Entree%" ORDER BY commonality DESC;
            <?php
                $dbIngs = array();
                //$dbTags = array();
                $sql = "SELECT name,tags FROM ingredients WHERE tags LIKE '%Entree%' ORDER BY commonality DESC;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {       
                        array_push($dbIngs,($row["name"]));
                        //array_push($dbTags,($row["tags"]));
                    }
                }
                $sql = "SELECT name,tags FROM ingredients WHERE tags NOT LIKE '%Entree%' ORDER BY commonality DESC;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {       
                        array_push($dbIngs,($row["name"]));
                        //array_push($dbTags,($row["tags"]));
                    }
                }
            ?>
            //pass to javascript
            var dbIngs = <?php echo json_encode($dbIngs); ?>;
            //var dbTags = <?php //echo json_encode($dbTags); ?>;
            //remove those that are already on the indexeddb at this point
            var j;
            var dbIngsInitCount = dbIngs.length; //number of ingredients in the database
            var indDBIngCount = 0; //number of ingredients in the indexeddb
            for(j = 0; j < listOfIngredients.length; j++){
                var indexOnIndexedDB = dbIngs.indexOf(listOfIngredients[j]);
                if(indexOnIndexedDB != -1){
                    indDBIngCount++;
                    dbIngs.splice(indexOnIndexedDB,1);
                }
            }
            //determine how many prompts to give based on the percent coverage of the ingredients
            var indDBOffset = 20;
            var totalOffset = 5;
            var numPrompts = Math.floor((dbIngsInitCount) / (indDBIngCount + indDBOffset)) + totalOffset;
            //var numPrompts = 5; // for testing
            //calculate what to prompt
            for(j = 0; j < numPrompts; j++){
                //select an ingredient from dbIngs
                var indexOfSelection = 0//Math.floor(Math.random() * dbIngs.length);
                var selectedIng = dbIngs[indexOfSelection];
                ingsToPrompt.push(selectedIng);
                dbIngs.splice(indexOfSelection,1);
            }

            //TODOLATER remove those that have tags which are incompatible with current settings
            
            //ingsToPrompt = ['Parmesan (Cheese)','Apple']; //testing if the code runs
            
            askAboutIng();
        }
        
        
        
        
        
        
        
        
        //define function that happens on click for Yes and No
        //in order to send the information to list of ingredients, we should send the new ingredients to the indexedDB after each button click?
        function onYes(ing){
            //add the ingredient to list of ingredients
            addData(ing, false);
            
            //remove the ingredient from the session-tied NOT AVAILABLE list 
            if(unavailables.indexOf(ing) != -1 ){
                unavailables.splice(unavailables.indexOf(ing, 1));
            }
            
            //continue to the next prompt
            askAboutIng();
        }
        function onNo(ing){
            //remove the ingredient from list of ingredients
            //TODO test this, it doesn't appear to delete correctly
            deleteData(ing);
            
            //add the ingredient to the session-tied NOT AVAILABLE list (so it doesn't get prompted again in a later set)
            if(unavailables.indexOf(ing) == -1 ){
                unavailables.push(ing);
            }
            
            //continue to the next prompt
            askAboutIng();
        }
        
        var i = 0;
        
        function askAboutIng(){
            //check if ings has been iterated through
            if(i >= ingsToPrompt.length){
                //if ings has been iterated through, redirect to the search display page (page2)
                window.location.href = "page2.php";
            } else {
                var promptedIng = ingsToPrompt[i];
                i++;
                
                //set the prompt counter text
                promptCounter.innerHTML = 'Prompt '.concat(i).concat('/').concat(ingsToPrompt.length);

                //make the onclick of YES and NO active
                yesBtn.onclick = function() {onYes(promptedIng);};
                noBtn.onclick= function() {onNo(promptedIng);};
                
                //set text and onclick last so there are no weird visual consistency issues for users
                prompt.innerHTML = 'Do you have <b>'.concat(promptedIng).concat('</b>?');
            }
        }
        
        //TODO remove this, make it wait until the info from the database has been selected and the calculations have been done
        //call the first prompt
        //askAboutIng();
    </script>
    <?php

        $conn->close();

    ?>
  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/nav-dropdown.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
</body>
</html>