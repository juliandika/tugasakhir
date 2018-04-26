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
	
	$panjangQueryAwal = 0;
	$panjangQueryExpansion = 0;
	$aBobotQueryAwal = array();
	$aBobotQueryExpansion = array();
	$adaQueryExpansion = array();
	$adaTerm = array();
	$query = array();
	$index = array();
	$vektor = array();
	$querygabungan = array();
	$QueryExpansion = array();
	
	for ($i=0; $i<count($aquery); $i++) {

		$get = mysqli_query($conn, "SELECT * FROM tb_index WHERE term like '$aquery[$i]' LIMIT 1");

		if(mysqli_num_rows($get) > 0){

			while($row = mysqli_fetch_array($get)){

				  $idf = $row['bobot'] / $row['freq'];

				  $aBobotQueryAwal[] = $idf;

				  echo "<pre>";
				  print_r($aBobotQueryAwal);
				  echo "</pre>";

				  $query[] = $row['term'];

				  $panjangQueryAwal = $panjangQueryAwal + $idf * $idf;
				  
				  $AdaTerm = 1;
			}
		}
		

		if($AdaTerm = 1) {

			$sin = "SELECT * FROM tb_tesaurus WHERE kata LIKE '$aquery[$i]'";

	    	$res = $conn->query($sin);
			
	   		
	   		if($res->num_rows > 0){


					while($row = $res->fetch_assoc()){

						$sinonim = $row["sinonim"];

		            	$asinonim = explode(" ", $sinonim);

		            	for($j=0; $j<count($asinonim); $j++){

							$idf_sinonim = 0.5 * $idf;

							$aBobotQueryExpansion[] = $idf_sinonim;

							$panjangQueryExpansion = $panjangQueryExpansion + $idf_sinonim * $idf_sinonim;

							$QueryExpansion[] = $asinonim[$j];

							$adaQueryExpansion = 1;

						}

					}

			}
		}

	} 

	$queryGabungan = array_merge($query, $QueryExpansion);

	$panjangQueryTotal = sqrt($panjangQueryAwal + $panjangQueryExpansion);
	$panjangVektorQueryAwal = sqrt($panjangQueryAwal);
	$panjangVektorQueryExpansion = sqrt($panjangQueryExpansion);

	for ($i=0; $i<count($queryGabungan); $i++) {

		$sql4 = mysqli_query($conn, "SELECT * FROM tb_index WHERE term like '$queryGabungan[$i]'");

		while($row = mysqli_fetch_array($sql4)){

		  $index[] = $row;

		}
	}

	

	for ($i=0; $i<count($index); $i++) {

		$sql5 = mysqli_query($conn, "SELECT * FROM tb_vektor WHERE nama_dokumen = '".$index[$i]['nama_dokumen']."'");

			while($row = mysqli_fetch_array($sql5)){

			  $vektor[] = $row;

			  $vektor = array_map("unserialize", array_unique(array_map("serialize", $vektor)));

			}
	}

	$jumlahmirip = 0;


	for ($i=0; $i<count($vektor); $i++) {

	
		$dotproduct1 = 0;
		$dotproduct2 = 0;

		for ($j=0; $j<count($index); $j++) {

			for ($k=0; $k<count($query); $k++) {

					if (($index[$j]['term'] == $query[$k]) && ($index[$j]['nama_dokumen'] == $vektor[$i]['nama_dokumen'])) {

						$dotproduct1 = $dotproduct1 + $aBobotQueryAwal[$k] * $index[$j]['bobot'];



						

					}


			}
				for ($l=0; $l<count($QueryExpansion); $l++) {

					if (($index[$j]['term'] == $QueryExpansion[$l]) && ($index[$j]['nama_dokumen'] == $vektor[$i]['nama_dokumen'])) {

						$dotproduct2 = $dotproduct2 + $index[$j]['bobot'] * $aBobotQueryExpansion[$l];

						
						
						}	
					}

		}

		echo "Dot product  " . $dotproduct1 . "<br>";

		if (($dotproduct1 != 0) || ($dotproduct2 != 0)) {

			if($adaQueryExpansion == 1 && $dotproduct1 != 0){

				$sim = $dotproduct1 / ($panjangQueryAwal * $vektor[$i]['panjang_vektor']);

				echo "a" . $sim . "<br>";

			}else if($adaQueryExpansion == 1 && $dotproduct1 == 0){

				$sim = $dotproduct2 / ($panjangQueryExpansion * $vektor[$i]['panjang_vektor']);

				echo "b" . $sim . "<br>";

			}else{

				$sim = $dotproduct1 / ($panjangVektorQueryAwal * $vektor[$i]['panjang_vektor']);

				echo "c " . $sim . "<br>";

			}


			$result[] = array($vektor[$i]['id_dokumen'],$vektor[$i]['nama_dokumen'],$sim);


			$jumlahmirip++;

			$docId = $vektor[$i]['nama_dokumen'];
		}


	if ($jumlahmirip == 0) {
		$result[] = array($query,0,0);
		}
	}

	mysqli_query($conn, "TRUNCATE TABLE tb_cache");

	$data = array();
	foreach($result as $row) {
		$id_dokumen = (int) $row[0];
	    $nama_dokumen = mysqli_real_escape_string($conn, $row[1]);
	    $sim = (float) $row[2];
	    $data[] = "($id_dokumen, '$docId', $sim)";
	}

	$values = implode(',', $data);

	$sql = "INSERT INTO tb_cache(id_dokumen, nama_dokumen, nilai_sim) VALUES $values";

	$conn->query($sql);
	
}

hitungsim($query);


?>