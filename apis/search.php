<?php
spl_autoload_register(function($classname) {
    include "../classes/$classname.php";
});
$db = new Database();

$outputarray = array();

if(!isset($_GET["search"])){
    $outputarray["success"]=False;
    $outputarray["error"]= "Must append url with ?search=[search term]";
}
else{

$data;
if($_GET["search"]===''){
    $data = $db->query("select * from books;");

}
else{
$data = $db->query("select * from books WHERE LOWER(title) LIKE ?","s",'%'.strtolower($_GET["search"]).'%'); 
}
if($data===false){
    $outputarray["success"]=False;
} else {
    $outputarray["success"]=True;
    $outputarray["data"] = $data;
}
}

echo json_encode($outputarray, JSON_PRETTY_PRINT);



?>