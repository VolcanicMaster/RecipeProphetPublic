<body>
    <style>
        *, *:before, *:after {
            box-sizing: border-box;
            font-family:inherit;
            font-size: inherit;
        }
        *:focus {outline:none !important}
        input {
            padding:10px;
            border-radius:10px; //rounded edges
            margin:10px 0; // add top and bottom margin
            border:0;
            box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
            width:100%;
            transition: .3s border-color;
        }
        input:hover{
            border: 1px solid #aaa;
        }
        input:focus {
          background-color: #ffd969;
          border-color: #000;
          // and any other style
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
          background-color:#3F51B5;
          color:#fff;
          font-weight:600;
          border-radius:5px;
          width:100%;

        }
        label {
          display:block;
        }
        input:required + span:after {
          content: "Required";
        }
    </style>
    <form action="processUserLogIn.php" method="post" enctype="multipart/form-data">
        <label>Username: </label>
        <input type=text name="username" required value>
        <label>Password: </label>
        <input type=password name="password" required value>
        <input type=submit name="submit" value="Log In">
    </form>
    <form action="processUserSignUp.php" method="post" enctype="multipart/form-data">
        <label>Username: </label>
        <input type=text name="username" required value>
        <label>Email: </label>
        <input type=email name="email" value>
        <label>Password: </label>
        <input type=password name="password" required value>
        <input type=submit name="submit" value="Sign Up">
    </form>
</body>

<?php

?>