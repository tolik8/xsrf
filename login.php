<?php
session_start();

if (isset($_SESSION['login_id'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['bt_login'])) {

    include 'base.php';
    
    $input_user = $_POST['login'];
    $input_password = $_POST['password'];
    
    $login_id = array_search($input_user, $users, FALSE);
    
    if ($login_id === FALSE) {
        echo 'User ' . $input_user . ' not exists';
        exit;
    }

    if ($input_password === $passwords[$login_id]) {
        $_SESSION['login_id'] = $login_id;
        $_SESSION['login'] = $input_user;
        header('Location: index.php');
        exit;
    }

}

include 'html/login.html';
