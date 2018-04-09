<?php

$extensions=['image/jpeg','image/jpg','image/png','image/gif'];
$sizemax= 1000000;

if(isset($_POST['submit'])){
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
            //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){

                //save the filename
                $shortname = $_FILES['upload']['name'][$i];
                $extension = strrchr($_FILES['upload']['name'][$i], '.');
                $sizeFile = $_FILES['upload']['size'][$i];


                if (!in_array($_FILES['upload']['type'][$i],$extensions)){

                    $errors= "Echec de l'envoi, seul les fichiers  png, gif et jpg sont authorisées";
                    echo $_FILES['upload']['type'][$i];
                }


                if ($sizeFile > $sizemax){

                    $errors= "Echec de l'envoi, seul les fichiers de moins de 1Mo sont authorisés";

                }

                if (!isset($errors)){

                    $filePath = "upload/image" .uniqid().$extension;

                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $filePath)) {

                        $files[] = $shortname;


                    }


                }

            }
        }
    }

    //show success message
    /**if(!isset($errors)){

        echo "<h1>Uploaded:</h1>";
        if(is_array($files)){
            echo "<ul>";
            foreach($files as $file){
                echo "<li>$file</li>";
            }
            echo "</ul>";
        }

    }*/


}

$themedir = __DIR__.'/upload';


$iterator = new FilesystemIterator($themedir, FilesystemIterator::SKIP_DOTS);





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link rel="stylesheet" href="gallery-grid.css">

    <title>Wild Fest</title>
</head>
<body>

<div class="container">


    <h1 class="text-center">Ajouter une image</h1>
    <form class="form-group text-center" action="" enctype="multipart/form-data" method="post">
        <label for="file">Upload : </label>
        <input id='upload' name="upload[]" type="file" multiple="multiple" />
        <input type="submit" class="btn btn-success" name="submit" value="Envoyer" />

    </form>
    <div class="text-danger"> <?php if (isset($errors)){ echo $errors;} ?></div>

    <div class="tz-gallery">

        <div class="row">



            <?php
            foreach($iterator as $file) : ?>

            <div class="col-sm-6 col-md-4 mb-4">
                <a class="lightbox img-responsive" href="upload/<?php echo $file->getfilename(); ?>">
                    <img src="upload/<?php echo $file->getfilename(); ?>" alt="Park">
                </a>

                <form action="delete.php" method="POST">
                    <span class="text-center "> <?php echo $file->getfilename(); ?></span>
                    <input type="hidden" name="delfilename" value="<?=$file->getfilename()?>"/>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>

            </div>
            <?php endforeach; ?>

        </div>

    </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $('#g2016').hide();
    $('#g2015').hide();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>
</body>
</html>



