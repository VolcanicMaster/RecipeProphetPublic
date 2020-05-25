const recipeGallery = document.getElementById('recipeProphetRecipeGallery');

//remove all existing children from recipeGallery
/*while (recipeGallery.firstChild) {
      recipeGallery.removeChild(recipeGallery.firstChild);
    }*/

setUpDatabase.onsuccess = function()
{
    let objectStore = db.transaction('notes_os').objectStore('notes_os');
    objectStore.openCursor().onsuccess = function(e) {
        // Get a reference to the cursor
        let cursor = e.target.result;

        // If there is still another data item to iterate through, keep running this code
        if(cursor) {
            //TODO2 add this ingredient to an easily accessible array
            cursor.continue();
        }
    }
}

var listOfRecipes = ["TEST"];
//TODO3 searchForRecipes that returns a sorted list of recipes



//TODO1 displayRecipes that empties and fills the recipeGallery with that list of recipes

var i;
for(i = 0; i < listOfRecipes.length; i++)
{
    recipe = listOfRecipes[i];
    //TODO1.1 create and add a new html element to recipeGallery
    
}