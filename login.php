<body>
    <form action="processUserLogIn.php" method="post" enctype="multipart/form-data">
        <label>Username: </label>
        <input type=text name="username" value>
        <label>Password: </label>
        <input type=password name="password" value>
        <input type=submit name="submit" value="Log In">
    </form>
    <form action="processUserSignUp.php" method="post" enctype="multipart/form-data">
        <label>Username: </label>
        <input type=text name="username" value>
        <label>Email: </label>
        <input type=email name="email" value>
        <label>Password: </label>
        <input type=password name="password" value>
        <input type=submit name="submit" value="Sign Up">
    </form>
</body>

<?php

?>