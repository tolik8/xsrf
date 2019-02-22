<?php
session_start();

if (!isset($_SESSION['login_id'])) {
    header('Location: login.php');
    exit;
}

$login_id = $_SESSION['login_id'];
$login = $_SESSION['login'];
$_SESSION['token'] = sha1(uniqid(rand(), true));

include 'base.php';

include 'index.html';
