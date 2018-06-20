<?php
include("functions.php");
//require_once("connect.php");
include("connect.php");

//if(isset($_POST['username']) && $_POST['username'] != null && isset($_POST['password']) && $_POST['password'] != null && isset($_POST['confirmPassword']) && $_POST['confirmPassword'] != null) && isset($_POST['emri']) && $_POST['emri'] != null && isset($_POST['mbiemri']) && $_POST['mbiemri'] != null && isset($_POST['email']) && $_POST['email'] != null && isset($_POST['viti']) && $_POST['viti'] != null && isset($_POST['ditelindja']) && $_POST['ditelindja'] != null && isset($_POST['dega']) && $_POST['dega'] != null)
if(isset($_POST['username'],$_POST['password'],$_POST['confirmPassword'],$_POST["emri"],$_POST["mbiemri"],$_POST["email"],$_POST["viti"],$_POST["ditelindja"],$_POST["dega"]) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && !empty($_POST["emri"]) && !empty($_POST["mbiemri"]) && !empty($_POST["email"]) && !empty($_POST["viti"]) && !empty($_POST["ditelindja"]) && !empty($_POST["dega"]))
{
    $username=test_input($_POST["username"]);
    $password=test_input($_POST["password"]);
    $confirmPassword=test_input($_POST["confirmPassword"]);
    $emri=test_input($_POST["emri"]);
    $mbiemri=test_input($_POST["mbiemri"]);
    $email=test_input($_POST["email"]);
    $viti=test_input($_POST["viti"]);
    $ditelindja=test_input($_POST["ditelindja"]);
    $dega=test_input($_POST["dega"]);

    if($password != $confirmPassword)
    {
        $errmessage="Confirm Password duhet te jete i njejte me Password";
        echo "<script type='text/javascript'>alert('$errmessage');window.location.href='Welcome.html';</script>";
    }
    else
    {
        $query=$conn->prepare("Select Username From Users where username=?"); //kontrollon nqs gjendet 
        $query->bindParam(1,$username,PDO::PARAM_STR);
        $query->execute();
        $result=$query->setFetchMode(PDO::FETCH_ASSOC);
        $recordsReturned=$query->rowCount();
        if($recordsReturned != 0)
        {
            $errmessage="Ekziston nje Perdorues me kete Username <br> Zgjidhni nje tjeter ju lutem";
            echo "<script type='text/javascript'>alert('$errmessage');window.location.href='Welcome.html';</script>";
        }
        else
        {
            try{
            //transaksioni
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
          
                    $transaction= $conn->prepare('call shtoUser(?,?,?,?,@responseMessage)');
                $statusi=1;$roli="Junior";
                $transaction->bindParam(1,$username,PDO::PARAM_STR);
                $transaction->bindParam(2,$password,PDO::PARAM_STR);
                $transaction->bindParam(3,$statusi,PDO::PARAM_STR);
                $transaction->bindParam(4,$roli,PDO::PARAM_STR);

                $transaction->execute();
                
                $result1 = $conn->query("SELECT @responseMessage AS responseMessage")->fetch(PDO::FETCH_ASSOC);
                
                $transaction= $conn->prepare('call shtoStudent(?,?,?,?,?,?,?,@responseMessage)');

                $transaction->bindParam(1,$username,PDO::PARAM_STR);
                $transaction->bindParam(2,$emri,PDO::PARAM_STR);
                $transaction->bindParam(3,$mbiemri,PDO::PARAM_STR);
                $transaction->bindParam(4,$viti,PDO::PARAM_INT);
                $transaction->bindParam(5,$ditelindja,PDO::PARAM_STR);
                $transaction->bindParam(6,$email,PDO::PARAM_STR);
                $transaction->bindParam(7,$dega,PDO::PARAM_INT);
                
                $transaction->execute();
                
                $result2 = $conn->query("SELECT @responseMessage AS responseMessage")->fetch(PDO::FETCH_ASSOC);
                
                if($result1['responseMessage']=="Success" && $result2['responseMessage']=="Success")
                {
                   
                    $conn->commit(); 
                    echo "<script>alert('Ju u regjistruat me sukses <br> Tani mund te logoheni!');window.location.href='Welcome.html';</script>";
                   
                }
            }
            catch(PDOException $e) 
             { 
                   
                    $conn->rollBack(); 
                    echo "<script>alert('Dicka nuk shkoi sic duhet <br> Ju lutem provoni perseri!');window.location.href='Welcome.html';</script>";
                    
                   
             }
              
        }

    }
}
else
{
    $errmessage="Ju lutem plotesoni fushat";
    echo "<script type='text/javascript'>alert('$errmessage');window.location.href='Welcome.html';</script>";
}

?>