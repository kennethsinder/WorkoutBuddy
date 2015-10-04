<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 11:05 AM
 */

require_once 'header.php';

if (isset($_SESSION['weight']))
{
    die("You are already logged in. Click <a href='logout.php'>here</a> ".
        "to log out if you wish to switch users.");
}

echo "<div class='main'><h3>Please enter your details to log in:</h3>";
$error = $user = $pass = "";

if (isset($_POST['user']))
{
    $user = sanitize($_POST['user']);
    $pass = hash('ripemd128', sanitize($_POST['pass']));

    if (!$user || !$pass)
    {
        $error = "Not all fields were entered<br>";
    }
    else
    {
        $result = query("SELECT * FROM members
                  WHERE user='$user' AND pass='$pass'");
        if (!$result->num_rows)
        {
            $error = "<span class='error'>Username/Password invalid".
                    "</span><br><br>";
        }
        else
        {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            $_SESSION['weight'] = $result->fetch_array(MYSQLI_ASSOC)['weight'];
            $weight = $_SESSION['weight'];
            if (!isset($_SESSION)) session_start();
            die("You are now logged in. <br>Please <a
            href='index.php'>click here</a> to continue.<br><br>");

        }
    }
}

echo <<<_END
<form method='POST' action='login.php'><span class='error'>$error</span>
<span class='nonulfield'>Username:</span>
<input type='text' maxlength='16' name='user' value='$user'><br>
<span class='nonulfield'>Password:</span>
<input type='password' maxlength='16' name='pass' value=''>
_END;
?>
        <br>
        <input type="submit" value="Login">
        </form><br></div>
    </body>
</html>
