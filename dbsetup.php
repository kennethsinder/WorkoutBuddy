<!DOCTYPE html>
<?php
/**
 * Created by PhpStorm.
 * User: Kenneth
 * Date: 2015-10-04
 * Time: 9:23 AM
 */

require_once 'header.php';

// Create 'exercises' table
query("CREATE TABLE IF NOT EXISTS exercises (id INT AUTO_INCREMENT PRIMARY KEY,".
      "name VARCHAR(256) NOT NULL, calories DECIMAL(8,3) NOT NULL)");
echo "Created exercise table or it already exists.<br>";

// Create 'food' table
query("CREATE TABLE IF NOT EXISTS food (id INT AUTO_INCREMENT PRIMARY KEY,".
    "name VARCHAR(256) NOT NULL, calories DECIMAL(8,3) NOT NULL)");
echo "Created food table or it already exists.<br>";

// Create 'members' table
query("CREATE TABLE IF NOT EXISTS members (id INT AUTO_INCREMENT PRIMARY KEY,
      user VARCHAR(16) NOT NULL, pass VARCHAR(256) NOT NULL,
      weight INT NOT NULL, calories DECIMAL(8, 3) DEFAULT 0)");
echo "Created members table or it already exists.<br>";