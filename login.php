<?php
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

$db = new Database();
session_start();


if(isset($_GET["command"])){
    
    if($_GET["command"]==="login"){
        if (isset($_POST["email"]) && !empty($_POST["email"])) { 
            
            $data = $db->query("select * from users where email = ?;","s",$_POST["email"]);

            if($data===false){
                #print("test2");
                $error_msg = "email or password is incorrect";
            } else if (!empty($data)){
                if(password_verify($_POST["password"], $data[0]["passwordhash"])){
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: ");
                  # print("test3");
                }
                else{
                    $error_msg = "email or password is incorrect";
                   # print("test4");
                }
                
            }
            else{
                $error_msg = "email or password is incorrect";

            }
        }
    }
    if($_GET["command"]==="logout"){
        session_destroy();
    }
}


if (!isset($_SESSION["email"])) {
    // they need to see the login
    

?>

<!DOCTYPE html>
 <html lang="en">
     <!-- Sources:
          https://mdbootstrap.com/docs/standard/extended/login/  

        -->
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
              <div id="main-header" style="text-align: center; margin-bottom: 25px;">
                <h1>CS4640 Project: Online Textbook Shop</h1>
              </div>
             
         </header>

         <div class="page-wrap align-items-start">
            
                <div class="card shadow-2-strong col-md-4 bg-light" style="border-radius: 1rem;" >
                    <div class="card-body p-5 text-center">
                    <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
                    <h3 class="mb-3 mt-0">Sign in</h3>
                    <form action="?command=login" method="post">
                    <div class="form-outline mb-4">
                        <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="email" />
                        <label class="form-label" for="typeEmailX-2">Email</label>
                    </div>
        
                    <div class="form-outline mb-3">
                        <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" />
                        <label class="form-label" for="typePasswordX-2">Password</label>
                    </div>
        
                    <div class="form-check d-flex justify-content-start mb-3">
                        <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        id="form1Example3"
                        
                        />
                        <label class="form-check-label" style="margin: 2px;" for="form1Example3"> Remember password </label>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>     
                    <br>   
                    <a href="account.php">No account? Click here to register!</a>
</form>
                    </div>
                </div>
            
         </div>

         <?php include("templates/footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
     </body>
 </html>

 <?php 
}
else{
    ?>
<!DOCTYPE html>
<html lang="en">
    <!-- Sources:
         https://mdbootstrap.com/docs/standard/extended/login/  

       -->
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
             <div id="main-header" style="text-align: center; margin-bottom: 25px;">
               <h1>CS4640 Project: Online Textbook Shop</h1>
             </div>
            
        </header>

        <div class="page-wrap align-items-start">
           
               <div class="card shadow-2-strong col-md-4 bg-light" style="border-radius: 1rem;" >
                   <div class="card-body p-5 text-center">
                        <h3>You are Already Logged in as: <?php 
                        $data = $db->query("select username from users where email = ?;","s",$_SESSION["email"]);
                        if($data===false){
                            $error_msg = "SQL ERROR";
                        } else if (!empty($data)){
                            echo $data[0]["username"];
                        }
                        ?></h3>
                        <a href="?command=logout">Log Out?</a>
                        
                   </div>
               </div>
           
        </div>

        <?php include("templates/footer.php"); ?>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>
<?php
}
 
 
 ?>