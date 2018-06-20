<?php
//include("connect.php");
require_once("connect.php");
include("functions.php");

if(isset($_POST["username"]) && $_POST["username"] != null && isset($_POST["password"]) && $_POST["password"] != null)
{
        $username=test_input($_POST["username"]);
        $password=test_input($_POST["password"]);
        $msg;    
        $prepareProc= $conn->prepare('call loginUser(?,?,@responseMessage)');
        $prepareProc->bindParam(1,$username,PDO::PARAM_STR);
        $prepareProc->bindParam(2,$password,PDO::PARAM_STR);
        
        $prepareProc->execute();
        
        $result = $conn->query("SELECT @responseMessage AS responseMessage")->fetch(PDO::FETCH_ASSOC);
        if($result['responseMessage']=="Identifikim me sukses.")
        {
            
            header("Location: Education.html");
           
        }
        else
        {
            $errmessage = $result['responseMessage'];
            echo "<script type='text/javascript'>alert('$errmessage');window.location.href='Welcome.html';</script>";
        }
  
}
else
{
    $errmessage="Ju lutem plotesoni fushat";
    echo "<script type='text/javascript'>alert('$errmessage');window.location.href='Welcome.html';</script>";
}
?>