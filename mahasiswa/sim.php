<?php

include 'connect.php';
error_reporting(0);

$query = $_GET['keyword'];

mysqli_query($conn, "TRUNCATE TABLE tbcache");
function hitungsim($query) {

	include 'connect.php';

	$sql = "SELECT Count(*) as n FROM tbvektor_copy";

	$resn = $conn->query($sql);

	$rown = mysqli_fetch_array($resn);
	$n = $rown['n'];
	
	$aquery = explode(" ", $query);
	
	$panjangQuery = 0;
	$aBobotQuery = array();
	
	for ($i=0; $i<count($aquery); $i++) {


		$sql2 = "SELECT Count(*) as N from tbindex_copy WHERE term like '$aquery[$i]'";

		$resNTerm = $conn->query($sql2);

		$rowNTerm = mysqli_fetch_array($resNTerm);

		$NTerm = $rowNTerm['N'] ;
		
		$idf = log($n/$NTerm);

		$aBobotQuery[] = $idf;
		
		$panjangQuery = $panjangQuery + $idf * $idf;		
	}
	
	$panjangQuery = sqrt($panjangQuery);
	
	$jumlahmirip = 0;
	
	$resDocId = mysqli_query($conn, "SELECT * FROM tbvektor_copy ORDER BY docid");
	while ($rowDocId = mysqli_fetch_array($resDocId)) {
	
		$dotproduct = 0;
			
		$docId = $rowDocId['docid'];
		$panjangDocId = $rowDocId['panjang'];
		
		$resTerm = mysqli_query($conn, "SELECT * FROM tbindex_copy WHERE docid = '$docId'");
		
		while ($rowTerm = mysqli_fetch_array($resTerm)) {
			for ($i=0; $i<count($aquery); $i++) {

				if ($rowTerm['term'] == $aquery[$i]) {
					$dotproduct = $dotproduct + $rowTerm['bobot'] * $aBobotQuery[$i];		
					
				}
					else
					{
					}
			}		
		}
		
		
		if ($dotproduct != 0) {
			$sim = $dotproduct / ($panjangQuery * $panjangDocId);

			$resInsertCache = mysqli_query($conn, "INSERT INTO tbcache (query, docid, nilai) VALUES ('$query', '$docId', $sim)");
			$jumlahmirip++;
		} 
			
	if ($jumlahmirip == 0) {
		$resInsertCache = mysqli_query($conn, "INSERT INTO tbcache (query, docid, nilai) VALUES ('$query', 0, 0)");
		}	}
		
}


?>