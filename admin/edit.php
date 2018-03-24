<?php

  
    include('connect.php');
 
    $id=$_GET['id'];
 
    $nama=$_POST['nama'];
 
    mysqli_query($conn,"UPDATE mahasiswa SET nama='$nama' WHERE nim='".$id."'");

    header('location:view_mhs.php');


?>