<?php


    include('connect.php');

    $nama_dokumen = $_GET["nama_dokumen"];

    $data = $nama_file;
    $dir = "../mahasiswa/fileupload";
    $dirHandle = opendir($dir); 

    while ($file = readdir($dirHandle)) {
            
            if($file==$data) {
                
                unlink($dir.'/'.$file);

                echo "Success";

         }
    }
 
    mysqli_query($conn, "DELETE FROM tb_dokumen WHERE nama_dokumen='".$nama_dokumen."'");

    header('location:my_docs.php');

?>