<?php


    include('connect.php');
    include('hitungbobot.php');
    include('hitungvektor.php');

    $nama_dokumen = $_GET["nama_dokumen"];

    $data = $nama_dokumen;
    $dir = "../mahasiswa/fileupload";
    $dirHandle = opendir($dir); 

    while ($file = readdir($dirHandle)) {
            
            if($file==$data) {
                
                unlink($dir.'/'.$file);

                echo "Success";

         }
    }
 
    mysqli_query($conn, "DELETE FROM tb_dokumen WHERE nama_dokumen='".$nama_dokumen."'");
    mysqli_query($conn, "DELETE FROM tb_term WHERE nama_dokumen='".$nama_dokumen."'");
    hitungbobot();
    hitungvektor();
    header('location:dashboard.php');

?>