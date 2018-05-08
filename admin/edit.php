<?php

	error_reporting(E_ALL);
  
    include('connect.php');
 
    $id=$_GET['id'];
 
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $id_fakultas = $_POST['cmbFakultas'];
    $id_jurusan = $_POST['cmbJurusan'];
 
    mysqli_query($conn,"UPDATE tb_mahasiswa SET nama = '$nama', id_fakultas = $id_fakultas, id_jurusan = $id_jurusan WHERE nim='".$id."'");

    header('location:view_mhs.php');


?>