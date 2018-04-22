<?php

    include('connect.php');
 
    $id=$_GET['id'];

    $del = "DELETE FROM mahasiswa WHERE nim='$id'";
 
    mysqli_query($conn,"DELETE FROM mahasiswa WHERE nim='$id'");

    if($conn->query($del) === TRUE){
    	
    	echo json_encode(true);

    }else{

    	echo json_encode(false);
    }

?>