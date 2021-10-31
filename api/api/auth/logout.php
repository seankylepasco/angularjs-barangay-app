<?php

    header("Location: ../../../Login Page.php");

    echo json_encode(array("message":"Logout Success! Bye.."));

    if (isset($_COOKIE['id'])) {
        unset($_COOKIE['id']); 
        setcookie('id', null, -1, '/'); 
        return true;
    } else {
        return false;
    }
    if (isset($_COOKIE['name'])) {
        unset($_COOKIE['name']); 
        setcookie('name', null, -1, '/'); 
        return true;
    } else {
        return false;
    }

?>