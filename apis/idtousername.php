<?php
spl_autoload_register(function($classname) {
    include "../classes/$classname.php";
});
$db = new Database();

include("../idToUser.php");


$outputarray = array();
if(!isset($_GET["id"])){
    $outputarray["success"]=False;
    $outputarray["error"]= "Must append url with ?id=[id]";

}

else{
    $username = idToUser($_GET["id"],$db);
    if(!$username){
        $outputarray["success"]=False;
        $outputarray["error"]= "Invalid user";
    }
    else{
        $outputarray["success"]=True;
        $outputarray["username"]=$username["username"];
    }



}
echo json_encode($outputarray, JSON_PRETTY_PRINT);



?>