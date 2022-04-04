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
                            
                            <form method="post" id="sell-form" action="list_book.php">
                                <label for="title">Title:</label><br>
                                <input type="text" id="title" name="title" placeholder="Title" required><br>
                                <label for="author">Author:</label><br>
                                <input type="text" id="author" name="author" placeholder="Author" required><br>
                                <label for="edition">Edition:</label><br>
                                <input type="text" id="edition" name="edition" placeholder="Edition" required><br>
                                <label for="isbn">ISBN:</label><br>
                                <input type="text" id="isbn" name="isbn" placeholder="ISBN" required><br>
                                <label >Condition:</label><br>
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" 
                                aria-expanded="false">New</button><br>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">New</a></li>
                                    <li><a class="dropdown-item" href="#">Used</a></li>
                                </ul>
                                <label for="related-classes">Relevant Classes:</label><br>
                                <input type="text" id="related-classes" name="related-classes" placeholder="Related" required><br>
                                <label for="img">Select image:</label><br>
                                <input type="file" id="img" name="img" accept="image/*"><br>
                                <label for="price">Sale Price:</label><br>
                                <input type="text" id="price" name="price" placeholder="$"><br>
                                <label for="description">Description:</label><br>
                                <textarea name="description" id="description" cols="30" rows="5" placeholder="Description" ></textarea>
                                
                            </form>
                        </div>  
                    </div>
                    <div class="card col-md-6" style="float: left;">
                        <div class="card-header">
                            <h4>Seller info</h4>
                        </div>
                        <div class="card-body col-md-12">  
                            <form id="sell-form1" action="./list_book.php">
                                <label for="use-profile">Use Profile Info:</label>
                                <input type="checkbox" name="use-profile" id="use-profile"><br><br>
                                <label for="fname">First Name:</label><br>
                                <input type="text" id="fname" name="fname" placeholder="First" required><br>
                                <label for="lname">Last Name:</label><br>
                                <input type="text" id="lname" name="lname" placeholder="Last" required><br>  
                                <label for="email">Email:</label><br>
                                <input type="email" id="email" name="email" placeholder="Email" required><br> 
                                <label for="phone">Phone:</label><br>
                                <input type="tel" id="phone" name="phone" placeholder="Number" required><br>                         
                            </form>
                        </div>  
                    </div>   
                </div>
                <div class="card-footer" style="text-align: right; background-color: rgb(144, 245, 252); border: 1px solid black;">
                    <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
                </div>
            </div>
        </div>

        <script>
            function submitForm() {
                alert("Backend not done yet");
            }
        </script>


        <?php include("templates/footer.php"); ?>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
     </body>
 </html>