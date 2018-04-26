<?php


function hitungVektor(){

	include 'connect.php';

	$redirect = "upload.php";

	ini_set('mysql.connect_timeout', 300);
	ini_set('default_socket_timeout', 300);

	$resDocId = mysqli_query($conn, "SELECT DISTINCT id_dokumen, nama_dokumen FROM tb_index");

	$sql = mysqli_query($conn, "SELECT * FROM tb_index");

	$num_rows = mysqli_num_rows($resDocId);

	$docid = array();
	$doc = array();
	$length = array();
	$data = array();

	while($row = mysqli_fetch_array($resDocId)){

		 	  $doc[] = array('id_dokumen'=>$row['id_dokumen'],
		 	  				 'nama_dokumen'=>$row['nama_dokumen']);

	}

	while($row = mysqli_fetch_array($sql)){

		 	  
		 	  $docid[] = array('doc'=>$row['nama_dokumen'],
		 	  					'bobot' => $row['bobot']);


	}

	$panjang = 0;

	for($i=0; $i<count($doc); $i++){

		for($j=0; $j<count($docid); $j++){

				if($doc[$i]['nama_dokumen'] == $docid[$j]['doc']){

					$bobot =  $docid[$j]['bobot'];

					$panjang = $panjang + $bobot * $bobot;

				}
				
		}

		$id_dokumen = $doc[$i]['id_dokumen'];
		$document = $doc[$i]['nama_dokumen'];
		$panjang_vektor = sqrt($panjang);
		$length[] = array($id_dokumen, $document, $panjang_vektor);
		$panjang = 0;

	}

	echo "<pre>";
	print_r($length);
	echo "</pre>";


		mysqli_query($conn, "TRUNCATE TABLE tb_vektor");

		$data = array();
		foreach($length as $row) {
			$id_dokumen = (int) $row[0];
		    $document = mysqli_real_escape_string($conn, $row[1]);
		    $panjang_vektor = (float) $row[2];
		    $data[] = "($id_dokumen, '$document', $panjang_vektor)";
		}


		$values = implode(',', $data);

		$sql = "INSERT INTO tb_vektor (id_dokumen, nama_dokumen, panjang_vektor) VALUES $values";

		$conn->query($sql);

		//header('Location: '.$redirect);

}


?>