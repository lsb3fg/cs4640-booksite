<!DOCTYPE html>
 <html lang="en">
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
        <h2 style="text-align: center">Fill out the fields to update/edit your account information.</h2>
        <div class="page-wrap align-items-start">
       
            <!-- <div style="justify-content: center"> -->
                <div class="card col-md-4">
                    <div class="card-header">
                        <h4>Update info</h4>
                    </div>
                    <div class="card-body col-md-12">  
                        <form id="sell-form1" action="./update_user.php">
                            <label for="fname">First Name:</label><br>
                            <input type="text" id="fname" name="fname" placeholder="First" required><br>
                            <label for="lname">Last Name:</label><br>
                            <input type="text" id="lname" name="lname" placeholder="Last" required><br>  
                            <label for="nickname">Nickname/Username:</label><br>
                            <input type="text" id="nickname" name="fname" placeholder="Nickname" required><br>
                            <label for="email">Email:</label><br>
                            <input type="email" id="email" name="email" placeholder="Email" required><br> 
                            <label for="phone">Phone:</label><br>
                            <input type="tel" id="phone" name="phone" placeholder="Number" required><br>  
                            <!-- <button class="btn btn-primary btn-block" type="submit">Submit</button>                        -->
                        
                    </div>
                    <div class="card-footer" style="text-align: right;">
                        <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
                    </div>  
                    </form>
                </div>  
            <!-- </div>  -->
        </div>
        

         

         <?php include("templates/footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
     </body>
 </html>