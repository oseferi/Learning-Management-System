<!DOCTYPE html>
<?php
include('../utilities/connect.php');
//ob_start();
if(isset($_POST['ajax']))
{
    //if((isset($_GET['id']) && $_GET['id']!=null) || (isset($_POST['IdLende']) && $_POST['IdLende']!=NULL))
    if(isset($_POST['IdLende']) && $_POST['IdLende']!=null)
    {
        if(isset($_GET['id']) && $_GET['id']!=null)
        {
            $id=$_GET['id'];
        }
        else
        {
            $id=$_POST['IdLende'];
        }
        if(isset($_POST['ItemId']))
        {
            $el=$_POST['ItemId'];
            $query="";
            $tipArtikull="";
            switch($el) 
            {
                case 'leksione':
                    $query="SELECT l.Id,l.Titull,l.Permbajtje,lnd.Emer as lenda,c.Emri as Kategoria,l.insertdate as InsertDate FROM `leksion` as l ";
                        $query.="inner join lenda as lnd on l.Id_lende=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id Where l.Statusi=1 And lnd.Id=:id";
                        $query.=" Order By l.InsertDate Desc";
                    $tipArtikull='leksion';
                    break;
                case 'teze':
                    $query="SELECT t.Id,t.Pershkrimi,t.Viti,lnd.Emer As lenda,c.Emri as Kategoria,t.insertdate as InsertDate FROM `teza` as t inner join lenda as lnd on t.Id_lenda=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id WHERE lnd.Id =:id  ORDER By t.insertdate desc";
                    $tipArtikull='teze';
                    break;
                default:
                        $query="select * FROM ((";
                        $query.="SELECT l.Id,l.Titull,l.Permbajtje,lnd.Emer as lenda,c.Emri as Kategoria,l.insertdate as InsertDate FROM `leksion` as l ";
                        $query.="inner join lenda as lnd on l.Id_lende=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id Where l.Statusi=1 AND lnd.Id=:id ";
                        $query.=" Order By l.InsertDate Desc) ";
                        $query.="UNION ( ";
                        $query.="SELECT t.Id,t.Pershkrimi,t.Viti,lnd.Emer As lenda,c.Emri as Kategoria,t.insertdate as InsertDate FROM `teza` as t inner join lenda as lnd on t.Id_lenda=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id WHERE lnd.Id =:id  ORDER By t.insertdate desc";
                        $query.=")) as tmp ORDER by INSERTDate desc ";
                
            }
            //$username='test';//do zevendesohet me userin qe do ruhet ne session apo cookie

                if($tipArtikull == "leksion" || $tipArtikull== "teze")
                {
                    //preparing the statement
                    $sql=$conn->prepare($query);
                    $sql->bindparam(':id',$id,PDO::PARAM_INT); 
                    $sql->execute();

                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                    //print_r($result);
                    if (is_array($result) || is_object($result))
                    {
                        foreach($result as $value)
                        {
                            if($tipArtikull=='teze')
                            {/*
                                $div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                                $div.='<a href=\"#\">';
                                $div.='<div class=\"card\">';
                                $div.='<div class=\"card-header\">';
                                $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Pershkrimi'].'</h4></a></div>';
                                $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                                $div.='<div class="card-footer">';
                                $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                                $div.='</div></div></div></a></div>';*/

                    $lenda=$value['lenda'];
                     $pershkrimi = '';
                        if(strlen($value['Pershkrimi']) > 40 ){
                            $pershkrimi= substr($value['Pershkrimi'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Pershkrimi'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=teze">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">Teze</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                            }
                            else
                            {
                            	/*
                                $div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                                $div.='<a href=\"#\">';
                                $div.='<div class=\"card\">';
                                $div.='<div class=\"card-header\">';
                                $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Permbajtje'].'</h4></a></div>';
                                $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                                $div.='<div class="card-footer">';
                                $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                                $div.='</div></div></div></a></div>';*/

                                $lenda=$value['lenda'];
                                 $pershkrimi = '';
                        if(strlen($value['Permbajtje']) > 40 ){
                            $pershkrimi= substr($value['Permbajtje'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Permbajtje'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=leksione">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">'.$tipArtikull.'</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                            }
                            

                            echo($div);
                            //print_r($value);
                            
                        }
                        exit;
                    }
                    exit;
                }
                else
                {

                    //preparing the statement
                    $sql=$conn->prepare($query);
                    $sql->bindparam(':id',$id); 
                    $sql->execute();

                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($result As $value)
                    {
                        if(is_numeric($value['Permbajtje']))//esht teze
                        {/*
                            $div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                                $div.='<a href=\"#\">';
                                $div.='<div class=\"card\">';
                                $div.='<div class=\"card-header\">';
                                $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Titull'].'</h4></a></div>';
                                $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                                $div.='<div class="card-footer">';
                                $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                                $div.='</div></div></div></a></div>';*/

                                $lenda=$value['lenda'];
                                  $pershkrimi = '';
                        if(strlen($value['Titull']) > 40 ){
                            $pershkrimi= substr($value['Titull'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Titull'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=teze">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">Teze</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                        }
                        else
                        {
                            /*$div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                                $div.='<a href=\"#\">';
                                $div.='<div class=\"card\">';
                                $div.='<div class=\"card-header\">';
                                $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Permbajtje'].'</h4></a></div>';
                                $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                                $div.='<div class="card-footer">';
                                $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                                $div.='</div></div></div></a></div>';*/
                            $lenda=$value['lenda'];
                         $pershkrimi = '';
                        if(strlen($value['Titull']) > 40 ){
                            $pershkrimi= substr($value['Titull'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Titull'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=leksione">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">'.$tipArtikull.'</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                        }
                        echo ($div);
                    }
                    exit;
                }
                //$conn=null;
                exit;
        }
        else //nqs nk esht vendosur esht klikuar ndonje buton lenda teza all
        {
                    $query="select * FROM ((";
                    $query.="SELECT l.Id,l.Titull,l.Permbajtje,lnd.Emer as lenda,c.Emri as Kategoria,l.insertdate as InsertDate FROM `leksion` as l ";
                    $query.="inner join lenda as lnd on l.Id_lende=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id Where l.Statusi=1 AND lnd.Id=:id ";
                    $query.=" Order By l.InsertDate Desc) ";
                    $query.="UNION ( ";
                    $query.="SELECT t.Id,t.Pershkrimi,t.Viti,lnd.Emer As lenda,c.Emri as Kategoria,t.insertdate as InsertDate FROM `teza` as t inner join lenda as lnd on t.Id_lenda=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id WHERE lnd.Id =:id  ORDER By t.insertdate desc";
                    $query.=")) as tmp ORDER by INSERTDate desc ";

                    $sql=$conn->prepare($query);
                    $sql->bindparam(':id',$id); 
                    $sql->execute();

                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($result As $value)
                    {
                        if(is_numeric($value['Permbajtje']))//esht teze
                        {
                            $tipArtikull='teze';
                           /* $div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                                $div.='<a href=\"#\">';
                                $div.='<div class=\"card\">';
                                $div.='<div class=\"card-header\">';
                                $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Titull'].'</h4></a></div>';
                                $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                                $div.='<div class="card-footer">';
                                $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                                $div.='</div></div></div></a></div>';*/

                                $lenda=$value['lenda'];
                                  $pershkrimi = '';
                        if(strlen($value['Titull']) > 40 ){
                            $pershkrimi= substr($value['Titull'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Titull'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=teze">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">Teze</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                        }
                        else
                        {
                        	
                            $tipArtikull='leksion';
                            /*$div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                                $div.='<a href=\"#\">';
                                $div.='<div class=\"card\">';
                                $div.='<div class=\"card-header\">';
                                $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Permbajtje'].'</h4></a></div>';
                                $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                                $div.='<div class="card-footer">';
                                $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                                $div.='</div></div></div></a></div>';*/
                                $lenda=$value['lenda'];
                                   $pershkrimi = '';
                        if(strlen($value['Titull']) > 40 ){
                            $pershkrimi= substr($value['Titull'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Titull'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=leksione">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">'.$tipArtikull.'</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                        }
                        echo ($div);
                    }
                    //$conn=null;
                    exit;
        }
        //$conn=null;
        exit;
    }
    $conn=null;
    exit;
}
//ob_end_clean();
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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
     <!--link rel="stylesheet" href="plugin/netflix-style-carousel/css/style.css"-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- CSS Just for demo purpose, don't include it in your project >
    <link href="assets/demo/demo.css" rel="stylesheet" /-->


<script>
 $(document).ready(function() {
     var full_url = document.URL;
     var url_array = full_url.split('=');
     var idlendes = url_array[url_array.length-1];
     //alert(idlendes);
    $.ajax( 
         {
             type:'POST',
             url:'lende.php', 
             data:{IdLende:idlendes,ajax:1},
             success: function(data){
                 //$("#SecondContainer").reset();
                 $('#SecondContainer').empty();
                 $("#SecondContainer").html(data);
                 //alert((data));       
         }}); 

    $("#all,#leksione,#teze").click(function(event) {
        Id=event.target.id; //id e eventit te klikimit
        //$('#SecondContainer').empty();
        var full_url = document.URL; // Get current url
        var url_array = full_url.split('='); // Split the string into an array with / as separator
        //var idFiks=url_array.split('=');
        var idlendes = url_array[url_array.length-1];  // Get the last part of the array (-1)
        //var idlendes = idFiks[idFiks.length];
        //alert(idlendes);
        $('#SecondContainer').empty();
        //kerkesa per te marre content nga db
        $.ajax(
        {
            type:'POST',
            url:'lende.php',
            data:{ItemId:Id,IdLende:idlendes,ajax:1}, 
            success: function(data){
               //data;
                //$("#SecondContainer").reset();
                $('#SecondContainer').empty();
                $("#SecondContainer").html(data);
                /*if(!$.trim(data))
                {
                    
                    $('#SecondContainer').Text="Fatkeqsisht nuk u gjet " + $Id +" per kete lende ";
                }
                else
                {
                    $("#SecondContainer").html(data);
                }*/
        }});
    });

});
</script>
</head>

<body class="">
        <?php
    /**************************************
    *M E N A X H I M I  N A V I G I M I T
    *************************************/
        $Headeri="Të gjitha kategoritë";
        include("navi.php");
     ?>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
                <!-- <canvas id="bigDashboardChart"></canvas> -->
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 text-center">
                           <div class="card">
                                <div class="card-header">
                                    <div class="text-left">
                                        <button class="btn btn-xs btn-info" onclick="goBack()">Ktheu Mbrapa</button></div>
                                 
                                        <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                        </script>
                                         <?php 
                                         if(isset($_GET['id']) && $_GET['id']!=null)
                                        {
                                        $lendequery="Select Emer From lenda where Id=:id";
                                        $stmt = $conn->prepare($lendequery);
                                        $stmt->bindparam(":id",$_GET['id']);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        foreach($result as $value){
                                            echo '<h5 class="card-category">#'.$_GET['id'].'</h5>';
                                            echo '<h4 class="card-title">'.$value['Emer'].'</h4>';
                                        }
                                    }
                                         
                                    ?>
                                    
                                    
                                     <div id="FirstContainer">
								        <button id="all" type="button" class="btn btn-default btn-sm" name="all">All</button>
								        <button id="leksione" type="button" class="btn btn-default btn-sm" name="leksione">Leksione</button>
								        <button id="teze" type="button" class="btn btn-default btn-sm" name="teze">Teza</button>
								    </div>
                                </div>
                                <div  class="card-body" >

                                           
                                          <div id="SecondContainer" class="card-columns">
                                            <!-- <button class="btn arrow-guides fa-chevron-left"></button> -->
                                       
                                      
                                          </div><!--end of module-section-->
                                          
                                        
                                        <!-- <button class="btn arrow-guides-right fa-chevron-right"></button> -->
          

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

           include 'footer.php';

           ?>