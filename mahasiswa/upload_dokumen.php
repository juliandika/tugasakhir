<?php


include "connect.php";
include "toIndex.php";
include "hitungBobot.php";
include "hitungVektor.php";

session_start();

if(!isset($_SESSION['username'])){

    header('location: login.php');
}

?>

<?php

	$redirect = "upload.php";

	$nim = $_SESSION['nim'];

	$judul = $_POST['judul'];

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


	$errors     = array();
    $maxsize    = 5242880;
    $acceptable = array(
        'application/pdf'
    );

    if(($_FILES['cover']['size'] >= $maxsize) || ($_FILES["cover"]["size"] == 0)) {
        $errors[] = 'File tidak boleh lebih besar dari 5 MB';

        header('Location:upload.php?error_size=1');
    }

    if((!in_array($_FILES['cover']['type'], $acceptable)) && (!empty($_FILES["cover"]["type"]))) {
        $errors[] = 'File harus berformat PDF';

        header('Location:upload.php?error_type=1');
    }

    if(count($errors) === 0) {


			if(move_uploaded_file($lokasi_file_cover,"$folder1")){

			  $query = "INSERT INTO documents (nim, judul, id_label, nama_file, upload_date, status_index)
			            VALUES('$nim','$judul',1, '$nama_file_cover', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_cover);
			}

			

			if(move_uploaded_file($lokasi_file_pengesahan,"$folder2")){

			  $query = "INSERT INTO documents (nim, judul,id_label, nama_file, upload_date, status_index)
			            VALUES('$nim', '$judul', 2, '$nama_file_pengesahan', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_pengesahan);

			}


			if(move_uploaded_file($lokasi_file_daftarisi,"$folder3")){

			  $query = "INSERT INTO documents (nim, judul, id_label, nama_file, upload_date, status_index)
			            VALUES('$nim', '$judul', 3, '$nama_file_daftarisi', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_daftarisi);

			}

			if(move_uploaded_file($lokasi_file_babii,"$folder4")){

			  $query = "INSERT INTO documents (nim, judul, id_label, nama_file, upload_date, status_index)
			            VALUES('$nim', '$judul', 4, '$nama_file_babii', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_babii);

			}

			if(move_uploaded_file($lokasi_file_babiii,"$folder5")){

			  $query = "INSERT INTO documents (nim, judul, id_label, nama_file, upload_date, status_index)
			            VALUES('$nim', '$judul', 5, '$nama_file_babiii', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_babiii);

			}

			if(move_uploaded_file($lokasi_file_babiv,"$folder6")){

			  $query = "INSERT INTO documents (nim, judul, id_label, nama_file, upload_date, status_index)
			            VALUES('$nim', '$judul', 6, '$nama_file_babiv', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_babiv);

			}

			if(move_uploaded_file($lokasi_file_babv,"$folder7")){

			  $query = "INSERT INTO documents (nim, judul, id_label, nama_file, upload_date, status_index)
			            VALUES('$nim', '$judul', 7, '$nama_file_babv', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_babv);

			}

			if(move_uploaded_file($lokasi_file_dapus,"$folder8")){

			  $query = "INSERT INTO documents (nim, judul, id_label, nama_file, upload_date, status_index)
			            VALUES('$nim', '$judul', 8, '$nama_file_dapus', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_dapus);

			}

			if(move_uploaded_file($lokasi_file_halbelakang,"$folder9")){

			  $query = "INSERT INTO documents (nim, judul, id_label, nama_file, upload_date, status_index)
			            VALUES('$nim', '$judul', 9, '$nama_file_halbelakang', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_file_halbelakang);

			}

			mysqli_query($conn, "UPDATE mahasiswa SET status_upload = 'yes' WHERE nim=$nim");

			header('Location:upload.php?success=1');
	}

	//hitungBobot();
	//hitungVektor();

	//header('Location: '.$redirect);


?>