<?php

include 'connect.php';
//error_reporting(0);

$query = $_GET['keyword'];

mysqli_query($conn, "TRUNCATE TABLE tb_cache");
function hitungsim($query) {

include 'connect.php';

	$result = array();

	$sql = "SELECT Count(*) as n FROM tb_vektor";

	$resn = $conn->query($sql);

	$rown = mysqli_fetch_array($resn);
	$n = $rown['n'];
	
	$aquery = explode(" ", $query);
	
	$panjangQuery = 0;
	$panjangQuerySinonim = 0;
	$aBobotQuery = array();
	$aBobotSinonim = array();
	$adaSinonim = array();
	$adaTerm = array();
	$query = array();
	$index = array();
	$vektor = array();
	$querytotal = array();
	$totalSinonim = array();
	
	for ($i=0; $i<count($aquery); $i++) {

		$start1 = microtime(true);

		//$sql2 = "SELECT Count(*) as N from tbindex WHERE term like '$aquery[$i]'";

		$sql3 = mysqli_query($conn, "SELECT * FROM tb_index WHERE term like '$aquery[$i]' LIMIT 1");

		if(mysqli_num_rows($sql3) > 0){

			while($row = mysqli_fetch_array($sql3)){

				  // OR just echo the data:

				  $idf = $row['bobot'] / $row['freq'];
				  
				  $aBobotQuery[] = $idf;

				  $query[] = $row['term'];

				  $panjangQuery = $panjangQuery + $idf * $idf;
				  
				  $AdaTerm = 1;
			}



		}

	} //endfor


	$start4 = microtime(true);

	$panjangQueryTotal = sqrt($panjangQuery);


	for ($i=0; $i<count($query); $i++) {


		$sql4 = mysqli_query($conn, "SELECT * FROM tb_index WHERE term like '$query[$i]'");

		while($row = mysqli_fetch_array($sql4)){

		  // add each row returned into an array
		  $index[] = $row;

		  // OR just echo the data:

		}
	}

	

	for ($i=0; $i<count($index); $i++) {

		$sql5 = mysqli_query($conn, "SELECT * FROM tb_vektor WHERE nama_file = '".$index[$i]['nama_file']."'");

		while($row = mysqli_fetch_array($sql5)){

		  // add each row returned into an array
		  $vektor[] = $row;

		  $vektor = array_map("unserialize", array_unique(array_map("serialize", $vektor)));

		}
	}

	$jumlahmirip = 0;


	for ($i=0; $i<count($vektor); $i++) {

		$dotproduct = 0;

		for ($j=0; $j<count($index); $j++) {

			for ($k=0; $k<count($query); $k++) {

					if (($index[$j]['term'] == $query[$k]) && ($index[$j]['nama_file'] == $vektor[$i]['nama_file'])) {

						$dotproduct = $dotproduct + $aBobotQuery[$k] * $index[$j]['bobot'];

					} 

			}
		}

		if ($dotproduct != 0) {


			$sim = $dotproduct / ($panjangQueryTotal * $vektor[$i]['panjang_vektor']);

			$result[] = array($query,$vektor[$i]['nama_file'],$sim);

			$jumlahmirip++;


			$docId = $vektor[$i]['nama_file'];

		}


	if ($jumlahmirip == 0) {
		$result[] = array($query,0,0);
		}
	}



	mysqli_query($conn, "TRUNCATE TABLE tb_cache");

	$data = array();
	foreach($result as $row) {
	    $docId = mysqli_real_escape_string($conn, $row[1]);
	    $sim = (float) $row[2];
	    $data[] = "('$docId', $sim)";
	}

	$values = implode(',', $data);

	$sql = "INSERT INTO tb_cache (nama_file, nilai_sim) VALUES $values";

	$conn->query($sql);
		
}


?>