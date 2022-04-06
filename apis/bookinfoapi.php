<?php
spl_autoload_register(function($classname) {
    include "../classes/$classname.php";
});
$db = new Database();




$outputarray = array();
if(!isset($_GET["id"])){
    $outputarray["success"]=False;
    $outputarray["error"]= "Must append url with ?id=[id]";

}
else{
$data = $db->query("select * from books where id = ?;","i",$_GET["id"]);

if($data===false){
    $outputarray["success"]=False;
    $outputarray["error"]= "ID NOT FOUND";

} else if(empty($data)){
    $outputarray["success"]=False;
    $outputarray["error"]= "ID NOT FOUND";
} else{
    $outputarray["success"]=True;
    $outputarray["data"] = $data;

}

}
echo json_encode($outputarray, JSON_PRETTY_PRINT);



?>