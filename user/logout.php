<?php
session_start();
unset($_SESSION['email']);
include("../funcs.php");
redirect('../post/index.php');
?>