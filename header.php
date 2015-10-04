<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 9:11 AM
 */
if (!isset($_SESSION))
{
    session_start();
}

require_once 'functions.php';

$loggedin = false;
if (isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
    $loggedin = TRUE;
}

echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>$website_title</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type='text/javascript' src='javascript.js'></script>
        <link href='style.css' type='text/css' rel='stylesheet'>
    </head>
    <body>
        <div class='logo_bgrd'><img src='logo.jpg' class='logo'></img><br>
        <div class='subtitle'>"Deprecating exercise, one sad statistic at a time"</div></div>
        <div class='banner'><ul class='menu'>
            <li><a href='add.php'>How Effective Was My Workout?</a></li>
            <li><a href='newtype.php'>Add Exercise Type</a></li>
            <li><a href='newfood.php'>Add New Food</a></li>
_END;
if (!$loggedin)
{
    echo "<li><a href='login.php'>Login</a></li>";
    echo "<li><a href='register.php'>Register</a></li>";
}
else
{
    echo "<li><a href='logout.php'>Logout</a></li>";
}
echo "</ul></div><hr>";
    if (isset($_SESSION['user']))
    {
        $name = $_SESSION['user'];
        $result = query("SELECT calories FROM members WHERE user = '$name'");
        $calcount = $result->fetch_array(MYSQLI_NUM)[0];
        $pizzacount = $calcount / 2400.0;
        echo "<div class='status'><strong>YOUR SAD PROGRESS</strong>: I am distressed to report you have ".
                "only burned $pizzacount pizzas' worth of energy so far. ".
                "(<a href='#'>Refresh</a>)</div><hr>";
    }
    else
    {
        echo "<div class='status'><strong>Note</strong>: If you <strong><a href='login.php'>log in</a></strong> or
                <strong><a href='register.php'>register</a></strong>, you can keep track of your total calories
                burned (measured in medium pepperoni pizzas!)</div><hr>";
    }
echo "<br/>";