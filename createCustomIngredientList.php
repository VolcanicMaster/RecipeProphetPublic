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
/*
//TODO ON SUBMIT
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('INSERT INTO userCustomLists (name, userID) VALUES (?,?)')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $name, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();
}
*/

?>

<label id="enterIngredientsLabel" for="message-form1-3" class="form-control-label mbr-fonts-style display-7">Enter Ingredients</label>
                            <input name="search" data-form-field="Message" class="form-control display-7" placeholder="Start typing ingredient name and click on the ingredient you want to add..." id="search" onkeyup="filterFunction('search','ingredientDropdown')" style="resize: none;" autocomplete="off">
                            <ul name="results" id="results"></ul>
                            <div class="dropdown">
                              <div id="ingredientDropdown" class="dropdown-content">
                                
                              </div>
                            </div>
<div ><ul name="ingredients" id="ingredients">Ingredients: </ul></div>


<!--<script src="scripts/databaseManipulator.js"></script>-->
<script>    
    var list = document.getElementById("ingredients");
    function createListItem(ingName) {
        // Create a list item, h3, and p to put each data item inside when displaying it
        // structure the HTML fragment, and append it inside the list
        const listItem = document.createElement('li');
        const h3 = document.createElement('h3');

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
        list.removeChild(e.target);
        
        //show the No ingredients selected message if there's nothing left
        if(!list.firstChild) {
          const listItem = document.createElement('li');
          listItem.textContent = 'No ingredients selected.'
          list.appendChild(listItem);
        }
      }
    
    //TODO write this!
    function submitCIL() {
        //get all names from the ingredient list
        
        //submit to the DB
    }
</script>
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
<script>
    if(!list.firstChild) {
          const listItem = document.createElement('li');
          listItem.textContent = 'No ingredients selected.'
          list.appendChild(listItem);
        }
</script>