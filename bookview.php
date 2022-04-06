<?php

spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

$db = new Database();
session_start();


if(!isset($_GET["id"])){


include("booknotfound.php");

}

else{

    $data = $db->query("select * from books where id = ?;","i",$_GET["id"]);
    if($data===false){
        print("SQL ERROR");
    } else if (!empty($data)){
        $book = $data[0];

    $data = $db->query("select * from users where id = ?;","i",$book["seller"]);
        if($data===false){
            print("SQL ERROR");
        } else{

            $user=$data[0];
        }






?>





<!DOCTYPE html>
<html lang="en">


<!-- 
    Sources Cited:
https://getbootstrap.com/docs/4.4/components/card/
https://getbootstrap.com/docs/4.0/content/images/
https://getbootstrap.com/docs/5.1/components/carousel/ (heavily)
https://stackoverflow.com/questions/46944313/bootstrap-4-beta-carousel-arrows-outside-slider-area
https://forum.bootstrapstudio.io/t/carousel-indicators-colour/7090/5
https://stackoverflow.com/questions/35294520/bootstrap-carousel-controls-outside-of-carousel
https://stackoverflow.com/questions/35352336/setting-a-max-height-on-a-bootstrap-carousel
https://stackoverflow.com/questions/13391566/twitter-bootstrap-carousel-different-height-images-cause-bouncing-arrows
https://stackoverflow.com/questions/18990675/how-to-fix-a-footer-overlapping-content
You can see that the carousel was unnecessarily difficult for me.

https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
For email button
 -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maxim Gorodchanin">
    <title>UVA Textbook Sales</title>
    <meta name="description" content="book example page for CS4640 project">
    <meta name="keywords" content="Book Title UVA">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles/main.css" />
</head>



<body>
    <header>
        <?php include("templates/nav.php"); ?>
        <div id="main-header" style="text-align: center;">
            <h1>CS4640 Project: Online Textbook Shop</h1>
        </div>

    </header>



    <div class="page-wrap align-items-start" style="min-height: 0px;">
        <div class="row d-flex justify-content-center align-items-start" id="book-description" style="margin:0">
            <div class="card shadow-2-strong col-md-10 bg-lighter" style="border-radius: 1rem; padding: 1%; ">
                <div class="row no-gutters">




                    <div class="col-md-6">
                        <h5 class="card-title text-justify text-center " id="book-title"><?=$book["title"]?></h5>
                        <h6 class="card-subtitle mb-1 text-justify text-center text-muted" id="book-author">By <?=$book["author"]?></h6>
                        <h6 class="card-subtitle mb-1 text-justify text-center text-muted" id="publish-date">Edition:<?=$book["edition"]?></h6>
                        <?php
                        if($book["imagelink"]!== ""){?>
                        <!-- MF IMAGE CAROUSEL -->
                        <div id="bookslides" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#bookslides" data-bs-slide-to="0" class="active"></li>
                                <li data-bs-target="#bookslides" data-bs-slide-to="1"></li>
                            </ol>
                            <div class="carousel-inner justify-content-center">

                                <div class="carousel-item active" style=" overflow: hidden;">

                                    <img src="<?=$book["imagelink"]?>" class="float-center w-100 ml-10 mr-10 book-image"
                                        alt="picture of book" style="  
                                            min-width: 200px; height: 300px;">
                                </div>

                                <div class="carousel-item" style=" overflow: hidden;">
                                    <img src="<?=$book["imagelink"]?>" class="float-center w-100 ml-10 mr-10 book-image"
                                        alt="an alternative image of a book" style=" 
                                            min-width: 200px; height: 300px;">
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#bookslides"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#bookslides"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <?php }
                        else{
                            echo "<p>No image!</p>";
                        }
                        ?>




                    </div>
                    <div class="col-md-6 ">
                        <div id="description">
                            <h6 class="card-subtitle mb-2 text-justify text-center " id="price"> $<?=$book["price"]?></h6>
                            <span>Seller: <a href="account.php"><?=$user["firstname"]?> <?=$user["lastname"]?> <?php if(!isset($user["firstname"])&&!isset($user["lastname"])){
                                echo $user["username"];
                                }
                                ?></a></span> <br>


                            <span>Email: <a id="email" style="display: none;"
                                    href="mailto:johndoe@virgnia.edu"><?=$user["email"]?></a> <button
                                    onclick="revealEmail()">Reveal Email</button></span> <br>

                            <hr class="solid">
                            <span>Title: <?=$book["title"]?></span> <br>
                            <span>ISBN: <?=$book["isbn"]?></span> <br>
                            <span>Author(s): <?=$book["author"]?></span> <br>
                            <span>Condition: <?=$book["quality"]?></span> <br>
                            <hr class="solid">
                            <span><?=$book["classes"]?>
                            </span> <br>
                            <hr class="solid">
                            <span> <a href="search.html">Find Other Sellers</a></span> <br>
                            <hr class="solid">
                            <button onclick="location.href='./message.php?id=<?=$book['id']?>'">Contact Seller</button>
                        </div>
                    </div>
                </div>




                
                <script>
                    function disclaimerFunction() {
                        alert("Maybe we will actually make a shopping cart!");
                    }
                </script>









            </div>
        </div>

    </div>




    <?php include("templates/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

    <script>
        function revealEmail() {
            var e = document.getElementById('email')
        if( e.style.display != "inline"){
            var temp = confirm("Confirm that you are not a bot");
            if(temp){
                e.style.display = "inline"
            }
        }

        }
    </script>

    <script>
        function disclaimerFunction() {
            alert("Maybe we will actually make a shopping cart!");
        }
    </script>


</body>

</html>
<?php
}else{
    include("booknotfound.php");
}
}
?>