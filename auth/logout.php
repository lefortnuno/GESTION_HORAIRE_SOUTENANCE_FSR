<?php
require '../config/config.php';

$_SESSION = [];
session_unset();
session_destroy();
header("Location: codeApogee.php");