<!DOCTYPE html>
 <html lang="en">

<body>

    <div class="card col-md-4" id="book-item" style="width: 20rem;">
        <a href="bookview.php?id=<?=$id?>">
            <div class="card-header">
                <h5 class="card-title text-justify text-center " id="book-title"><?=$title?></h5>
                <h6 class="card-subtitle mb-1 text-justify text-center text-muted" id="publish-date">Published: <?=$edition?></h6>
            </div>
            <div class="card-body col-md-12">  
                <img src="<?=$url?>" class="float-center w-100 ml-10 mr-10 book-image"
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