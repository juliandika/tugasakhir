<?php
 
require_once "connect.php";

error_reporting(E_ALL);
 
$id_fakultas = $_POST['id_fakultas'];
 
if($id_fakultas == ''){
     exit;
}else{
     $sql = "SELECT
               id_jurusan,
               nama_jurusan
          FROM
               jurusan
          WHERE
               id_fakultas = '$id_fakultas'
          ORDER BY nama_jurusan";
          
     $getNamaJurusan = mysqli_query($conn, $sql) or die ('Query Gagal');
     while($data = mysqli_fetch_array($getNamaJurusan)){
          echo '<option value="'.$data['id_jurusan'].'">'.$data['nama_jurusan'].'</option>';
     }
     exit;  
}

?>