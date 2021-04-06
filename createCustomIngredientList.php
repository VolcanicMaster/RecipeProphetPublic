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
  
    <style>
        /*TODO implement a custom ingredients list*/
        
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

    .show {display: block;}
        
    .hide {
      display:none;
    }
    </style>
    </head>


<?php
include "scripts/dbConnect.php";
session_start();
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

<label id="enterIngredientsLabel" for="message-form1-3" class="form-control-label mbr-fonts-style display-7">Enter Ingredients</label>
                            <input name="search" data-form-field="Message" class="form-control display-7" placeholder="Start typing ingredient name and click on the ingredient you want to add..." id="search" onkeyup="filterFunction('search','ingredientDropdown')" style="resize: none;" autocomplete="off">
                            <ul name="results" id="results"></ul>
                            <div class="dropdown">
                              <div id="ingredientDropdown" class="ingredientDropdown">
                                
                              </div>
                            </div>
<div ><ul name="ingredients" id="ingredients">Ingredients: </ul></div>


<!--<script src="scripts/databaseManipulator.js"></script>-->
<script>    
    var list = document.getElementById("ingredients");
    function createListItem(ingName, ingID) {
        //ingredient list being constructed
        var list = document.getElementById("ingredients");
        // Create a list item, h3, and p to put each data item inside when displaying it
        // structure the HTML fragment, and append it inside the list
        const listItem = document.createElement('li');
        const h3 = document.createElement('h3');
        const idContainer = document.createElement('meta');
        
        idContainer.content = ingID;
        listItem.appendChild(idContainer);
        
          //listItem.style.width = "200px";
        h3.style.float = "left";
        listItem.appendChild(h3);
        list.appendChild(listItem);

        // Put the data from the cursor inside the h3 and para
        h3.textContent = ingName;

        // Create a button and place it inside each listItem
        const deleteBtn = document.createElement('button');
        listItem.appendChild(deleteBtn);
        deleteBtn.textContent = 'Delete';

        // Set an event handler so that when the button is clicked, the deleteItem()
        // function is run
        deleteBtn.onclick = deleteItem;
    }
      function deleteItem(e) {
        //ingredient list being constructed
        var list = document.getElementById("ingredients");
        list.removeChild(e.target);
        
        //show the No ingredients selected message if there's nothing left
        if(!list.firstChild) {
          const listItem = document.createElement('li');
          listItem.textContent = 'No ingredients selected.';
          list.appendChild(listItem);
        }
      }
    
    var ingids = [];
    //helper function to get the ingredient id from the html
    function getIngredientIDFromHTMLObject(item, index){
        //add id to ingids js array
        ingids.push(item.firstChild.content);
    }
    
    function submitCIL() {
        //check if the first child's listItem has the textContent 'No ingredients selected.'
        if(list.firstChild.textContent.equals('No ingredients selected.')){
           return;
        }
        //get all names from the ingredient list
        list.childNodes.forEach(getIngredientIDFromHTMLObject);
                
        //send js array to php like in searchRecipes, convert ingids to php array.
        var xmlhttp = new XMLHttpRequest;

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //this part can be used to get the responseText and either display or just use it.
                console.log("entered onreadystatechange for sendToProcessCustomIngredientList");
                //let doc = new DOMParser().parseFromString(this.responseText, 'text/html');
                //let resultObj = doc.getElementById("result");
                //objToBeReplaced.parentNode.replaceChild(resultObj, objToBeReplaced);
                
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
    xmlhttp.setRequestHeader( "Content-Type", "text/plain" );
    xmlhttp.send('false');//send boolean (whether or not we use the db, in this case no)
</script>
<script>
    if(!list.firstChild) {
          const listItem = document.createElement('li');
          listItem.textContent = 'No ingredients selected.'
          list.appendChild(listItem);
        }
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
</html>