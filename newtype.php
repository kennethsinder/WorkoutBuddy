<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 12:58 PM
 */

require_once 'header.php';

$error = '';

if (isset($_POST['activity']))
{
    $activity = sanitize($_POST['activity']);
    $caloriesPerLbMin = (float)sanitize($_POST['calories']);

    $result = query("INSERT INTO exercises (name, calories) ".
        "VALUES('$activity', '$caloriesPerLbMin')");
    echo("<br>Exercise '$activity' with $caloriesPerLbMin ".
        "calories/(lb*min) added successfully!<br>");
}

echo <<< _END
<span class='formheading'>Add a new exercise:</span><br><br>
<form method='POST' action='newtype.php'>$error
<span class='fieldname'>Name of Activity</span><br>
<input type='text' maxlength='256' name='activity'><br>
<span class='fieldname'>Calories Burned Per Pound Per Minute
</span><br><input type='text' maxlength='16' name='calories'>
<br><br>
_END;
?>
        <input type="submit" value="Add Exercise!">
        </form></div><br>
    </body>
</html>