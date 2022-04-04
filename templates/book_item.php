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

    <div class="card col-md-4" id="book-item" style="width: 20rem;">
        <a href="bookview.php">
            <div class="card-header">
                <h5 class="card-title text-justify text-center " id="book-title">Book title</h5>
                <h6 class="card-subtitle mb-1 text-justify text-center text-muted" id="publish-date">Published
                    2023(first edition)</h6>
            </div>
            <div class="card-body col-md-12">  
                <img src="https://dictionary.cambridge.org/us/images/thumb/book_noun_001_01679.jpg?version=5.0.213" class="float-center w-100 ml-10 mr-10 book-image"
                                    alt="picture of book" style="  
                                        min-width: 150px; height: 250px;">
            </div>
            <div class="card-footer" style="text-align: right;">
                <button type="submit" class="btn btn-primary">View</button>
            </div>  
        </a>
    </div>
</body>
</html>