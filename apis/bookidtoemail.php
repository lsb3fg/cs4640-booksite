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

    $data = $db->query("select seller from books where id = ?;","i",$_GET["id"]);


    
if($data===false){
    $outputarray["success"]=False;
    $outputarray["error"]= "ID NOT FOUND";

} else if(empty($data)){
    $outputarray["success"]=False;
    $outputarray["error"]= "ID NOT FOUND";
} else{
    $seller = $data[0]["seller"];
    $username = idToUser($seller,$db);

    if(!$username){
        $outputarray["success"]=False;
        $outputarray["error"]= "Invalid user";
    }
    else{
        $outputarray["success"]=True;
        $outputarray["email"]=$username["email"];

    }

}




}
echo json_encode($outputarray, JSON_PRETTY_PRINT);



?>