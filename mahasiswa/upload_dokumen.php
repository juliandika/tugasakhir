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
	$nama_dokumen_cover   = md5($_FILES['cover']['name']) . ".pdf";

	$lokasi_file_pengesahan = $_FILES['pengesahan']['tmp_name'];
	$nama_dokumen_pengesahan  = md5($_FILES['pengesahan']['name']) . ".pdf";

	$lokasi_file_daftarisi = $_FILES['daftarisi']['tmp_name'];
	$nama_dokumen_daftarisi  = md5($_FILES['daftarisi']['name']) . ".pdf";

	$lokasi_file_babii = $_FILES['babii']['tmp_name'];
	$nama_dokumen_babii  = md5($_FILES['babii']['name']) . ".pdf";

	$lokasi_file_babiii = $_FILES['babiii']['tmp_name'];
	$nama_dokumen_babiii  = md5($_FILES['babiii']['name']) . ".pdf";

	$lokasi_file_babiv = $_FILES['babiv']['tmp_name'];
	$nama_dokumen_babiv  = md5($_FILES['babiv']['name']) . ".pdf";

	$lokasi_file_babv = $_FILES['babv']['tmp_name'];
	$nama_dokumen_babv  = md5($_FILES['babv']['name']) . ".pdf";

	$lokasi_file_dapus = $_FILES['dapus']['tmp_name'];
	$nama_dokumen_dapus  = md5($_FILES['dapus']['name']) . ".pdf";

	$lokasi_file_halbelakang = $_FILES['halbelakang']['tmp_name'];
	$nama_dokumen_halbelakang  = md5($_FILES['halbelakang']['name']) . ".pdf";

	$folder_cover 		= "fileupload/$nama_dokumen_cover";
	$folder_pengesahan 	= "fileupload/$nama_dokumen_pengesahan";
	$folder_daftarisi	= "fileupload/$nama_dokumen_daftarisi";
	$folder_babii		= "fileupload/$nama_dokumen_babii";
	$folder_babiii		= "fileupload/$nama_dokumen_babiii";
	$folder_babiv		= "fileupload/$nama_dokumen_babiv";
	$folder_babv 		= "fileupload/$nama_dokumen_babv";
	$folder_dapus		= "fileupload/$nama_dokumen_dapus";
	$folder_halbelakang	= "fileupload/$nama_dokumen_halbelakang";


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
        $errors[] = 'File harus berformat PDF, Cover Belum Terupload';

        header('Location:upload.php?error_type=1');
    }

    if(($_FILES['pengesahan']['size'] >= $maxsize) || ($_FILES["cover"]["size"] == 0)) {
        $errors[] = 'File tidak boleh lebih besar dari 5 MB';

        header('Location:upload.php?error_size=1');
    }

    if((!in_array($_FILES['pengesahan']['type'], $acceptable)) && (!empty($_FILES["cover"]["type"]))) {
        $errors[] = 'File harus berformat PDF';

        header('Location:upload.php?error_type=1');
    }

    if(count($errors) === 0) {


    		//$nama_dokumen_cover = $nama_dokumen_cover . ".pdf";


			if(move_uploaded_file($lokasi_file_cover,"$folder_cover")){

			  $query = "INSERT INTO tb_dokumen (nim, judul, id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim','$judul',1, '$nama_dokumen_cover', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_cover);
			}

			

			if(move_uploaded_file($lokasi_file_pengesahan,"$folder_pengesahan")){

			  $query = "INSERT INTO tb_dokumen (nim, judul,id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim', '$judul', 2, '$nama_dokumen_pengesahan', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_pengesahan);

			}


			if(move_uploaded_file($lokasi_file_daftarisi,"$folder_daftarisi")){

			  $query = "INSERT INTO tb_dokumen (nim, judul, id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim', '$judul', 3, '$nama_dokumen_daftarisi', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_daftarisi);

			}

			if(move_uploaded_file($lokasi_file_babii,"$folder_babii")){

			  $query = "INSERT INTO tb_dokumen (nim, judul, id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim', '$judul', 4, '$nama_dokumen_babii', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_babii);

			}

			if(move_uploaded_file($lokasi_file_babiii,"$folder_babiii")){

			  $query = "INSERT INTO tb_dokumen (nim, judul, id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim', '$judul', 5, '$nama_dokumen_babiii', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_babiii);

			}

			if(move_uploaded_file($lokasi_file_babiv,"$folder_babiv")){

			  $query = "INSERT INTO tb_dokumen (nim, judul, id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim', '$judul', 6, '$nama_dokumen_babiv', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_babiv);

			}

			if(move_uploaded_file($lokasi_file_babv,"$folder_babv")){

			  $query = "INSERT INTO tb_dokumen (nim, judul, id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim', '$judul', 7, '$nama_dokumen_babv', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_babv);

			}

			if(move_uploaded_file($lokasi_file_dapus,"$folder_dapus")){

			  $query = "INSERT INTO tb_dokumen (nim, judul, id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim', '$judul', 8, '$nama_dokumen_dapus', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_dapus);

			}

			if(move_uploaded_file($lokasi_file_halbelakang,"$folder_halbelakang")){

			  $query = "INSERT INTO tb_dokumen (nim, judul, id_label, nama_dokumen, upload_date, status_index)
			            VALUES('$nim', '$judul', 9, '$nama_dokumen_halbelakang', NOW(), 0)";
			            
			  mysqli_query($conn, $query);

			  //toIndex($nama_dokumen_halbelakang);

			}

			mysqli_query($conn, "UPDATE mahasiswa SET status_upload = 'yes' WHERE nim=$nim");

			//header('Location:upload.php?success=1');
	}

	//hitungBobot();
	//hitungVektor();

	//header('Location: '.$redirect);


?>