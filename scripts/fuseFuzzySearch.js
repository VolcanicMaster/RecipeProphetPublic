//import Fuse from 'https://cdn.jsdelivr.net/npm/fuse.js@5.2.3/dist/fuse.esm.js'

window.addEventListener('load', loadedCheck, false);
window.addEventListener('load', refreshRunOnce, false);

function loadedCheck(){
    //document.getElementById("homeButton").innerHTML = "loaded";
}

function refreshSearch() {
    //document.getElementById("homeButton").innerHTML = "refreshSearch1";
    
    // 1. List of items to search in
    const books = [
      {
        title: "Old Man's War",
        author: {
          firstName: 'John',
          lastName: 'Scalzi'
        }
      },
      {
        title: 'The Lock Artist',
        author: {
          firstName: 'Steve',
          lastName: 'Hamilton'
        }
      }
    ]
    
    var search = $('input[name=search]').val();
    const fuse = new Fuse(books, {
        keys: ['title', 'author.firstName']
    })
    //document.getElementById("homeButton").innerHTML = "refreshSearch2";
    var results = fuse.search(search);
    
    document.getElementById("homeButton").innerHTML = "refreshSearch3";
    
    //var resultsHTML = results.join('\n');
    //$("ul.results").html(resultsHTML);
    
    results.forEach(appendResultToResults());
}

function appendResultToResults(item,index){
    var node = document.createElement("LI");                 // Create a <li> node
    var textnode = document.createTextNode(item);         // Create a text node
    node.appendChild(textnode);                              // Append the text to <li>
    document.getElementById("results").appendChild(node);     // Append <li> to <ul> with id="myList"
}

$(function() {
    refreshSearch();
    //Refresh search output on every key press in the search input
    $('input[name=search]').keyup(refreshSearch);
})

function refreshRunOnce(){
    refreshSearch();
    //Refresh search output on every key press in the search input
    $('input[name=search]').keyup(refreshSearch);
}