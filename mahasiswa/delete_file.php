<?php


    include('connect.php');

    $nama_file = $_GET["nama_file"];

    $data = $nama_file;
    $dir = "../mahasiswa/fileupload";
    $dirHandle = opendir($dir); 

    while ($file = readdir($dirHandle)) {
            
            if($file==$data) {
                
                unlink($dir.'/'.$file);

                echo "Success";

         }
    }
 
    mysqli_query($conn, "DELETE FROM documents WHERE nama_file='".$nama_file."'");

    header('location:my_docs.php');

?>