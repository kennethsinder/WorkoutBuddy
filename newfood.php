<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 1:12 PM
 */

require_once 'header.php';

$error = '';

if (isset($_POST['food']))
{
    $food = sanitize($_POST['food']);
    $calories = (float)sanitize($_POST['calories']);
    if ($calories < 1)
    {
        echo "Calorie value of less than one entered. Assuming 1 calorie.";
        $calories = 1;
    }

    $result = query("INSERT INTO food (name, calories) ".
        "VALUES('$food', '$calories')");
    echo("<br>Food item '$food' with <strong>$calories</strong> ".
        "calories each added successfully!<br>");
}

echo <<< _END
<span class='formheading'>Add a new food item:</span><br><br>
<form method='POST' action='newfood.php'>$error
<span class='fieldname'>Name of Food</span><br>
<input type='text' maxlength='256' name='food'><br>
<span class='fieldname'>Calories in One Item</span>
<br><input type='text' maxlength='16' name='calories'>
<br><br>
_END;
?>
<input type="submit" value="Add Food!">
</form></div><br>
</body>
</html>