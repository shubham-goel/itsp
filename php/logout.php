<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['outsider']);
header("Location:http://itsp.stab-iitb.org")

?>