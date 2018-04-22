<?php


    include('connect.php');
    include('hitungbobot.php');
    include('hitungvektor.php');

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
    mysqli_query($conn, "DELETE FROM dok9 WHERE nama_file='".$nama_file."'");
    hitungBobot();
    hitungvektor();
    header('location:dashboard.php');

?>