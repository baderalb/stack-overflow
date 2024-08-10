<?php

function register($name, $email, $password)
{
    $db = connectDB();
    $sql = "INSERT INTO users (name, email,  password) VALUES('" . $name . "', '" . $email . "',  '" . md5($password) . "')";
    mysqli_query($db, $sql);
    $user_id = mysqli_insert_id($db);
    setcookie('user_id', $user_id, time() + (86400 * 30), "/");
}

function login($email, $password)
{
    $db = connectDB();
    $sql = "SELECT id FROM users WHERE email = '" . $email . "' AND password = '" . md5($password) . "'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    if (isset($row['id'])) {
        setcookie('user_id', $row['id'], time() + (86400 * 30), "/");
        redirect("index.php");
        return true;
    }
    alertMessage("Wrong Email Or Password!");
    return false;
}
