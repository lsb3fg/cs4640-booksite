<?php
session_start();
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
                <h1>CS4640 Project: Online Textbook Shop</h1>
              </div>
             
         </header>

         <div id="page-container">
            <?php 
              // session_start();
              if(isset($_SESSION["email"])){
                  echo "Hello " . $_SESSION["email"];  
              }
              else{
                echo "Not logged in";
              }
              
            
            ?>
         </div>

         <?php include("templates/footer.php"); ?>
         
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
     </body>
 </html>