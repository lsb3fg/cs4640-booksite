<?php
spl_autoload_register(function($classname) {
    include "../classes/$classname.php";
});
$db = new Database();

$outputarray = array();

$data = $db->query("select * from books;");

if($data===false){
    $outputarray["success"]=False;
} else {
    $outputarray["success"]=True;
    $outputarray["data"] = $data;

}
echo json_encode($outputarray, JSON_PRETTY_PRINT);



?>