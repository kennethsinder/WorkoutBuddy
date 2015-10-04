<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 12:16 PM
 */

require_once 'functions.php';

if (isset($_POST['weight']))
{
    $weight = (int)sanitize($_POST['weight']);
    if ($weight < 50 || $weight > 500)
        echo  "<span class='taken'>&nbsp;&#x2718; " .
            "This weight is invalid. </span>";
    else
        echo "<span class='available'>&nbsp;&#x2714; </span>";
}