<?php

session_start();

setcookie("email", '', time() - 3600, "/");
setcookie("password", '', time() - 3600, "/");
setcookie("role", '', time() - 3600, "/");

session_unset();
session_destroy();

unset($_SESSION);

header('Location: /destinasi/app/view/login.php');
exit();