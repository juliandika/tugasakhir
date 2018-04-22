<?php

include 'connect.php';
error_reporting(0);
$query = $_GET['keyword'];

mysqli_query($conn, "TRUNCATE TABLE tbcache_copy");

function hitungsim($query) {

	include 'connect.php';

	$result = array();

	$sql = "SELECT Count(*) as n FROM tbvektor";

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

		$sql3 = mysqli_query($conn, "SELECT * FROM tbindex WHERE term like '$aquery[$i]' LIMIT 1");

		if(mysqli_num_rows($sql3) > 0){

			while($row = mysqli_fetch_array($sql3)){

				  $idf = $row['bobot'] / $row['freq'];

				  
				  $aBobotQuery[] = $idf;

				  $query[] = $row['term'];

				  $panjangQuery = $panjangQuery + $idf * $idf;
				  
				  $AdaTerm = 1;
			}
		}
		

		if($AdaTerm = 1) {

			$sin = "SELECT * FROM sinonim WHERE kata LIKE '$aquery[$i]'";

	    	$res = $conn->query($sin);
			
	   		
	   		if($res->num_rows > 0){

		   			$adaSinonim[$i] = 1;

					while($row = $res->fetch_assoc()){

						$sinonim = $row["sinonim"];

		            	$asinonim = explode(" ", $sinonim);

		            	for($j=0; $j<count($asinonim); $j++){

							$idf_sinonim = 0.5 * $idf;

							$aBobotSinonim[] = $idf_sinonim;

							$panjangQuerySinonim = $panjangQuerySinonim + $idf_sinonim * $idf_sinonim;

							$totalSinonim[] = $asinonim[$j];

						}

					}

			}
		}

	} 

	$querytotal = array_merge($query, $totalSinonim);

	$panjangQueryTotal = sqrt($panjangQuery + $panjangQuerySinonim);


	for ($i=0; $i<count($querytotal); $i++) {

		$sql4 = mysqli_query($conn, "SELECT * FROM tbindex WHERE term like '$querytotal[$i]'");

		while($row = mysqli_fetch_array($sql4)){

		  $index[] = $row;

		}
	}

	

	for ($i=0; $i<count($index); $i++) {

		$sql5 = mysqli_query($conn, "SELECT * FROM tbvektor WHERE docid = '".$index[$i]['docid']."'");

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

					if (($index[$j]['term'] == $query[$k]) && ($index[$j]['docid'] == $vektor[$i]['docid'])) {

						$dotproduct1 = $dotproduct1 + $aBobotQuery[$k] * $index[$j]['bobot'];

					}


			}
				for ($l=0; $l<count($totalSinonim); $l++) {

					if (($index[$j]['term'] == $totalSinonim[$l]) && ($index[$j]['docid'] == $vektor[$i]['docid'])) {

						$dotproduct2 = $dotproduct2 + $index[$j]['bobot'] * $aBobotSinonim[$l];
						
						}	
					}

		}

		if (($dotproduct1 != 0) || ($dotproduct2 != 0)) {

			$sim = ($dotproduct1 + $dotproduct2) / ($panjangQueryTotal * $vektor[$i]['panjang']);
			$result[] = array('$query',$vektor[$i]['docid'],$sim);



			$jumlahmirip++;

			$docId = $vektor[$i]['docid'];
		}


	if ($jumlahmirip == 0) {
		$result[] = array($query,0,0);
		}
	}

	mysqli_query($conn, "TRUNCATE TABLE tbcache");

	$data = array();
	foreach($result as $row) {
	    $docId = mysqli_real_escape_string($conn, $row[1]);
	    $sim = (float) $row[2];
	    $data[] = "('$docId', $sim)";
	}

	$values = implode(',', $data);

	$sql = "INSERT INTO tbcache(docid, nilai) VALUES $values";

	$conn->query($sql);
	//echo "Panjang query total  = " . $panjangQueryTotal . "<br><br>";
}

hitungsim($query);


?>