<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 11:45 AM
 */

require_once 'functions.php';

if (isset($_POST['user']))
{
    $user = sanitize($_POST['user']);
    $result = query("SELECT * FROM members WHERE user='$user'");
    if ($result->num_rows)
        echo  "<span class='taken'>&nbsp;&#x2718; " .
            "This username is taken</span>";
    else
        echo "<span class='available'>&nbsp;&#x2714; " .
            "This username is available</span>";
}