<?php
require_once("connect.php");
$dega="<select id='deg'><option value=''></option>";

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("SELECT * FROM dega"); 
$query->execute();
$result = $query->fetchAll(); 

foreach($result as $row)
{
    //echo $row[0]."  ".$row[1]."<br>";
    $dega.="<option value=".$row[0].">".$row[1]."</option>";
}
$dega.="</select>";
echo $dega;
?>