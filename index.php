<?php

include 'session.php';
include 'base.php';

if (!isset($_SESSION['login_id'])) {
    header('Location: login.php');
    exit;
}

$login_id = $_SESSION['login_id'];
$login = $_SESSION['login'];

$json_data = file_get_contents('accounts.json');
$accounts = json_decode($json_data, TRUE);

include 'html/index.html';
