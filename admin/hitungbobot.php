<?php

function hitungBobot(){

	include 'connect.php';

	ini_set('mysql.connect_timeout', 300);
	ini_set('default_socket_timeout', 300);

	$index = array();
	$term = array();
	$tf = array();
	$w = array();
	$bobot = array();

	mysqli_query($conn, "TRUNCATE TABLE tb_index");
	$resn = mysqli_query($conn, "INSERT INTO tb_index (id_dokumen, term, nama_dokumen, freq) SELECT id_dokumen,term,nama_dokumen,count(*) FROM tb_term GROUP BY id_dokumen,nama_dokumen,term");	

	$n = mysqli_num_rows($resn);
	
	$resn = mysqli_query($conn, "SELECT DISTINCT nama_dokumen FROM tb_index");

	$n = mysqli_num_rows($resn);

	$resindex = mysqli_query($conn, "SELECT * FROM tb_index");

	while($row = mysqli_fetch_array($resindex)){

	 	  $term[] = $row['term'];

	 	  $index[] = array('id_dokumen'   =>$row['id_dokumen'],
					 	  	'nama_dokumen'=>$row['nama_dokumen'],
					 	  	'tf'          => $row['freq'],
					 	  	'term'        => $row['term'],
					 	  	'bobot'       => $row['bobot']);

	}

	for($i=0; $i<count($term); $i++){

		  $df = array_count_values($term);

		  $index[$i]['bobot'] = $index[$i]['tf'] * log10($n/$df[$index[$i]['term']]);


		  $bobot[] = array($index[$i]['id_dokumen'],$index[$i]['term'],$index[$i]['nama_dokumen'],$index[$i]['tf'],$index[$i]['bobot']);

	}


	mysqli_query($conn, "TRUNCATE TABLE tb_index");
	$data = array();
	foreach($bobot as $row) {
		$id_dokumen = (int) $row[0];
	    $term = mysqli_real_escape_string($conn, $row[1]);
	    $docid = mysqli_real_escape_string($conn, $row[2]);
	    $tf = (int) $row[3];
	    $bobot = (float) $row[4];
	    $data[] = "($id_dokumen, '$term', '$docid', $tf, $bobot)";
	}

	$values = implode(',', $data);

	$insert = "INSERT INTO tb_index (id_dokumen, term, nama_dokumen, freq, bobot) VALUES $values";



	$conn->query($insert);

  	//header('Location: '.$redirect);
 }

?>