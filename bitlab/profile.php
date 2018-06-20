<!DOCTYPE html>
<?php
include('alpha_tests/connect.php');
//include('functions.php');

$newPhoto=""; //do te ruaje foton e ndryshuar
$target_file="";//vendi ku ndodhet fotoja e re
$file_path="";
$userid="test";//do zevendesohet pastaj me session apo cookie  
if(!empty($_FILES["file"]["name"]))
{
  $target_dir = 'userPictures\\';
  $target_pic='userPictures/';
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $newPhoto=basename($_FILES["file"]["name"]);
 $file_path = $_FILES["file"]["tmp_name"];
  move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
  //ob_start();
  echo $target_file;
  //ob_flush();
  exit;
}
if(isset($_POST['ischanged']))
{
  $query="Update users set Passwordi=SHA2(:password,512) where username=:username";
  $sql=$conn->prepare($query);
  $sql->bindparam(":password",$_POST['password']);
  $sql->bindparam(":username",$userid);
  $sql->execute();

}
if(isset($_POST['issaved']))
{
  if(isset($_POST['username']) && $_POST['username']!= null)
  {
    $query="Select username from users where username=:username And username <>:currentuser ";
    $sql=$conn->prepare($query);
    $sql->bindparam(":username",$_POST['username']);
    $sql->bindparam(":currentuser",$userid);//do zevendesohet pastaj me session apo cookie 
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    if($sql->rowCount()==0) //nr i rreshtave
    {
      try
      {
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $conn->beginTransaction();
          $query="Update users set username=:username where username=:currentuser ";
          $sql=$conn->prepare($query);
          $sql->bindparam(":username",$_POST['username']);
          $sql->bindparam(":currentuser",$userid);

          $sql->execute();

          $query="update student set username=:username,emer=:emri,mbiemer=:mbiemri,ditelindje=:ditelindja,email=:email,Id_dege=:dega ";
          if($_POST['prevph'] != $_POST['photo'])
          {
            $query.=" ,foto=:foto where username=:currentuser";
            $temp=explode("\\",$_POST['photo']);
            $temp_photo=$temp[count($temp)-1];

            $sql=$conn->prepare($query);
            $sql->bindparam(":foto",$temp_photo);
            $sql->bindparam(":username",$_POST['username']);
            $sql->bindparam(":emri",$_POST['emri']);
            $sql->bindparam(":mbiemri",$_POST['mbiemri']);
            $sql->bindparam(":ditelindja",$_POST['ditelindja']);
            $sql->bindparam(":email",$_POST['email']);
            $sql->bindparam(":dega",$_POST['dega']);

          }
          else
          {
            $query.=" where username=:currentuser";
            $sql=$conn->prepare($query);
            $sql->bindparam(":username",$_POST['username']);
            $sql->bindparam(":emri",$_POST['emri']);
            $sql->bindparam(":mbiemri",$_POST['mbiemri']);
            $sql->bindparam(":ditelindja",$_POST['ditelindja']);
            $sql->bindparam(":email",$_POST['email']);
            $sql->bindparam(":dega",$_POST['dega']);
          }

          $sql->bindparam(":currentuser",$userid);
          $sql->execute();
          $conn->commit();
      }
      catch(PDOException $e) 
      {                  
        $conn->rollBack();   
      }             
    }
  }
}

$query="SELECT u.username,s.emer,s.mbiemer,s.ditelindje,s.email,d.emer,s.foto,d.id FROM student as s INNER JOIN users as u ON s.Username = u.Username inner join dega as d on s.id_dege=d.Id Where u.username=:username and Statusi=1";
$sql = $conn->prepare($query);
$sql->bindparam(":username",$userid);
$sql->execute();   
$result = $sql->fetchAll(PDO::FETCH_NUM);
$username=$result[0][0];
$emri=$result[0][1];
$mbiemri=$result[0][2];
$ditelindje=$result[0][3];
$email=$result[0][4];
$dega=$result[0][5];
$foto='userPictures/'.$result[0][6];
//$foto="download.jpg";
$degaid=$result[0][7];


$img_path = $_SERVER['DOCUMENT_ROOT'].'/UserPictures/';//directory of photos
//$realpath=realpath(dirname(__FILE__)).'\UserPictures\\'; //vendi ku do ruajme fotot 

$querydege="select * from dega";
$sql = $conn->prepare($querydege);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
$deget="<select id='dega' disabled>";
foreach($result as $item)
{
   if($item['Id']===$degaid)
   {
     $deget.="<option value=".$item['Id']." selected>".$item['Emer']."</option>";
   }
   else
   {
    $deget.="<option value=".$item['Id'].">".$item['Emer']."</option>";
   }
   
}
$deget.="</select>";

 ?> 
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Bitlab |Progressing Bit by Bit </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
     <!--link rel="stylesheet" href="plugin/netflix-style-carousel/css/style.css"-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- CSS Just for demo purpose, don't include it in your project >
    <link href="assets/demo/demo.css" rel="stylesheet" /-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

  //klikimi i edit profile btn
  $( "#editprofile" ).click(function() {
      $('#username').attr("readonly", false);
      $('#emri').attr("readonly", false);
      $('#mbiemri').attr("readonly", false);
      $('#ditelindja').attr("readonly", false);
      $('#email').attr("readonly", false);
      $('#dega').attr("disabled", false);
      $('#editbtn').attr("hidden",false);
      $('#editprofile').attr("hidden",true);
      $('#chngphoto').attr("hidden",false);
  }); //fund funks per click te edit profile

   $( "#cancel" ).click(function() {
      $('#editprofile').attr("hidden",false);
      $('#username').attr("readonly", true);
      $('#emri').attr("readonly", true);
      $('#mbiemri').attr("readonly", true);
      $('#ditelindja').attr("readonly",true);
      $('#email').attr("readonly", true);
      $('#dega').attr("disabled", true);
      $('#editbtn').attr("hidden",true);

      $('#username').val('<?php echo $username ?>');
      $('#emri').val('<?php echo $emri ?>');
      $('#mbiemri').val('<?php echo $mbiemri ?>');
      $('#ditelindja').val('<?php echo $ditelindje ?>');
      $('#email').val('<?php echo $email ?>');
      $('#dega').val('<?php echo $dega ?>');
      $('#chngphoto').attr("hidden",true);
      alert('<?php echo $foto ?>');
      $('#profilepic').attr("src",'<?php echo $foto ?>');
    });
  
    $( "#change" ).click(function() { //per te ndryshuar pass
      var password=$('#pass').val();
      var confpass=$('#confirmpass').val();
      if(password != confpass)
      {
        alert("Passwordi dhe ConfirmPassword nuk perputhen");
      }
      else
      {
        $.ajax({
        url:"myprofile.php",
        method:"POST",
        data:
            {ischanged:1,
            password:password},
        success:function(data)
        {
          alert("Passwordi u ndryshua");
          $('#pass').val('');
          $('#confirmpass').val('');
        }
        });
      }
    });

    $( "#save" ).click(function() { //kur ruajme ndryshimet
      var username= $('#username').val(); //vlerat e reja
      var emri =$('#emri').val();
      var mbiemri=$('#mbiemri').val();
      var ditelindja =$('#ditelindja').val();
      var email =$('#email').val();
      var dega = $('#dega').val();
      var photo = $('#profilepic').attr('src');
      var prevph = '<?php echo $foto ?>';

      $.ajax({
        url:"myprofile.php",
        method:"POST",
        data:{issaved:1,
              username:username,
              emri:emri,
              mbiemri:mbiemri,
              ditelindja:ditelindja,
              email:email,
              dega:dega,
              photo:photo,
              prevph:prevph},
          success:function(data)
          {
            //document.getElementById("profilepic").src=data;
            alert("Ok");
          }
      });
    });

  $( "#chngphoto" ).click(function() {
    $("input[id='file']").click();
        //$('#file').change(function(){      
        
        $(document).on('change', '#file', function(){//kur ndryshon permbajtja e saj
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"myprofile.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,  
    success:function(data)
    {
     //$('#uploaded_image').html(data);
     document.getElementById("profilepic").src=data;
     
    }
   });
  }
 });
  });
  
});

</script>
</head>

<body class="">
        <?php
    /**************************************
    *M E N A X H I M I  N A V I G I M I T
    *************************************/
        $Headeri="Profili";
        include("navi.php");
     ?>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
                <!-- <canvas id="bigDashboardChart"></canvas> -->
            </div>
            <div class="content">
                <div class="row">
                   <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Edit Profile</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" id="username" disabled="" placeholder="Username" value="<?php echo $username; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            <div class="form-group">
                                                <label>Dega</label>
                                                
                                                <input type="text" class="form-control" id="username" placeholder="Dega" value="<?php echo $dega ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Emri</label>
                                                <input type="text"  id="emri" class="form-control" placeholder="Emri" value="<?php echo $emri; ?> " readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            <div class="form-group">
                                                <label>Mbiemri</label>
                                                <input type="text" class="form-control" placeholder="Mbiemri" id="mbiemri" value="<?php echo $mbiemri; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                  <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="Email" value="<?php echo $email ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-1">  
                                            <div class="form-group">
                                                <label>Ditelindja</label>
                                                <input type="date" id="ditelindja" value=<?php echo $ditelindje; ?>  class="form-control" placeholder="Ditelindja"  readonly />
                                               
                                            </div>
                                        </div>
                                    <!--div class="row">
                                        <input type="button" id="editprofile" value="editprofile"/>
                                     <div id="editbtn" hidden>
                                        <button id="save" type="button" >Ruaj Ndryshimet</button>
                                        <button id="cancel" type="button" >Cancel</button>
                                      </div> 
                                    </div-->
                                </div>
                                    
                                    <!--div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                                            </div>
                                        </div>
                                    </div-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/img//bg5.jpg" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
                                       <img class='avatar border-gray' src= "UserPictures/default_avatar.png" id='profilepic' alt='mypic' class ='image-wrapper' />
                                        <h5 class="title">John Doe</h5>
                                    </a>
                                    <p class="description">
                                        jdoe24
                                    </p>
                                </div>

                                  <input type="button" id="chngphoto" value="Ndrysho Foto" hidden/>
                                   <input type="file" id="file" name="file" style="display: none;"/> <!--perdoret per te ruajtur foton -->
                                  
                                <p class="description text-center">
                                  <input type="button" id=""  class="btn btn-default   btn-sm" value="Ndrysho Pass"/> 
                                </p>
                            </div>
                            <hr>
                            <div class="button-container">
                                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                                    <i class="fab fa-google-plus-g"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php

include 'zona_didaktike/footer.php';

?>
