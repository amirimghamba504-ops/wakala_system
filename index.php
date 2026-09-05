<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/classes/Auth.php';

if (Auth::check()) {
    $role = $_SESSION['role'];
    header('Location: ' . ($role === 'wakala_mkuu' ? 'mkuu/dashboard.php' : 'kawaida/dashboard.php'));
} else {
    header('Location: login.php');
}
exit;
