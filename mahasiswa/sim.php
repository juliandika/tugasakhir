<?php

include 'connect.php';


$keyword = $_GET['keyword'];

function hitungsim($keyword) {

	include 'connect.php';

	$panjangQuery = 0;
	$aBobotQuery = array();
	$query = array();
	$index = array();
	$vektor = array();
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
	
	
	for ($i=0; $i<count($aquery); $i++) {

		$get = mysqli_query($conn, "SELECT * FROM tb_index WHERE term like '$aquery[$i]' LIMIT 1");

		$sql = "SELECT * FROM tb_index WHERE term like '$aquery[$i]' LIMIT 1";

		if(mysqli_num_rows($get) > 0){

			while($row = mysqli_fetch_array($get)){

				  $idf = $row['bobot'] / $row['freq'];
				  
				  $aBobotQuery[] = $idf;

				  $query[] = $row['term'];

				  $panjangQuery = $panjangQuery + $idf * $idf;
			
			}

		}

	}


	$panjangVektorQuery = sqrt($panjangQuery);


	for ($i=0; $i<count($query); $i++) {


		$getIndex = mysqli_query($conn, "SELECT * FROM tb_index WHERE term like '$query[$i]'");

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

		$dotProduct = 0;

		for ($j=0; $j<count($index); $j++) {

			for ($k=0; $k<count($query); $k++) {

					if (($index[$j]['term'] == $query[$k]) && ($index[$j]['nama_dokumen'] == $vektor[$i]['nama_dokumen'])) {
						$dotProduct = $dotProduct + $aBobotQuery[$k] * $index[$j]['bobot'];

					} 

			}
		}

		if ($dotProduct != 0) {

			$sim = $dotProduct / ($panjangVektorQuery* $vektor[$i]['panjang_vektor']);
			$result[] = array($vektor[$i]['id_dokumen'],$vektor[$i]['nama_dokumen'],$sim);
			$jumlahmirip++;
			$nama_dokumen = $vektor[$i]['nama_dokumen'];

		}


	if ($jumlahmirip == 0) {
		$result[] = array($vektor[$i]['id_dokumen'],0,0);
		}
	}



	mysqli_query($conn, "TRUNCATE TABLE tb_cache");

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