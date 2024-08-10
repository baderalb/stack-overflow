<?php

require_once 'functions/browser_fn.php';

if (isset($_POST['logout'])) {
    logout();
}
redirect('index.php');
// signout 
//..
?>