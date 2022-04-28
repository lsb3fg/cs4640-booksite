<!DOCTYPE html>
 <html lang="en">

<body>

    <div class="card col-md-4" id="book-item" style="width: 20rem;">
        
            <div class="card-header">
            <!-- <a href="messageview.php?id=<?=$id?>"> -->
                <h3 class="card-title text-justify text-center " id="book-title"><?=$title?></h3><br>
                <!-- </a> -->
                <p class="card-title text-justify text-center " id="book-title">Sent by <?=$sender?></p><br>

            </div>
            <div class="card-body col-md-12">  
                <?=$body?>

            </div>


    </div>
</body>
</html>