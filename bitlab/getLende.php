<?php
include("connect.php");

function merrLende($IdLende = ""){
    global $conn;
	if( $IdLende == "" ){
		
		$handle = $conn->prepare("SELECT `Id`,`Emer` FROM `Lenda` ");
		$handle->execute();
		$results = $handle->fetchAll();

		return "{ \"lendet\":".json_encode($results)."}";
		
	}
	else if($IdLende != ""){

		if(ekzistonLenda($IdLende)){
				
				$handle = $conn->prepare("SELECT `Id`,`Emer` FROM `Lenda` WHERE Id = :idlende ");
				$handle->bindparam(":idlende", $IdLende);
				$handle->execute();
				$results = $handle->fetch();

				return json_encode($results);
			}
		}
		else{
			return false;
		}
}

function ekzistonLenda($IdLende)
{
    $handle = $conn->prepare("SELECT `Id`,`Emer` FROM `Lenda` WHERE Id = :idlende ");
	$handle->bindparam(":idlende", $IdLende);
    $handle->execute();
    
    $results = $handle->num_rows();
    if($results != 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

?>