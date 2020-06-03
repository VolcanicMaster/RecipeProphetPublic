const recipeGallery = document.getElementById('recipeProphetRecipeGallery');

//remove all existing children from recipeGallery
/*while (recipeGallery.firstChild) {
      recipeGallery.removeChild(recipeGallery.firstChild);
    }*/

var listOfIngredients = [];
setUpDatabase.onsuccess = function()
{
    let objectStore = db.transaction('notes_os').objectStore('notes_os');
    objectStore.openCursor().onsuccess = function(e) {
        // Get a reference to the cursor
        let cursor = e.target.result;

        // If there is still another data item to iterate through, keep running this code
        if(cursor) {
            //add this ingredient to an easily accessible array
            listOfIngredients.push(cursor.value.name);
            cursor.continue();
        }
    }
}

//TODO make sure recipeDatabase is open at this point
//
//

//var listOfRecipes = [["testName","testLink","testImage","testTags"]];
//var listOfRecipes = [["Caprese Salad","index.html","assets/images/mbr-10-1920x1280-800x533.jpg","Salad, Easy, Light"]];
var listOfRecipes = [["Caprese Salad","index.html","assets/images/mbr-10-1920x1280-800x533.jpg","Salad, Easy, Light"]];
//TODO3 searchForRecipes that returns a sorted list of recipes
//TODO3.1 query recipeDatabase so that it returns only the recipes that fit the constraints (ease,weight for now)
//TODO3.2 if we can use a query to do the filter we want on ingredients, do that

//TODO3.3 compile a string for the tags

//displayRecipes that empties and fills the recipeGallery with that list of recipes

var i;
for(i = 0; i < listOfRecipes.length; i++)
{
    recipe = listOfRecipes[i];
    
    //create and add a new html element to recipeGallery
    /*
    <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="Salad, Easy, Light" onclick="location.href='index.html'"><div><img src="assets/images/mbr-10-1920x1280-800x533.jpg" alt="" title=""><span class="icon-focus"></span><span class="mbr-gallery-title mbr-fonts-style display-7">Caprese Salad</span></div></div>
    */
    const galleryItem = document.createElement('div');
    galleryItem.className = "mbr-gallery-item mbr-gallery-item--p1";
    galleryItem.setAttribute("data-video-url","false");
    galleryItem.setAttribute("data-tags",recipe[3]); // tags
    onclickAttribute = "location.href='" + recipe[1] + "'";
    galleryItem.setAttribute("onclick",onclickAttribute); // link to recipe
    
    const galleryContent = document.createElement('div');
    const galleryImage = document.createElement('img');
    galleryImage.setAttribute("src",recipe[2]); // image
    galleryImage.setAttribute("alt","");
    galleryImage.setAttribute("title","");
    const gallerySpanFocus = document.createElement('span');
    gallerySpanFocus.className="icon-focus";
    const gallerySpanTitle = document.createElement('span');
    gallerySpanTitle.className = "mbr-gallery-title mbr-fonts-style display-7";
    gallerySpanTitle.textContent = recipe[0]; // name
    
    galleryContent.appendChild(galleryImage);
    galleryContent.appendChild(gallerySpanFocus);
    galleryContent.appendChild(gallerySpanTitle);
    galleryItem.appendChild(galleryContent);
    recipeGallery.appendChild(galleryItem);
}