
<?php
spl_autoload_register(function ($classname) {
    include "classes/$classname.php";
});
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: index.php?errormsg=Not Logged In");
}

$db = new Database();

include("idToUser.php");

$data = $db->query("select id from users where email = ?;","s",$_SESSION["email"]);

if($data===false){
    print("SQL ERROR");
    header("Location: index.php?errormsg=Error");
} else {
    // print_r($data);
    if(isset($data[0])){
       
        $userid= $data[0]["id"];
    }
    
}

$data = $db->query("select * from messages where receiver = ?;","i",$userid);

if($data===false){
    print("SQL ERROR");
    header("Location: index.php?errormsg=Error");

} else {
   
    $messages=$data;
}
?>


<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Luke Britton, Maxim Gorodchanin">
    <title>UVA Textbook Sales</title>
    <meta name="description" content="book example page for CS4640 project">
    <meta name="keywords" content="Book Title UVA">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles/main.css" />
</head>
<body>
  <?php include("templates/nav.php"); ?>
    <div>
        <h2 style="text-align: center; margin-top: 15px; margin-bottom: 25px;">Showing results for: "all"</h2>
    </div>

    <div class="page-wrap" id="page-container-account">
        <div style="display:flex; flex-wrap: wrap">
            <?php
            for($i = 0; $i < count($data);$i++){
                $message = $messages[$i];
                $id=$message["id"];
                $title=$message["title"];
                $body = $message["contents"];
                $sender= idToUser($message["sender"],$db)["username"];

                include ("templates/message_item.php");
            }
            
            
            ?>

        </div>
    </div> 


    <?php include("templates/footer.php"); ?>
</body>
</html>

