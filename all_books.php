<?php

spl_autoload_register(function ($classname) {
    include "classes/$classname.php";
});

$db = new Database();
session_start();


$data = $db->query("select * from books;");

if ($data === false) {
    print("SQL ERROR");
} else {



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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./styles/main.css" />

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


        <script>
            var returnedjson = null;

            function search(value=null) {
                var url = "apis/search.php?";
                var search = $("#searchvalue").val();

                if(value!=null){
                    search=value;
                }
                // alert("Searching for "+value);
                url += "search=" + search;
                $.getJSON(url, function (data) {
                returnedjson = data;
                updatepage();
            });
            }

            function updatecards(index){
               // for(let i = 0; i<returnedjson['data'].length; i++){

                let current = "boxnumber"+index;
                let current_book = returnedjson['data'][index];
                $("#"+current+" .viewlink").attr('href','bookview.php?id='+current_book['id']);
                            $("#"+current+" .book-title").html(current_book['title']);
                            $("#"+current+" .publish-date").html("Edition: "+current_book['edition']);
                            $("#"+current+" .book-image").attr('src',current_book['imagelink']);
               // }
            }

            function updatepage() {
  
                if (returnedjson === null) {
                    search("");
                } else if(returnedjson['success']!=true){
                    alert("JSON FAILED");
                }
                else{

                    $("#containers").empty();
                    for(let i = 0; i<returnedjson['data'].length; i++){
                        let current_book = returnedjson['data'][i];
                        let text = '<ahh id="boxnumber'+i+'"></ahh>';
                        let current = "boxnumber"+i;
                        $("#containers").append(text);
                        $("#"+current).load("templates/book_item.php",function(){updatecards(i);});
                    }
                }
            }
        </script>

    </head>

    <body>
        <?php include("templates/nav.php"); ?>
        <div>
            <h2 style="text-align: center; margin-top: 15px; margin-bottom: 25px;">Showing results for: "all"</h2>
        </div>

        <div class="page-wrap" id="page-container-account">
            <div style="display:flex; flex-wrap: wrap" id="containers">
                <?php
                // for ($i = 0; $i < count($data); $i++) {

                //     $book = $data[$i];
                //     $id = $book["id"];

                //     $title = $book["title"];
                //     $edition = $book["edition"];
                //     $url = $book["imagelink"];

                //     include("templates/book_item.php");
                // }

                ?>





            </div>
        </div>



        <?php include("templates/footer.php"); ?>

        <script>
            $("#searchbutton").bind("click", function(){search();});
            $(document).ready(function(){
                updatepage();
            });


            
        </script>
    </body>

    </html>

<?php } ?>