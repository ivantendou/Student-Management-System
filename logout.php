<?php

/* logout function */
session_start();
session_destroy();

/* navigating user back to login.php page */
header("location:login.php");
?>