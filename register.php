<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
    <a href="index.php">Back</a>
    <br>
    <form action="register.php" method="POST">
        Enter Username: <input type="text" name="username" required="required"/><br>
        Enter password: <input type="password" name="password" required="required" /><br>
        <input type="submit" value="Register"/>
    </form>
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = ($_POST['username']);
        $password = ($_POST['password']);

        echo "Username entered is: " . $username . "<br/>";
        echo "Password entered is: " . $password;

        $bool = true;

        $conn = mysqli_connect("localhost","root") or die(mysqli_error()); //connect to server
        $link = mysqli_select_db($conn,"php-login") or die("Cannot connect to database"); //connect to database
        $query = mysqli_query($conn,"SELECT * FROM users");//query user tables

        //if username already taken
        while($row = mysqli_fetch_array($query))
        {
            $table_users=$row['username'];
            if($username==$table_users)
            {
                $bool = false;
                Print '<script>alert("Username taken!");</script>';
                Print '<script>window.location.assign("register.php");</script>';
            }
        }

        //successfully register user
        if($bool)
        {
            mysqli_query($conn,"INSERT INTO users (username, password) VALUES ('$username', '$password')");
            Print '<script>alert("Successfully Registered");</script>';
            Print '<script>window.location.assign("register.php");</script>';
        }

    }
?>