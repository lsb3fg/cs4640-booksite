<?php
spl_autoload_register(function ($classname) {
    include "classes/$classname.php";
});

$db = new Database();
session_start();

$task;

if (!isset($_SESSION["email"])) {
    $task = "create";
} else {
    $task = "update";
    $email = $_SESSION["email"];
}


if (isset($_GET["task"])) {


    if ($_GET["task"] === "create") {
        #print("here 1");
        $success = True;
        $required = array("username", "email", "password");

        foreach ($required as $i) {
            if (!isset($_POST[$i])) {
                $error_msg = "missing argument: " . $i;
                $success = False;
            }
        }
        if ($success === True) {
            $success2 = True;
            if (!preg_match('/^[a-zA-Z0-9_-]/', $_POST["username"])) {
                $error_msg = "Username may only contain letters, numbers, - and _";
                $success2 = False;
            }
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $error_msg = "Invalid email format";
                $success2 = False;
            }


            if ($success2 === True) {
 
                $optional = array("firstname", "lastname", "nickname", "phone");
                
                foreach ($optional as $i) {
                    if (!isset($_POST[$i])) {
                        $_POST[$i] = null;
                    }
                }

                if(!isset($_POST["phone"]) && !preg_match('/^([0-9]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST["phone"])){
                    $error_msg = "Phone must be formatted as XXX-XXX-XXX or X-XXX-XXX-XXXX";
                    
                }
                else if (!empty($db->query("select * from users where email = ?;", "s", $_POST["email"]))) {
                    #print("test1");
                    $error_msg = "Email already registered";
                } else {
                    $insert = $db->query("insert into users (username, email, passwordhash,creationdate,firstname,lastname,nickname,phone) values (?, ?, ?, ?, ?, ?, ?, ?);", "ssssssss", strip_tags($_POST["username"]), strip_tags($_POST["email"]), strip_tags(password_hash($_POST["password"], PASSWORD_DEFAULT)), strip_tags(date('Y-m-d H:i:s')), strip_tags($_POST["fname"]), strip_tags($_POST["lname"]), strip_tags($_POST["nick"]),strip_tags( $_POST["phone"]));
                    if ($insert === false) {
                        #print("test1");
                        $error_msg = "Error inserting user";
                    }
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: index.php");
                }
            }
        }
    }
    if (($_GET["task"] === "update")) {

        $success = True;
        $required = array("username", "email", "password");

        foreach ($required as $i) {
            if (!isset($_POST[$i])) {
                $error_msg = "missing argument: " . $i;
                $success = False;
            }
        }
        if ($success === True) {
            $success2 = True;
            if (!preg_match('/^[-a-zA-Z0-9_]+$/', $_POST["username"])) {
                $error_msg = "Username may only contain letters, numbers, - and _";
                $success2 = False;
            }
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $error_msg = "Invalid email format";
                $success2 = False;
            }

            if ($success2 === True) {

                $optional = array("firstname", "lastname", "nickname", "phone");
                
                foreach ($optional as $i) {
                    if (!isset($_POST[$i])) {
                        $_POST[$i] = null;
                    }
                }

                if(!preg_match('/^([0-9]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST["phone"])){
                    $error_msg = "Phone must be formatted as XXX-XXX-XXX or X-XXX-XXX-XXXX";
                    
                }
                else{



                $update = $db->query("update users set username=?, email=?, passwordhash=?, firstname=?, lastname=?, nickname=?, phone=? where email=?;", "ssssssss", strip_tags($_POST["username"]), strip_tags($_POST["email"]), strip_tags(password_hash($_POST["password"], PASSWORD_DEFAULT)), strip_tags($_POST["fname"]),strip_tags( $_POST["lname"]),strip_tags( $_POST["nick"]), strip_tags($_POST["phone"]), strip_tags($_SESSION["email"]));
                if ($update === false) {
                    #print("test1");
                    $error_msg = "Error updating user";
                } else {
                    header("Location: index.php");
                }
            } 
        }else {
                # print("test3");
                $_SESSION["email"] = $_POST["email"];
                #header("Location: index.php");
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

    <meta name="author" content="Luke Britton, Maxim Gorodchanin">
    <title>UVA Textbook Sales</title>
    <meta name="description" content="index page for CS4640 project">
    <meta name="keywords" content="define keywords for search engines">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles/main.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script src="./scripts/new_account_validation.js"></script>
    <script>
        $(document).ready(function() {
            class User {
                constructor (id, fname, lname, email, phone, nickname, username){
                    this.id = id;
                    this.fname = fname;
                    this.lname = lname;
                    this.email = email;
                    this.phone = phone;
                    this.nickname = nickname;
                    this.username = username;
        
                }
            }
            function autofill(){
                var user = new User();
                var email = "<?php echo $email?>";
                user.email = email;
                $.getJSON("apis/emailtouser.php?email=" + email, function(data) {
                    if(data['success']==true){
                        user.fname = data["firstname"];
                        user.lname = data["lastname"];
                        user.phone = data["phone"];
                        user.nickname = data["nickname"];
                        user.username = data["username"];
                        $("#fname").val(user.fname);
                        $("#lname").val(user.lname);
                        $("#email").val(user.email);
                        $("#phone").val(user.phone);
                        $("#nickname").val(user.nickname);
                        $("#username").val(user.username);
                    }
                    else{
                        alert(data['error']);
                    }

                });
                
            }
            document.getElementById("autofill").addEventListener("click", function () {
                if(document.getElementById("autofill").checked == true){
                    autofill();
                }
                else {
                    $("#fname").val("");
                    $("#lname").val("");
                    $("#email").val("");
                    $("#phone").val("");
                }
                
            });

        });
    </script>
    
</head>

<body>
    <header>
        <?php include("templates/nav.php"); ?>
        <div id="main-header" style="text-align: center;">
            <h1>CS4640 Project: Online Textbook Shop</h1>
        </div>

    </header>
    <h2 style="text-align: center">Fill out the fields to update/edit your account information.</h2>
    <div class="page-wrap align-items-start" id="page-container-account">

        <!-- <div style="justify-content: center"> -->
        <div class="card col-md-4">
            <div class="card-header">
                <h4><?php if ($task === "create") {
                        echo "Create Account";
                    } else {
                        echo "Update Info";
                    } ?> </h4>
                <?php

                if (!empty($error_msg)) {
                    #  print("test5");
                    echo "<div class='alert alert-danger'>$error_msg</div>";
                }
                ?>
            </div>

            <div class="card-body col-md-12">
                <form id="sell-form1" action="./account.php?task=<?= $task ?>" method="post">
                    <label for="autofill">Use Profile Info:</label>
                    <input type="checkbox" name="use-profile" id="autofill"><br><br>
                    <label for="username">Username*:</label><br>
                    <input class="form-control"type="text" id="username" name="username" placeholder="Username" required><br>
                    <label class="form-label" for="password">Password*:</label><br>
                    <input type="password" id="password" class="form-control" placeholder="Password" name="password" required /><br>
                    <div style="color: red" id="pwhelp"></div>
                    <label for="email">Email*:</label><br>
                    <input class="form-control"type="email" id="email" name="email" placeholder="Email" required><br>
                    <label for="fname">First Name:</label><br>
                    <input class="form-control" type="text" id="fname" name="fname" placeholder="First"><br>
                    <label for="lname">Last Name:</label><br>
                    <input class="form-control" type="text" id="lname" name="lname" placeholder="Last"><br>
                    <label for="nickname">Nickname/Username:</label><br>
                    <input class="form-control" type="text" id="nickname" name="nick" placeholder="Nickname"><br>

                    <label for="phone">Phone:</label><br>
                    <input class="form-control"type="tel" id="phone" name="phone" placeholder="Number"><br>

                    <!-- <button class="btn btn-primary btn-block" type="submit">Submit</button>                        -->

            </div>
            <div class="card-footer" style="text-align: right;">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        <!-- </div>  -->
    </div>




    <?php include("templates/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>