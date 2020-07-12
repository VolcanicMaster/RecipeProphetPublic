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
  var input, filter, ul, li, p, i, count;
  input = document.getElementById(inputID);
  filter = input.value.toUpperCase();
  div = document.getElementById(dropdownID);
  p = div.getElementsByTagName("p");
    count = 0;

  $(div).show();
  //div.classList.show();

  for (i = 0; i < p.length; i++) {
      if(count > 10){
            //limit number of elements shown
            break;
        }
    txtValue = p[i].textContent || p[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      p[i].style.display = "";
        count++;
    } else {
      p[i].style.display = "none";
    }
  }
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