<?php

function redirect(String $page)
{
    echo "<script>window.location.href='" . $page . "'</script>";
}

function alertMessage($message)
{
    echo "<script>alert('" . $message . "')</script>";
}
function confirmc($message)
{
    echo "<script> var x =confirm('" . $message . "');
    if(x==true)
        $('#div_session_write').load('session_write.php?session_name=true');
    </script>";
    //alertMessage($_COOKIE['confirming']);
   // return $_COOKIE['confisrming'];
    //echo"jQuery('#div_session_write').load('session_write.php?session_name=true');";
}

function isLoggedIn()
{
    return isset($_COOKIE['user_id']);
}

function currentUserId()
{
    return $_COOKIE['user_id'];
}

function currentUserName($id)
{
    $db = connectDB();
    $sql = "SELECT name FROM users WHERE id = '" . $id ."'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return $row["name"];

}


function logout()
{
    setcookie('user_id', null, time() - 3600, "/");
    unset($_COOKIE['user_id']);
}