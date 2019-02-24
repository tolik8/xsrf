<?php
session_start();

if (empty($_SESSION['token'])) {
    try {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    } catch (Exception $e) {

    }
}

$token = $_SESSION['token'];
