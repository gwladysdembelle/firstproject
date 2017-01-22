<?php
require '../classes/EnvoiEmail.class.php';

if($_GET['path']){
    $file = trim(str_replace('"', '', str_replace('\\', '', $_GET['path'])));


    // force user to download the image
    if(file_exists($file)) {
        // envoi un mail
        new EnvoiEmail($file);

        //Affiche à l'ecran ou propose le téléchargement
        header('Content-Description: File Transfer');
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
    else {
        echo $file." not found";
    }
}
?>
