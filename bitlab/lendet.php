<?php
include 'getLende.php';
header('Content-Type: application/json');

if( $_SERVER['REQUEST_METHOD'] == "GET" ){

	if(isset($_GET["id"]) && $_GET["id"] !=null){
		$lende =  merrLende($_GET["id"]);
		if($lende == true){
			echo $lende;
		}
		 else{
		 	http_response_code(404);
			echo "{ \"message\" : \"movie does not exist\"}";
		 }
	}
	else{
		
		echo merrLende();
	}

}

?>