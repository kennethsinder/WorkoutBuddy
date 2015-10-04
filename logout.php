<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 12:54 PM
 */

require_once 'header.php';

if (isset($_SESSION))
{
    session_destroy();
    $loggedin = false;
}

die("You are now logged out. Click ".
        "<a href='index.php'>here</a> to leave this page.");