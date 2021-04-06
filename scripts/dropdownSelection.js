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

    if(withDB){
        // add ingredients to database
        addData(selection.textContent, true);
    } else {
        createListItem(selection.textContent,id);
    }

    textArea.value = "";
    $(dropdown).toggle("show");
    //$(dropdown).hide();
}

//for custom ingredient lists
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