//window.addEventListener('load', displayData, false);

function testRun(){
    //setCookie("ingredientsList", getCookie("ingredientsList").concat(",lettuce"), 365);
    //setCookie("ingredientsList", ",lettuce", 365);
    //checkCookie();
    var node = document.createElement("LI");                 // Create a <li> node
    var textnode = document.createTextNode("Lettuce");         // Create a text node
    node.appendChild(textnode);                              // Append the text to <li>
    document.getElementById("ingredients").appendChild(node);
}

//Edited version of index.js from IndexedDBTutorial that uses ingredient database

//TODO refactor to proper constraints
// Create needed constants
//const list = document.querySelector('ul');
const list = document.getElementById('ingredients');
//const titleInput = document.querySelector('#title');
//const form = document.querySelector('form');
//const submitBtn = document.getElementById('easyFilterButton');

// Create an instance of a db object for us to store the open database in
db = [];

setUpCompleted = {
  aInternal: false,
  aListener: function(val) {},
  set a(val) {
    this.aInternal = val;
    this.aListener(val);
  },
  get a() {
    return this.aInternal;
  },
  registerListener: function(listener) {
    this.aListener = listener;
  }
}


// Define the addData() function
  function addData(ingredient, withDisplay) {
    // prevent default - we don't want the form to submit in the conventional way
    //e.preventDefault();
    console.log("Begin call to addData");

    // grab the values entered into the form fields and store them in an object ready for being inserted into the DB
    let newItem = { name: ingredient }; //previously list.lastChild.firstChild.textContent?

    // open a read/write db transaction, ready for adding the data
    let transaction = db.transaction(['notes_os'], 'readwrite');

    // call an object store that's already been added to the database
    let objectStore = transaction.objectStore('notes_os'); 
      
    // Make a request to add our newItem object to the object store
    var request = objectStore.add(newItem);
    request.onsuccess = function() {
      // Clear the form, ready for adding the next entry
      //titleInput.value = '';
      //bodyInput.value = '';
    };

    // Report on the success of the transaction completing, when everything is done
    transaction.oncomplete = function() {
      console.log('Transaction completed: database modification finished.');

      // update the display of data to show the newly added item, by running displayData() again.
        if(withDisplay){
            displayData();
        }
    };

    transaction.onerror = function() {
      console.log('Transaction not opened due to error');
    };
  }

// Define the displayData() function
  function displayData() {
    // Here we empty the contents of the list element each time the display is updated
    // If you ddn't do this, you'd get duplicates listed each time a new note is added
    while (list.firstChild) {
      list.removeChild(list.firstChild);
    }

    // Open our object store and then get a cursor - which iterates through all the
    // different data items in the store
    let objectStore = db.transaction('notes_os').objectStore('notes_os');
    objectStore.openCursor().onsuccess = function(e) {
      // Get a reference to the cursor
      let cursor = e.target.result;

      // If there is still another data item to iterate through, keep running this code
      if(cursor) {
        // Create a list item, h3, and p to put each data item inside when displaying it
        // structure the HTML fragment, and append it inside the list
        const listItem = document.createElement('li');
        const h3 = document.createElement('h3');
        const para = document.createElement('p');
        
          h3.style.float = "left";
          //para.style.float = "left";
        listItem.appendChild(h3);
        listItem.appendChild(para);
        list.appendChild(listItem);

        // Put the data from the cursor inside the h3 and para
        h3.textContent = cursor.value.name;

        // Store the ID of the data item inside an attribute on the listItem, so we know
        // which item it corresponds to. This will be useful later when we want to delete items
        listItem.setAttribute('data-note-id', cursor.value.id);

        // Create a button and place it inside each listItem
        const deleteBtn = document.createElement('button');
        listItem.appendChild(deleteBtn);
        deleteBtn.textContent = 'Delete';

        // Set an event handler so that when the button is clicked, the deleteItem()
        // function is run
        deleteBtn.onclick = deleteItem;

        // Iterate to the next item in the cursor
        cursor.continue();
      } else {
        // Again, if list item is empty, display a 'No notes stored' message
        if(!list.firstChild) {
          const listItem = document.createElement('li');
          listItem.textContent = 'No ingredients selected.'
          list.appendChild(listItem);
        }
        // if there are no more cursor items to iterate through, say so
        console.log('Notes all displayed');
      }
    };
  }

// Define the deleteItem() function
  function deleteItem(e) {
    // retrieve the name of the task we want to delete. We need
    // to convert it to a number before trying it use it with IDB; IDB key
    // values are type-sensitive.
    let noteId = Number(e.target.parentNode.getAttribute('data-note-id'));

    // open a database transaction and delete the task, finding it using the id we retrieved above
    let transaction = db.transaction(['notes_os'], 'readwrite');
    let objectStore = transaction.objectStore('notes_os');
    let request = objectStore.delete(noteId);

    // report that the data item has been deleted
    transaction.oncomplete = function() {
      // delete the parent of the button
      // which is the list item, so it is no longer displayed
      e.target.parentNode.parentNode.removeChild(e.target.parentNode);
      console.log('Note ' + noteId + ' deleted.');

      // Again, if list item is empty, display a 'No notes stored' message
      if(!list.firstChild) {
        const listItem = document.createElement('li');
        listItem.textContent = 'No ingredients selected.';
        list.appendChild(listItem);
      }
    };
  }

//testing if deleteData works as intended
function deleteData(ingredient) {

    // open a database transaction and delete the task, finding it using the id we retrieved above
    let transaction = db.transaction(['notes_os'], 'readwrite');
    let objectStore = transaction.objectStore('notes_os');
    let request = objectStore.delete(ingredient);

    // report that the data item has been deleted
    transaction.oncomplete = function() {
      console.log('Data ' + ingredient + ' deleted.');
    };
  }

function setUpDatabase() {
  // Open our database; it is created if it doesn't already exist
  // (see onupgradeneeded below)
  let request = window.indexedDB.open('notes_db', 1);

  // onerror handler signifies that the database didn't open successfully
  request.onerror = function() {
    console.log('Database failed to open');
  };

  // onsuccess handler signifies that the database opened successfully
  request.onsuccess = function() {
    console.log('Database opened succesfully');

    // Store the opened database object in the db variable. This is used a lot below
    db = request.result;

    // Run the displayData() function to display the notes already in the IDB
    displayData();
      
    // send a message to other javascript that setUpDatabase is completed
    setUpCompleted.a = true;
  };

  // Setup the database tables if this has not already been done
  request.onupgradeneeded = function(e) {

    // Grab a reference to the opened database
    let db = e.target.result;

    // Create an objectStore to store our notes in (basically like a single table)
    // including a auto-incrementing key
    let objectStore = db.createObjectStore('notes_os', { keyPath: 'id', autoIncrement:true });

    // Define what data items the objectStore will contain
    objectStore.createIndex('name', 'name', { unique: true });
    // objectStore.createIndex('owned', 'owned', { unique: false });

    console.log('Database setup complete');
  };

  // Create an onsubmit handler so that when the form is submitted the editData() function is run
  //submitBtn.onclick = addData;

  
    
  // Define the editData() function
    /*
  function editData(e) {
    // prevent default - we don't want the form to submit in the conventional way
    e.preventDefault();

    // grab the values entered into the form fields and store them in an object ready for being inserted into the DB
    // let newItem = { title: titleInput.value};

    // open a read/write db transaction, ready for adding the data
    let transaction = db.transaction(['notes_os'], 'readwrite');

    // call an object store that's already been added to the database
    let objectStore = transaction.objectStore('notes_os');
      
    var request = objectStore.get(key);

    request.onsuccess = function(ev)
    {
        var data = ev.target.result;
        if (data === undefined)
        {
            //console.log('Key doesnt exist or has been previously' + 'removed');
            return;
        }

        data.text = titleInput.value;
        // Make a request to add our newItem object to the object store
        var request = objectStore.put(data);
        request.onsuccess = function() {
          // Clear the form, ready for adding the next entry
          titleInput.value = '';
        };

        // Report on the success of the transaction completing, when everything is done
        transaction.oncomplete = function() {
          console.log('Transaction completed: database modification finished.');

          // update the display of data to show the newly added item, by running displayData() again.
          displayData();
        };

        transaction.onerror = function() {
          console.log('Transaction not opened due to error');
    };
    }
  }
  */

};

function setUpDatabaseWithoutDisplay() {
  // Open our database; it is created if it doesn't already exist
  // (see onupgradeneeded below)
  let request = window.indexedDB.open('notes_db', 1);

  // onerror handler signifies that the database didn't open successfully
  request.onerror = function() {
    console.log('Database failed to open');
  };

  // onsuccess handler signifies that the database opened successfully
  request.onsuccess = function() {
    console.log('Database opened succesfully');

    // Store the opened database object in the db variable. This is used a lot below
    db = request.result;

      //TODO remove displayData from all aspects of this setup
    //displayData();
      
    // send a message to other javascript that setUpDatabase is completed
    setUpCompleted.a = true;
  };

  // Setup the database tables if this has not already been done
  request.onupgradeneeded = function(e) {

    // Grab a reference to the opened database
    let db = e.target.result;

    // Create an objectStore to store our notes in (basically like a single table)
    // including a auto-incrementing key
    let objectStore = db.createObjectStore('notes_os', { keyPath: 'id', autoIncrement:true });

    // Define what data items the objectStore will contain
    objectStore.createIndex('name', 'name', { unique: true });
    // objectStore.createIndex('owned', 'owned', { unique: false });

    console.log('Database setup complete');
  };


};


window.onload = setUpDatabase;