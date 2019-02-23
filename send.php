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

include 'config.php';
include 'base.php';

$json_data = file_get_contents('accounts.json');
$accounts = json_decode($json_data, TRUE);

echo '<a href="index.php">Home</a><hr>';

if (isset($_POST['send_id'])) {
    
    if ($input_token !== $session_token && $token_enabled) {
        echo '<h3 style="color:red">Bad token!</h3>';
        //echo 'Input token ' . $input_token . '<br>';
        //echo 'Session token ' . $session_token;
        exit;
    }

    if (preg_match('#^\d+$#', $_POST['sum']) === 0) {
        echo '<h3 style="color:red">Incorrect sum!</h3>';
        exit;
    }

    if ($_POST['sum'] <= 0) {
        echo '<h3 style="color:red">Incorrect sum!</h3>';
        exit;
    }

    if ($_POST['sum'] > $accounts[$login_id]) {
        echo '<h3 style="color:red">Not enough money!</h3>';
        exit;
    }

    if (!isset($users[$_POST['send_id']])) {
        echo '<h3 style="color:red">Send id incorrect!</h3>';
        exit;
    }

    // Transcaction
    $accounts[$login_id] -= $_POST['sum'];
    $accounts[$_POST['send_id']] += $_POST['sum'];

    // Save new data
    $json_data = json_encode($accounts);
    file_put_contents('accounts.json', $json_data);

    echo 'User ' . $login . ' send ' . $_POST['sum'] . ' to user_id ' . $_POST['send_id'] . '<br>';
    echo '<h3 style="color:green">Transaction completed!</h3>';
}
