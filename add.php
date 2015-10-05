<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 9:46 AM
 */

require_once "header.php";

$has_weight = isset($_SESSION['weight']);
$weight = 0;
if ($has_weight)
{
    $weight = sanitize($_SESSION['weight']);
}
$calories = 0;

if (isset($_POST['min']))
{
    $minutes = (int)sanitize($_POST['min']);
    if ($minutes < 0 || $minutes > 1000) {
        die("<br>Minutes must be greater than zero!<br>");
    }
    $activity = strtolower(sanitize($_POST['activity']));

    $result = query("SELECT * FROM exercises WHERE name='$activity'");
    if ($result->num_rows)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $caloriesPerLbMin = (float)$row['calories'];
        if ($weight)
        {
            $calories = $caloriesPerLbMin * $weight * $minutes;
        }
        else if (isset($_POST['weight']))
        {
            $weight = sanitize($_POST['weight']);
            $calories = $caloriesPerLbMin * $weight * $minutes;
        }
        else
        {
            die("<hr><span class='error'>ERROR: Weight is undefined!!</span><hr>");
        }
        if ($user) {
            query("UPDATE members SET calories = calories + $calories WHERE user='$user'");
        }
    }
    $minutes = 0;
}

echo <<< _END
<span class='formheading'><p>Enter the details of your workout below:
</p></span>
<form method='POST' action='add.php'>
<span class='nonulfield'>The torture lasted</span>
<input type='text' name='min' size='4' maxlength='5'/>
<span class='nonulfield'>minutes.<br>
<br><span class='nonulfield'>I wasted my time with </span>
<select name='activity'>
_END;

$result = query("SELECT * FROM exercises");
for ($i = 0; $i < $result->num_rows; $i++)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $exercise_name = $row['name'];
    echo "<option value='$exercise_name'>$exercise_name</option>";
}
echo "</select><span class='nonulfield'>. (".
       "<a href='newtype.php'>Add Exercise Type</a>)<br><br>";
if (!isset($_SESSION['weight']))
{
    echo "<span class='nonulfield'>On a good day, I weigh </span>
    <input type='text' name='weight' size='4' maxlength='5' value='$weight'/>
    <span class='nonulfield'> pounds.</span>";
}

?>
<br><br>
<input type='submit' value='Submit'/>
<br>
</form>
</body>
</html>
<?php if ($calories) compare($calories); ?>
