/* WORKING DROPDOWN AND FUZZY SEARCH
When the user clicks on the button,
toggle between hiding and showing the dropdown content */
    /*
function myFunction() {
    $(document.getElementById('myDropdown')).toggle("show");
  document.getElementById("myDropdown").classList.toggle("show");
}*/

function myFunction(dropdownID) {
    $(document.getElementById(dropdownID)).toggle("show");
  document.getElementById(dropdownID).classList.toggle("show");
}

/*
function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");

  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}*/

function filterFunction(inputID,dropdownID) {
    var input, filter, div, p, i, lim, pafter, disp, dispdiv, para, txtValue;
    input = document.getElementById(inputID);
    filter = input.value.toUpperCase();
    div = document.getElementById(dropdownID);
    p = div.getElementsByTagName("p");
    lim = 0;
    pafter = [];
    disp = document.getElementById("homeMainDisplayDiv");
    
    //div.classList.show();

    for (i = 0; i < p.length; i++) {
        if(lim >= 5){
            //limit number of elements shown
            //TODO breaking doesn't do it, instead set everything else to "none";
            //TODO count is not working?
            //pafter.push("count>10");
            p[i].style.display = "none";
        } else {
            txtValue = p[i].textContent || p[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                //pafter.push("let".concat(txtValue).concat(" through the filter"));
                p[i].style.display = "";
                lim++;
            } else {
                p[i].style.display = "none";
            }
        }
    }
    $(div).show();
    /*
    dispdiv = document.createElement("div");
    for(i = 0; i < pafter.length; i++){
        //create a new p node and display the text
        para = document.createElement("p");
        para.textContent = pafter[i];
        dispdiv.appendChild(para);
    }
    disp.appendChild(dispdiv);*/
}

    /*
function selectElement(){
    id = "AboutSelection";
    selection = document.getElementById(id);
    dropdownButton = document.getElementById("dropdownButton");
    dropdown = document.getElementById("myDropdown");

    dropdownButton.innerHTML = selection.innerHTML;
    $(dropdown).toggle("show");
}*/

function selectElement(id,dropdownID,dropdownButtonID){
    //id = "AboutSelection";
    selection = document.getElementById(id);
    dropdownButton = document.getElementById(dropdownButtonID);
    dropdown = document.getElementById(dropdownID);

    dropdownButton.innerHTML = selection.innerHTML;
    $(dropdown).toggle("show");
}

function selectElementFromTextArea(id,dropdownID,textAreaID,withDB){
    //id = "AboutSelection";
    selection = document.getElementById(id);
    dropdown = document.getElementById(dropdownID);
    textArea = document.getElementById(textAreaID);

    //withDB = true;
    if(withDB == 1){
        // add ingredients to database
        console.log("withDB: addData");
        addData(selection.textContent, true);
    } else {
        console.log("createListItem");
        createListItem(selection.textContent,id);
    }

    textArea.value = "";
    $(dropdown).toggle("show");
    //$(dropdown).hide();
    
    if(typeof document.getElementById("mySidebar") != "undefined"){
        console.log("dropdownSelection: about to open openNav");
        openNav();
    }
}

//return the id of the first visible child of the dropdown
function getFirstVisibleChild(dropdownID){
    dropdown = document.getElementById(dropdownID);
    
    for(i = 0; i < dropdown.children.length; i++){
        if(dropdown.children[i].style.display != "none"){
            return dropdown.children[i].id;
        }
    }
}

//for custom ingredient lists

function createListItem(ingName, ingID) {
    //ingredient list being constructed
    var list = document.getElementById("ingredients");
    
    //the id used to quickly identify the ingredient
    const idContainer = document.createElement('meta');
    idContainer.content = ingID;
    
    //If an item with the same ingID is already in the list, exit.
    for(var i = 0; list.children[i]; i++){
        if(list.children[i].firstElementChild.content == ingID){
           return;
        }
    }
    
    // Create a list item, h3, and p to put each data item inside when displaying it
    // structure the HTML fragment, and append it inside the list
    const listItem = document.createElement('li');
    const h3 = document.createElement('h3');
    const para = document.createElement('p');
    
    listItem.appendChild(idContainer);
    
    // Create a button and place it inside each listItem
    const deleteBtn = document.createElement('button');
    deleteBtn.className = 'btn btn-sm btn-secondary';
    deleteBtn.style.padding = '0px 10px 0px 10px';
    deleteBtn.textContent = 'X';
    deleteBtn.style.float = "left";
    listItem.appendChild(deleteBtn);

    // Set an event handler so that when the button is clicked, the deleteItem()
    // function is run
    deleteBtn.onclick = deleteVisualItem;

    //listItem.style.width = "200px";
    h3.style.float = "left";
    // Put the data from the cursor inside the h3 and para
    h3.textContent = ingName;
    listItem.appendChild(h3);
    
    para.style.width = "0px";
    para.style.padding = "0.01px 0px 0px 0px";
    listItem.appendChild(para);
    
    list.appendChild(listItem);

    
}
function deleteVisualItem(e) {
    //e.target IS THE DELETE BUTTON ITSELF
    //ingredient list being constructed
    var list = document.getElementById("ingredients");
    list.removeChild(e.target.parentNode);

    //show the No ingredients selected message if there's nothing left
    /*if(!list.firstChild) {
      const listItem = document.createElement('li');
      listItem.textContent = 'No ingredients selected.';
      list.appendChild(listItem);
    }*/
}
//copy of openNav for pages with the sidebar (since we need to call openNav from within this script)
function openNav() {
    console.log("dropdownSelection: inside openNav");
    const sidebarMaxWidth = "500px";
    var sidebarWidth = sidebarMaxWidth;
    if(parseInt(window.screen.width) < parseInt(sidebarMaxWidth)){
        console.log("screen width was lower than sidebarMaxWidth!");
        sidebarWidth = window.screen.width;
    }
    document.getElementById("mySidebar").style.width = sidebarWidth;
    //document.getElementById("main").style.marginLeft = "250px"; //move the main page
}