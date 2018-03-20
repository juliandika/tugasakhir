<?php


include "connect.php";
include "toIndex.php";

session_start();

if(!isset($_SESSION['username'])){

    header('location: login.php');
}

?>

<?php

	$nim = $_SESSION['nim'];

	$lokasi_file_cover = $_FILES['cover']['tmp_name'];
	$nama_file_cover   = ($_FILES['cover']['name']);

	$lokasi_file_pengesahan = $_FILES['pengesahan']['tmp_name'];
	$nama_file_pengesahan  = ($_FILES['pengesahan']['name']);

	$lokasi_file_daftarisi = $_FILES['daftarisi']['tmp_name'];
	$nama_file_daftarisi  = ($_FILES['daftarisi']['name']);

	$lokasi_file_babii = $_FILES['babii']['tmp_name'];
	$nama_file_babii  = ($_FILES['babii']['name']);

	$lokasi_file_babiii = $_FILES['babiii']['tmp_name'];
	$nama_file_babiii  = ($_FILES['babiii']['name']);

	$lokasi_file_babiv = $_FILES['babiv']['tmp_name'];
	$nama_file_babiv  = ($_FILES['babiv']['name']);

	$lokasi_file_babv = $_FILES['babv']['tmp_name'];
	$nama_file_babv  = ($_FILES['babv']['name']);

	$lokasi_file_dapus = $_FILES['dapus']['tmp_name'];
	$nama_file_dapus  = ($_FILES['dapus']['name']);

	$lokasi_file_halbelakang = $_FILES['halbelakang']['tmp_name'];
	$nama_file_halbelakang  = ($_FILES['halbelakang']['name']);

	$folder1 = "fileupload/$nama_file_cover";
	$folder2 = "fileupload/$nama_file_pengesahan";
	$folder3 = "fileupload/$nama_file_daftarisi";
	$folder4 = "fileupload/$nama_file_babii";
	$folder5 = "fileupload/$nama_file_babiii";
	$folder6 = "fileupload/$nama_file_babiv";
	$folder7 = "fileupload/$nama_file_babv";
	$folder8 = "fileupload/$nama_file_dapus";
	$folder9 = "fileupload/$nama_file_halbelakang";

	if(move_uploaded_file($lokasi_file_cover,"$folder1")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 1, '$nama_file_cover')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_cover);
	}

	

	if(move_uploaded_file($lokasi_file_pengesahan,"$folder2")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 2, '$nama_file_pengesahan')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_pengesahan);

	}


	if(move_uploaded_file($lokasi_file_daftarisi,"$folder3")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 3, '$nama_file_daftarisi')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_daftarisi);

	}

	if(move_uploaded_file($lokasi_file_babii,"$folder4")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 4, '$nama_file_babii')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_babii);

	}

	if(move_uploaded_file($lokasi_file_babiii,"$folder5")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 5, '$nama_file_babiii')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_babiii);

	}

	if(move_uploaded_file($lokasi_file_babiv,"$folder6")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 6, '$nama_file_babiv')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_babiv);

	}

	if(move_uploaded_file($lokasi_file_babv,"$folder7")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 7, '$nama_file_babv')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_babv);

	}

	if(move_uploaded_file($lokasi_file_dapus,"$folder8")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 8, '$nama_file_dapus')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_dapus);

	}

	if(move_uploaded_file($lokasi_file_halbelakang,"$folder9")){

	  $query = "INSERT INTO documents (nim, id_label, nama_file)
	            VALUES('$nim', 9, '$nama_file_halbelakang')";
	            
	  mysqli_query($conn, $query);

	  toIndex($nama_file_halbelakang);

	}


?>