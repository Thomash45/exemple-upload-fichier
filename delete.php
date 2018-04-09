<?php
/**
 * Created by PhpStorm.
 * User: mrtho
 * Date: 09/04/2018
 * Time: 00:53
 */

if (!empty($_POST['delfilename'])) {

    $fichier = 'upload/'.$_POST['delfilename'];
    echo $fichier;

   if( file_exists ( $fichier))
       unlink( $fichier ) ;


    header('Location: index.php');
    exit();

}