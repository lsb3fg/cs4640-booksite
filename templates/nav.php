<!-- <?php session_start();?> -->





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
         <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

         <script>
             function outofscopesearch(){
                var url = "all_books.php?search=";
                var search = $("#searchvalue").val();
                window.location.href = url+search;

             }


         </script>
    </head>  
        <body>
            <header>               
            <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="./index.php">
                        <img class="logo" src="https://crossler.salkeiz.k12.or.us/wp-content/uploads/sites/3/2020/09/textbook.png" alt="books"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="nav bar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./all_books.php">View Listings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./sell_form.php">Sell a Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./account.php">Create/Edit Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./message_list.php">My Messages</a>
                        </li>
                        </ul>

                        <input class="form-control me-2" type="search" placeholder="Search by Title" aria-label="Search" id="searchvalue">
                        <button class="btn btn-outline-success" id="searchbutton" onclick="outofscopesearch()">Search</button>

                        <div id="login-button" style="margin-left: 15px; float:right">
                            <a href="./login.php" class="btn btn-outline-primary">
                                <?php 
                                    if(isset($_SESSION["email"])){
                                        echo "Logout";
                                    }else{
                                        echo "Login";
                                    }
                                    

                                ?>
                            </a>
                        </div>
                        <div style="color: white">
                            <?php 
                                if(isset($_SESSION["email"])){
                                    echo "Hello " . $_SESSION["email"];  
                                }
                                echo "";
                            
                            ?>
                        </div>
                </div>
            </nav>
    </header>
    </body>
</html>