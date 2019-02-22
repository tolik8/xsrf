<?php
session_start();

if (!isset($_SESSION['login_id'])) {
    header('Location: login.php');
    exit;
}

$login_id = $_SESSION['login_id'];
$login = $_SESSION['login'];
$session_token = $_SESSION['token'];
if (isset($_POST['token'])) {$input_token = $_POST['token'];} else {$input_token = '';}

include 'base.php';

echo '<a href="index.php">Home</a><hr>';

if (isset($_POST['send_id'])) {
    
    if ($input_token !== $session_token) {
        echo '<h3 style="color:red">Bad token!</h3>';
        exit;
    }
    
    if ($_POST['sum'] > $accounts[$login_id]) {
        echo '<h3 style="color:red">Not enough money!</h3>';
    } else {
        echo 'User ' . $login . ' send ' . $_POST['sum'] . ' to user_id ' . $_POST['send_id'] . '<br>';
        echo '<h3 style="color:green">Transaction completed!</h3>';
    }
    exit;
}
