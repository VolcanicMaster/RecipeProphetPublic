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

function selectElementFromTextArea(id,dropdownID,textAreaID){
    //id = "AboutSelection";
    selection = document.getElementById(id);
    dropdown = document.getElementById(dropdownID);
    textArea = document.getElementById(textAreaID);

    // add ingredients to database
    addData(selection.textContent);

    textArea.value = "";
    $(dropdown).toggle("show");
    //$(dropdown).hide();
}