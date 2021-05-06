<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/mbr-122x158.png" type="image/x-icon">
    <meta name="description" content="Website Creator Description">

    <title id=title>Login: Recipe Prophet</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/tether/tether.min.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/gallery/style.css">
    <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <?php
    session_start();
    //if (isset($_SESSION['message'])) {
    //    echo '<script type="text/javascript">alert("' . $_SESSION['message'] . '");</script>';
    //    unset($_SESSION['message']);
    //}
    ?>
    <style>
        /*
        bright red: #e8062f
        pink: #fdd1d1
        */
        
        *, *:before, *:after {
            box-sizing: border-box;
            font-family:inherit;
            font-size: inherit;
        }
        *:focus {outline:none !important}
        input {
            padding:10px;
            border-radius:10px;
            margin:10px 0;
            border: 1px solid #aaa;
            border-color: #000;
            box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
            /*width:100%;*/
            transition: .3s border-color;
        }
        input:hover{
            /*border: 1px solid #aaa;*/
        }
        input:focus {
          background-color: #99a5af;
          /*border-color: #000;*/
        }
        .border-customized-input {
           border: 2px solid #eee;
        }
        input[type=submit] {
          /* remove default behavior */
          appearance:none;
          -webkit-appearance:none;
            
          /* usual styles */
          padding:10px;
          border:none;
          background-color:black;
          color:#fff;
            margin:10px 0;
          /*font-weight:600;
          border-radius:5px;*/
          /*width:100%;*/

        }
        input[type=submit]:hover{
            color:#fff;
            background-color:dimgrey;
        }
        label {
            display:block;
        }
        input:required + span:after {
          content: "Required";
        }
        #loginDisplayDiv{
            
        }
    </style>
</head>
<body>
    <section class="cid-qTkA127IK8 mbr-fullscreen" id="header2-1">
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div id="loginDisplayDiv" class="mbr-black col-md-10">
                    <form action="processUserLogIn.php" method="post" enctype="multipart/form-data">
                        <label>Email: </label>
                        <input type=email name="email" required value>
                        <label>Password: </label>
                        <input type=password name="password" required value>
                        <br>
                        <input type=submit name="submit" value="Log In" class="btn btn-sm display-4">
                    </form>
                    <form action="processUserSignUp.php" method="post" enctype="multipart/form-data">
                        <label>Email: </label>
                        <input type=email name="email" value>
                        <label>Password: </label>
                        <input type=password name="password" required value>
                        <br>
                        <input type=submit name="submit" value="Sign Up" class="btn btn-sm display-4">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--<script>
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

        xmlhttp.open( "POST", "processUserLogIn.php" );
        xmlhttp.setRequestHeader( "Content-Type", "text/plain" );
        xmlhttp.send('TRUE');
    </script>-->
</body>

<?php

?>