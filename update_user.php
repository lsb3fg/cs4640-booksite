<?php
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

$this->db = new Database();
session_start();

if (!isset($_SESSION["id"])) {
    // they need to see the login
    
}
else{
    $db
}
