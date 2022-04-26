<?php
spl_autoload_register(function($classname) {
    include "../classes/$classname.php";
});
$db = new Database();

include("../idToUser.php");

function emailToUser($email,$db)
{
    $data = $db->query("select * from users where email = ?;","s",$email);

    if($data===false){
        print("SQL ERROR");
        return false;
    } else if(!empty($data)){
        return $data[0];
    }
    return false;
}


$outputarray = array();
if(!isset($_GET["email"])){
    $outputarray["success"]=False;
    $outputarray["error"]= "Must append url with ?email=email";

}

else{
    $username = emailToUser($_GET["email"],$db);
    if(!$username){
        $outputarray["success"]=False;
        $outputarray["error"]= "Invalid user";
    }
    else{
        $outputarray["success"]=True;
        $outputarray["username"]=$username["username"];
        $outputarray["firstname"]=$username["firstname"];
        $outputarray["lastname"]=$username["lastname"];
        $outputarray["nickname"]=$username["nickname"];
        $outputarray["phone"] =$username["phone"];
    }



}
echo json_encode($outputarray, JSON_PRETTY_PRINT);



?>