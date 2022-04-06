<?php
spl_autoload_register(function ($classname) {
    include "classes/$classname.php";
});
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: index.php?errormsg=Not Logged In");
}







$db = new Database();



if (isset($_GET["command"])) {

    include("inputchecker.php");



    if ($_GET["command"] === "message") {

        $required = array("title", "text", "bookid","senderid","receiverid");
        
        if(!validateRequest($required,$_POST)){
           print("fail");
        }
        else{

            $insert = $db->query(
                "insert into messages (sender, receiver,sale ,title,contents,senddate) values (?, ?, ?, ?, ?, ?);",
                "iiisss",
                $_POST["senderid"],
                $_POST["receiverid"],
                $_POST["bookid"],
                $_POST["title"],
                $_POST["text"],
                date('Y-m-d H:i:s')
            );
            if ($insert === false) {
                #print("test1");
                header("Location: index.php?errormsg=Error Sending Message");

            } else {
                print($insert);
                header("Location: all_books.php");
            }
        }
    
        }
    }





else if (!isset($_GET["id"])) {
    header("Location: index.php?errormsg=No Such Book1");
}

else if (!isset($_SESSION["email"])) {
    header("Location: index.php?errormsg=Not Logged In");
}
else{
$data = $db->query("select * from users where email = ?;", "s", $_SESSION["email"]);
if ($data === false) {
    print("SQL ERROR");
    header("Location: index.php?errormsg=No Such User");
} else if (!empty($data)) {
    $poster = $data[0];
}




$data = $db->query("select * from books where id = ?;", "i", $_GET["id"]);
if ($data === false) {
    print("SQL ERROR");
    header("Location: index.php?errormsg=No Such Book2");
} else if (!empty($data)) {
    $book = $data[0];

    $data = $db->query("select * from users where id = ?;", "i", $book["seller"]);
    if ($data === false) {
        print("SQL ERROR");
        header("Location: index.php?errormsg=No Such Book3");
    } else {
        $seller = $data[0];
    }
} else {
    header("Location: index.php?errormsg=No Such Book4");
}

}

?>




<!DOCTYPE html>
<html lang="en">
<!-- Sources:
          https://stackoverflow.com/questions/643879/css-to-make-html-page-footer-stay-at-bottom-of-the-page-with-a-minimum-height-b -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Luke Britton, Maxim Gorodchanin">
    <title>UVA Textbook Sales</title>
    <meta name="description" content="index page for CS4640 project">
    <meta name="keywords" content="define keywords for search engines">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles/main.css" />
</head>

<body>
    <header>
        <?php include("templates/nav.php"); ?>
        <div id="main-header" style="text-align: center;">
            <h2>Composing a message about <?= $seller["username"] ?>'s offer of <?= $book["title"] ?> for $<?= $book["price"] ?></h2>
        </div>

    </header>

    <div class="page-wrap align-items-start" id="page-container-account">


        <div class="card text-center col-md-8" style="border: 1px solid black;">
            <div class="card-header" style="background-color: rgb(144, 245, 252);">
                <h3>List a Book</h3>
                <small>Fill out as many fields as possible.</small>
            </div>
            <div class="card-body">
                <div class="card col-md-12" style="float: left;">
                    <div class="card-header">
                        <h4>Book info</h4>
                    </div>
                    <div class="card-body col-md-12 form">

                        <form method="post" id="message-form" action="?command=message">

                            <label for="title">Title:</label><br>
                            <input type="text" id="title" name="title" placeholder="Title" size=50 required><br>
                            <label for="body">Body:</label><br>
                            <textarea id="body" name="text" rows="10" cols="80"></textarea>
                            <input type="hidden" id="bookid" name="bookid" value="<?= $book["id"] ?>">
                            <input type="hidden" id="senderid" name="senderid" value="<?= $poster["id"] ?>">
                            <input type="hidden" id="receiverid" name="receiverid" value="<?= $seller["id"] ?>"><br>
                            
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Send</button>




                        </form>
                    </div>
                </div>


                <?php include("templates/footer.php"); ?>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>