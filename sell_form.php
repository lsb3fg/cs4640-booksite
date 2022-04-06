<?php

spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

$db = new Database();
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: index.php?errormsg=Not Logged In");

}
else{
    if(isset($_GET["command"])){
        if($_GET["command"]==="sell"){
            
            $data = $db->query("select id from users where email = ?;","s",$_SESSION["email"]);
                        if($data===false){
                            $error_msg = "SQL ERROR";
                        } else if (!empty($data)){
                            $userid= $data[0]["id"];
                        
            $insert = $db->query("insert into books (seller, price, title,author,edition,isbn,classes,imagelink,description,quality,dateadded) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);",
             "sdsssssssss",
              $userid, strip_tags($_POST["price"]), strip_tags($_POST["title"]),strip_tags($_POST["author"]),strip_tags($_POST["edition"]),strip_tags($_POST["isbn"]),strip_tags($_POST["classes"]),strip_tags($_POST["imagelink"]),strip_tags($_POST["description"]),strip_tags($_POST["quality"]),date('Y-m-d H:i:s'));
            if ($insert === false) {
                    #print("test1");
            $error_msg = "Error creating sale";
        } else {
            print($insert);
            header("Location: all_books.php");
        }
    }
    }















}
}
?>



<!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1"> 

         <meta name="author" content="Luke Britton">
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

         <div class="page-wrap">
            <div class="card text-center col-md-8" style="border: 1px solid black;">
                <div class="card-header" style="background-color: rgb(144, 245, 252);">
                  <h3>List a Book</h3> 
                  <small>Fill out as many fields as possible.</small>
                </div>
                <div class="card-body">
                    <div class="card col-md-6" style="float: left;">
                        <div class="card-header">
                            <h4>Book info</h4>
                        </div>
                        <div class="card-body col-md-12 form">
                            
                            <form method="post" id="sell-form" action="sell_form.php?command=sell">
                                <label for="title">Title:</label><br>
                                <input type="text" id="title" name="title" placeholder="Title" required><br>
                                <label for="author">Author:</label><br>
                                <input type="text" id="author" name="author" placeholder="Author" required><br>
                                <label for="edition">Edition:</label><br>
                                <input type="text" id="edition" name="edition" placeholder="Edition" required><br>
                                <label for="isbn">ISBN:</label><br>
                                <input type="text" id="isbn" name="isbn" placeholder="ISBN" required><br>

                                <label for="type" class="form-label">Condition</label>
                        <select name="quality" id="type">
                            <option value="new">New</option>
                            <option value="used">Used</option>
                        </select><br>
                                <label for="related-classes">Relevant Classes:</label><br>
                                <input type="text" id="related-classes" name="classes" placeholder="Related" required><br>
                                <label for="img">Insert image URL:</label><br>
                                <input type="url" id="img" name="imagelink" ><br>
                                <label for="price">Sale Price:</label><br>
                                <input type="number" id="price" name="price" placeholder="$" step="any"><br>
                                <label for="description">Description:</label><br>
                                <textarea name="description" id="description" cols="30" rows="5" placeholder="Description" ></textarea>
                                

                        </div>  
                    </div>
                    <div class="card col-md-6" style="float: left;">
                        <div class="card-header">
                            <h4>Seller info</h4>
                        </div>
                        <div class="card-body col-md-12">  

                                <label for="use-profile">Use Profile Info:</label>
                                <input type="checkbox" name="use-profile" id="use-profile"><br><br>
                                <label for="fname">First Name:</label><br>
                                <input type="text" id="fname" name="fname" placeholder="First" ><br>
                                <label for="lname">Last Name:</label><br>
                                <input type="text" id="lname" name="lname" placeholder="Last" ><br>  
                                <label for="email">Email:</label><br>
                                <input type="email" id="email" name="email" placeholder="Email" ><br> 
                                <label for="phone">Phone:</label><br>
                                <input type="tel" id="phone" name="phone" placeholder="Number" ><br>                         

                        </div>  
                    </div>   
                </div>
                <div class="card-footer" style="text-align: right; background-color: rgb(144, 245, 252); border: 1px solid black;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>



        <?php include("templates/footer.php"); ?>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
     </body>
 </html>