<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 11:35 AM
 */

require_once 'header.php';

echo <<< _END
<script type='text/javascript'>
    function checkUser(user)
    {
        sendAjaxRequest('info', 'checkuser.php', 'user', user);
    }

    function checkWeight(weight)
    {
        sendAjaxRequest('weightinfo', 'checkweight.php', 'weight', weight);
    }
</script>
<div class='main'><h3>Please enter your details to register:</h3>
_END;

$error = $user = $pass = '';
$weight = 0;

if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user']))
{
    $user = sanitize($_POST['user']);
    $pass = hash('ripemd128', sanitize($_POST['pass']));
    $weight = (int)sanitize($_POST['weight']);

    if (!$user || !$pass || !$weight)
        $error = "Not all fields were entered<br><br>";
    else
    {
        $result = query("SELECT * FROM members WHERE user='$user'");

        if ($result->num_rows)
            $error = "That username already exists<br><br>";
        else
        {
            query("INSERT INTO members(user, pass, weight)
                  VALUES('$user', '$pass', '$weight')");
            die("<h4>Account created</h4>Please log in.<br><br>");
        }
    }
}

echo <<< _END
<form method='POST' action='register.php'>$error
<span class='fieldname'>Username</span>
<input type='text' maxlength='16' name='user' value='$user'
oninput='checkUser(this)'><span id='info'></span><br>
<span class='fieldname'>Password</span>
<input type='password' maxlength='16' name='pass' value=''><br/>
<span class='fieldname'>Weight (lb)</span>
<input type='text' maxlength='3' name='weight'
oninput='checkWeight(this)'><span id='weightinfo'></span><br/>
_END;
?>
        <span class='fieldname'>&nbsp;</span>
        <input type='submit' value="Register">
        </form></div><br>
    </body>
</html>
