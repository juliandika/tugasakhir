<?php

    include('connect.php');
 
    $id=$_GET['id'];
 
    mysqli_query($conn,"DELETE FROM mahasiswa WHERE nim='$id'");

    header('location:view_mhs.php');


?>