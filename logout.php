<?php
require_once("session_handling.php");
require_once("db.php");

session_destroy();
session_regenerate_id(TRUE);
session_start();
redirect("login.php", "Logout successful.");
?>
