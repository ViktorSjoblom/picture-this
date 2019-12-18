<?php

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo $message;
    unset($_SESSION['message']);
}
