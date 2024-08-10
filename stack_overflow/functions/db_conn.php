<?php
function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Begin connection
    $db = mysqli_connect($servername, $username, $password);

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!mysqli_select_db($db, 'stack_overflow'))

        die("Unable to select database: " . mysqli_error($db));
    return $db;
}
