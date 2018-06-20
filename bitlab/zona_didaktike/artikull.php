<!DOCTYPE html>
<html lang="en">
<?php
$nothing=false;
include("../utilities/connect.php");
if(isset($_GET['id']) && $_GET['id']!=null)
{
    if($_GET['tipi']=='teze')
    {
        $query="SELECT t.Pershkrimi,t.Viti,t.Faqja,lnd.Emer As lenda,c.Emri as Kategoria,t.insertdate as InsertDate ";
        $query.=",s.Emer,s.Mbiemer,t.Foto FROM student as s inner join `teza` as t on s.Username=t.id_useri inner join lenda as lnd ";
        $query.="on t.Id_lenda=lnd.Id inner join category as c on lnd.Id_Categ = c.Id WHERE t.Id =:id";
        $sql=$conn->prepare($query);
        $sql->bindparam(":id",$_GET['id']);
        $sql->execute();

        $result=$sql->fetchAll(PDO::FETCH_NUM);
        
        if($sql->rowCount()>0)
        {
            $pershkrimi=$result[0][0];
            $viti=$result[0][1];
            $faqja=$result[0][2];
            $lenda=$result[0][3];
            $kategoria=$result[0][4];
            $datashtimit=$result[0][5];
            $EmriUserit=$result[0][6];
            $MbiemriUserit=$result[0][7];
            $foto=$result[0][8]; //mban pathin keshtu qe mjafton ti vendosim atributit src te img kte vlere dhe shfaqet fotoja
        }
        else
        {
            $nothing=true;
            echo "nothing in teze";
         }
        
        
    }
    else if($_GET['tipi']=='leksione')
    {

        $query1="SELECT l.Titull,l.Permbajtje,l.Document,lnd.Emer as lenda,c.Emri as Kategoria,l.insertdate as InsertDate FROM leksion as l inner join lenda as lnd on l.Id_lende=lnd.Id inner join category as c on lnd.Id_Categ= c.Id Where l.Statusi=1 and l.Id=:id ";

        $sql1=$conn->prepare($query1);
        $sql1->bindparam(":id",$_GET['id']);
        $sql1->execute();

        $result1=$sql1->fetchAll(PDO::FETCH_NUM);
        if($sql1->rowCount()>0){
            $Titulli=$result1[0][0];
             $permbajtja=$result1[0][1];
             $Document='Materiale/Leksione/'.$result1[0][2];
             $lenda=$result1[0][3];
             $kategoria=$result1[0][4];
             $datashtimit=$result1[0][5];
             //$EmriUserit=$result[0][6];
            // $MbiemriUserit=$result[0][7];

            $type=explode(".",$Document);
            $filetype=$type[count($type)-1];// tipi i file
            $iconpath="../assets/Images/".$filetype.".ico";
        }
        else
        {
            echo "nothing in lesione";
            $nothing=true;
            //exit;
        }

        
    }
}

?>
<body>
    
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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- CSS Just for demo purpose, don't include it in your project >
    <link href="assets/demo/demo.css" rel="stylesheet" /-->

</head>
<body class="">
    <?php
    /**************************************
    *M E N A X H I M I  N A V I G I M I T
    *************************************/
        $Headeri="Artikull";
        if(isset($_GET["tipi"])&&$_GET["tipi"]!=""){
            if($_GET["tipi"]=="leksione"){
                $Headeri="Leksion";
            }
            else if($_GET["tipi"]=="teze"){
                $Headeri = "Teze";
            }
        }
        include("navi.php");
     ?>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
                <!-- <canvas id="bigDashboardChart"></canvas> -->
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                           <!--div class="card"  >
                                <div class="card-header">
                                    <h5 class="card-category">#</h5>
                                    <h4 class="card-title">Postimet e Fundit</h4>
                                </div>
                                <div  class="card-body" -->

                            <?php
        if($_GET['tipi']=='teze' && (!$nothing))
        {
            //echo "<img id='img_teze' src=$foto alt='teze' style=height:100px;width:100px />";
            ?>
            <div class="card" >
            <div class="card-header">
                 <button class="btn btn-xs btn-info" onclick="goBack()">Ktheu Mbrapa</button>
                                 
                                        <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                        </script>
                 <h5 class="card-category">Teze</h5>
                 <?php 
                 if($viti!=null && $viti!=""){
                echo '<h4 class="card-title">'.$lenda.' | '.$viti.'</h4>';
            }else{
                echo '<h4 class="card-title">'.$lenda.' |</h4>';
            }
            ?>
            </div>
            <div  class="card-body" >
            <H6><?php echo $kategoria; ?></H2>
                <?php echo $pershkrimi; 
                echo "</br>";
                echo "</br>";
                  echo "Shfaq Dokumentin";
                 echo '<div class="font-icon-detail"><a href=""> <h1><i class="now-ui-icons files_single-copy-04"></i></h1></a></div>';
                ?>
            <!--li><?php echo "pershkrimi :".$pershkrimi; ?></li>
            <li><?php echo "viti :".$viti; ?></li>
            <li><?php echo "faqja :".$faqja; ?></li>
            <li><?php echo "lenda :".$lenda; ?></li>
            <li><?php echo "kategoria :".$kategoria; ?></li>
            <li><?php echo "datashtimit :".$datashtimit; ?></li>
            <li><?php echo "EmriUserit :".$EmriUserit; ?></li>
            <li><?php echo "MbiemriUserit :".$MbiemriUserit; ?></li>
            <li><?php echo "foto :".$foto; ?></li-->

                      </div>
                                <div class="card-footer">
                                    <hr>
                                    <div class="stats">
                                        <div class="row">
                                            <div class="col-md-4"><i class="now-ui-icons  location_bookmark "></i><?php echo $kategoria; ?></div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4 text-right">
                                                <h6><?php echo $datashtimit; ?></h6>
                                            </div>

                                            
                                      </div>
                                    </div>
                                </div>
                            </div>
<?php
        }
       else if($_GET['tipi']=='leksione' && (!$nothing))
        {?>
        <div class="card" >
            <div class="card-header">
                 <button class="btn btn-xs btn-info" onclick="goBack()">Ktheu Mbrapa</button>
                                 
                                        <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                        </script>
                 <h5 class="card-category">Leksion</h5>
                 <a href=""><h4 class="card-title"><?php echo $Titulli; ?> </h4></a>
                <h6 class="card-subtitle"><?php echo $lenda." | "; ?></h6>
            </div>
            <div  class="card-body" >            
<?php 
           // echo "<object src=$Document><embed src=$Document></embed></object>"; //shfaq permbajtjen e doc
            //echo"<embed src=$Document type='application/pdf' width='100%' height='600px' />";
            //echo "<object width='400' height='400' data=$Document></object>";
           // echo "<a href=$Document><img src=$iconpath alt='doc'></a>"; //per ta shkarkuar doc vendosim atributin download

       //echo "<ul>";
       //echo "<li>$Titulli</li>";
      // echo "<li>$permbajtja</li>";
       //echo "<li>$Document</li>";
       //echo "<li>$lenda</li>";
       //echo "<li>$kategoria</li>";
       //echo "<li>$datashtimit</li>";
       //echo "<li>$EmriUserit</li>";
       //echo "<li>$MbiemriUserit</li>";
       //echo "</ul>";
        echo "</br>";
       echo $permbajtja;
       //echo $Document;
        echo "</br>";
        echo "</br>";
       echo "Shfaq Dokumentin";
     echo '<div class="font-icon-detail"><a href=""> <h1><i class="now-ui-icons education_paper"></i></h1></a></div>';

       ?>
                </div>
                                <div class="card-footer">
                                    <hr>
                                    <div class="stats">
                                        <div class="row">
                                            <div class="col-md-4"><i class="now-ui-icons  location_bookmark "></i><?php echo $kategoria; ?></div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4 text-right">
                                                <h6><?php echo $datashtimit; ?></h6>
                                            </div>

                                            
                                      </div>
                                    </div>
                                </div>
                            </div>

<?php

        }
        else{?>
        <div class="card" >
            <div class="card-header">
                <div class="text-left">
                                        <button class="btn btn-xs btn-info" onclick="goBack()">Ktheu Mbrapa</button>
                                 
                                        <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                        </script> 
                 <h5 class="card-category">Artikull</h5>
                 <h4 class="card-title"><?php //echo $Titulli; ?> </h4>
                <h6 class="card-subtitle"><?php //echo $lenda." | ".$viti; ?></h6>
            </div>
            <div  class="card-body" >
        <?php    echo "<h1>Nothing to show</h1>"; ?>
                </div>
                                <div class="card-footer">
                                    <hr>
                                    <div class="stats">
                                        <div class="row">
                                            <div class="col-md-4"><i class="now-ui-icons  location_bookmark "></i><?php //echo $kategoria; ?></div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4 text-right">
                                                <h6><?php //echo $datashtimit; ?></h6>
                                            </div>

                                            
                                      </div>
                                    </div>
                                </div>
                            </div>
<?php
        }
     ?>



                                </div>
                                <!--div class="card-footer">
                                    <hr>
                                    <div class="stats">
                                      <i class="now-ui-icons  location_bookmark "></i>Matematik
                                    </div>
                                </div-->
                            </div>
                     </div>   
                </div>
            </div>
            <?php
            include "footer.php";
            ?>