<?php

include 'connect.php';
//error_reporting(0);
$keyword = $_GET['keyword'];

mysqli_query($conn, "TRUNCATE TABLE tb_cache");

function hitungsim($keyword) {

	include 'connect.php';

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
	$result = array();

	$cleaning_text1 = preg_replace('/[^a-zA-Z -]/', '', $keyword);

    $cleaning_text2 = preg_replace('/[-\n\r]/', ' ', $cleaning_text1);

    $case_folding = strtolower($cleaning_text2);

    $tokenize = explode(" ",$case_folding);

    $remove_stopwords = "SELECT * FROM tb_stopwords";

    $hasil = $conn->query($remove_stopwords);

    if($hasil->num_rows > 0){

        while($row = $hasil->fetch_array()) {

            $stopword[] = $row['stopword'];
        }
    }

    $aquery = array_diff($tokenize,$stopword);
	
	//$aquery = explode(" ", $query);
	
	
	
	for ($i=0; $i<count($aquery); $i++) {

		$get = mysqli_query($conn, "SELECT * FROM tb_index WHERE term like '$aquery[$i]' LIMIT 1");

		if(mysqli_num_rows($get) > 0){

			while($row = mysqli_fetch_array($get)){

				  $idf = $row['bobot'] / $row['freq'];

				  $aBobotQueryAwal[] = $idf;

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

	$panjangVektorQueryTotal = sqrt($panjangQueryAwal + $panjangQueryExpansion);
	$panjangVektorQueryAwal = sqrt($panjangQueryAwal);
	$panjangVektorQueryExpansion = sqrt($panjangQueryExpansion);

	for ($i=0; $i<count($queryGabungan); $i++) {

		$getIndex = mysqli_query($conn, "SELECT * FROM tb_index WHERE term like '$queryGabungan[$i]'");

		while($row = mysqli_fetch_array($getIndex)){

		  $index[] = $row;

		}
	}

	

	for ($i=0; $i<count($index); $i++) {

		$getVektor = mysqli_query($conn, "SELECT * FROM tb_vektor WHERE nama_dokumen = '".$index[$i]['nama_dokumen']."'");

			while($row = mysqli_fetch_array($getVektor)){

			  $vektor[] = $row;

			  $vektor = array_map("unserialize", array_unique(array_map("serialize", $vektor)));

			}
	}

	$jumlahmirip = 0;


	for ($i=0; $i<count($vektor); $i++) {

	
		$dotProductQueryAwal = 0;
		$dotProductQueryExpansion = 0;

		for ($j=0; $j<count($index); $j++) {

			for ($k=0; $k<count($query); $k++) {

					if (($index[$j]['term'] == $query[$k]) && ($index[$j]['nama_dokumen'] == $vektor[$i]['nama_dokumen'])) {

						$dotProductQueryAwal = $dotProductQueryAwal + $aBobotQueryAwal[$k] * $index[$j]['bobot'];

					}


			}
				for ($l=0; $l<count($QueryExpansion); $l++) {

					if (($index[$j]['term'] == $QueryExpansion[$l]) && ($index[$j]['nama_dokumen'] == $vektor[$i]['nama_dokumen'])) {

						$dotProductQueryExpansion = $dotProductQueryExpansion + $index[$j]['bobot'] * $aBobotQueryExpansion[$l];
						
						}	
					}

		}


		if (($dotProductQueryAwal != 0) || ($dotProductQueryExpansion != 0)) {

			if($adaQueryExpansion == 1 && $dotProductQueryAwal != 0){

				$sim = ($dotProductQueryAwal + $dotProductQueryExpansion)/ ($panjangVektorQueryTotal * $vektor[$i]['panjang_vektor']);


				echo "A" . "<br>";

				echo $dotProductQueryExpansion . "<br>";

				echo $sim . "<br>";



			}else if($adaQueryExpansion == 1 && $dotProductQueryAwal == 0){

				$sim = $dotProductQueryExpansion / ($panjangVektorQueryExpansion * $vektor[$i]['panjang_vektor']);


				echo "B" . "<br>";

				echo $sim . "<br>";

			}else{

				$sim = $dotProductQueryAwal / ($panjangVektorQueryAwal * $vektor[$i]['panjang_vektor']);

				echo "C" . "<br>";

				echo $sim . "<br>";

			}


			$result[] = array($vektor[$i]['id_dokumen'],$vektor[$i]['nama_dokumen'],$sim);


			$jumlahmirip++;

			$docId = $vektor[$i]['nama_dokumen'];
		}


	if ($jumlahmirip == 0) {
		$result[] = array($vektor[$i]['id_dokumen'],0,0);
		}
	}


	$data = array();
	foreach($result as $row) {
		$id_dokumen = (int) $row[0];
	    $nama_dokumen = mysqli_real_escape_string($conn, $row[1]);
	    $sim = (float) $row[2];
	    $data[] = "($id_dokumen, '$nama_dokumen', $sim)";
	}

	$values = implode(',', $data);

	$insert = "INSERT INTO tb_cache(id_dokumen, nama_dokumen, nilai_sim) VALUES $values";

	$conn->query($insert);
	
}



?>