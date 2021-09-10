<?php
session_start();
error_reporting(E_PARSE);
if ($_SESSION['estatus'] == "T") {
    
} else {
    header("Location: index.php");
    exit();
}