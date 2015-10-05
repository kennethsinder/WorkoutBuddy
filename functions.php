<!DOCTYPE html>
<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 9:04 AM
 */

require_once 'db_login.php';

$website_title = 'Workout Buddy';
$author = 'Kenneth Sinder';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

function sanitize($str)
{
    global $conn;
    return $conn->real_escape_string(stripslashes(
        htmlentities(strip_tags($str))
    ));
}

function query($query)
{
    global $conn;
    $result = $conn->query($query);
    if (!$result) die ($conn->error);
    return $result;
}

function destroySession()
{
    $_SESSION = [];
    if (session_id() != '' || isSet($_SESSION))
    {
        setCookie(session_name(), '', time() - 2592000);
    }
    session_destroy();
}

function compare($calories)
{
    $foodQuery = query("SELECT * FROM food ORDER BY calories ASC");
    $selectedFood = [];
    if (!$foodQuery->num_rows) return;
    echo "<hr><div class='comparisonheading'>You burned ".
            "approximately $calories calories by torturing yourself.<br><br>".
            "This pitiful abomination is equivalent to:<br></div>".
            "<ul class='sadlist'>";
    for ($i = 0; $i < $foodQuery->num_rows; $i++)
    {
        $food = $foodQuery->fetch_array(MYSQLI_ASSOC);
        $name = $food['name'];
        $cal = $food['calories'];
        // Get the percentage of each food item that was burned by the input number
        // of calories, and format it to 2 decimal places
        $percentage = number_format((float)(100 * $calories / $cal), 2, '.', '');
        // Get the first food item that is below 50% based on the above calculation.
        // Also store the number of times necessary to exercise to get up to 100% in the 0th index
        if ($percentage < 50 && !$selectedFood)
        {
            $selectedFood = [number_format((float)(100 / $percentage - 1), 2, '.', ''), $name];
        }
        echo "<span class='comparison'><li>$percentage% of one $name</li></span>";
    }
    if ($selectedFood[1] > 0)
    {
        echo "<br/>If you did the same exercise $selectedFood[0] more times, ".
            "you could actually burn off one $selectedFood[1], you lazy oaf!</ul><br/>";
    }
    echo "<br><br><p><strong>DISCLAIMER</strong>: All values are approximate. This website is for entertainment ".
        "purposes only. It was created by Kenneth Sinder for the TerribleHacks II Hackathon.</p>";
}